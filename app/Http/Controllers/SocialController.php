<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $response = $this->createUser($getInfo,$provider);
        auth()->login($response['user']);
        if($response['new']) {
            $notif = [
                'message' => 'Please Update Profile.',
                'alert-type' => 'info'
            ];
            return redirect()->route('users.profile')->with($notif);
        }
        return redirect()->to('/');
    }

    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        $new = false;
        if (!$user) {
            $new = true;
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,

            ]);

            $user->assignRole('customer');
        }
        return [
            'new' => $new,
            'user' => $user
        ];
    }
}
