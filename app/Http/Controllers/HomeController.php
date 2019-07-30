<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Transaction;
use Auth;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cart()
    {
        $products = session()->get('cart.products', []);
        $subtotal = session()->get('cart.subtotal', 0);

        return view('cart', compact('products','subtotal'));
    }

    public function order()
    {
        $products = Product::all();
        return view('order', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (session()->exists('cart.products') && session()->exists('cart.products.' . $product->id)) {
            $price = $request->session()->get('cart.products.' . $product->id . '.price');
            $current_quantity = $request->session()->get('cart.products.' . $product->id . '.quantity');
            $current_subtotal = $request->session()->get('cart.subtotal') - (  $price * $current_quantity );
            
            $request->session()
                    ->put('cart.products.' . $product->id . '.quantity', $current_quantity + $request->quantity);
            $request->session()->put('cart.subtotal', $current_subtotal + ($product->price * $request->session()->get('cart.products.' . $product->id . '.quantity')));
            $request->session()->put('cart.total_items', $request->session()->get('cart.total_items') + $request->quantity);
        } else {
            $data = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $request->quantity,
                    'price' => $product->price
            ];

            $request->session()->put('cart.products.' . $product->id, $data);
            $request->session()->put('cart.subtotal', $request->session()->get('cart.subtotal') 
                                    + ($product->price * $request->quantity));
            $request->session()->put('cart.total_items', $request->session()->get('cart.total_items') + $request->quantity);
        }


        return response()->json([
            'message' => 'success',
            'cart_total' => $request->session()->get('cart.total_items')
        ]);
    }

    public function removeFromCart($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->price;
        $current_quantity = session()->get('cart.products.' . $product->id . '.quantity');
        $current_subtotal = session()->get('cart.subtotal') - (  $price * $current_quantity );

        $price = session()->get('cart.products.' . $product->id . '.price');
        $quantity = session()->get('cart.products.' . $product->id . '.quantity');
        $current_subtotal = session()->get('cart.subtotal') - (  $price * $current_quantity );
        $cart_total = session()->get('cart.total_items') - $current_quantity;

        session()->forget('cart.products.' . $id);
        session()->put('cart.subtotal', $current_subtotal);
        session()->put('cart.total_items', $cart_total);
        
        return redirect()->route('order.landing.cart');
    }

    public function checkout()
    {

        if(!Auth::user()->profile){
            $notif = [
                'message' => 'Please Update Profile before proceeding to checkout.',
                'alert-type' => 'info'
            ];
            return redirect()->route('users.profile')->with($notif);
        }

        $user = Auth::user();
        $profile = $user->profile;

        $client_id = config('services.paynamics.client_id');
        
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'reference_id' => 'WINESTORY' . date('YM'),
            'total' => session()->get('cart.subtotal', 0),
            'quantity' => session()->get('cart.total_items', 0),
            'status' => 'pending',
            'signature' => 'a'
        ]);

        $data = [
            'data' => [
                'payment' => [
                    'client_id' => $client_id,
                    'request_id' => $transaction->reference_id,
                    'respo_url' => config('services.paynamics.redirect'),
                    'cancel_url' => config('services.paynamics.cancel'),
                    'firstname' => $profile->firstname,
                    'lastname' => $profile->lastname,
                    'middlename' => $profile->middlename,
                    'address1' => $profile->address,
                    'address2' => '',
                    'city' => $profile->city,
                    'state' => $profile->state,
                    'country' => $profile->country,
                    'zip' => $profile->zip,
                    'email' => $user->email,
                    'phone' => $profile->phone,
                    'mobile' => $profile->mobile,
                    'client_ip' => request()->ip(),
                    'currency' => config('services.paynamics.currency'),
                    'amount' => (string)$transaction->total,
                    'signature' => $transaction->signature
                ]
            ]
        ];

        // return json_encode($data);

        $client = new Client();

        $response = $client->request('POST', 'http://180.150.134.136:18072/TLCPay/WINESTORY/submitPayment', [
            'headers' => [
                'Accept'     => 'text/plain',
            ],
            'body' => base64_encode(json_encode($data))
        ]);

        return view('checkout');
    }
}
