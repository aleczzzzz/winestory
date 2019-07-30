@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('order.landing.index') }}">Order</a>
            <a href="{{ route('order.landing.cart') }}">
                View Cart 
                <span class="bg-secondary text-white px-2 py-1 rounded" id="cart-total">{{ session()->get('cart.total_items',0) }}</span>
            </a>
            @role('Admin')
                <a href="{{ route('dashboard.home') }}">Dashboard</a>
            @endrole
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif