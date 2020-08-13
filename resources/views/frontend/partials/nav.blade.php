<nav class="navbar navbar-expand-md navbar-background sticky-top">
    <a>
        <i class="fa fa-bar" id="sidebar-hamburger-icon"></i>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-brand">
        Shop
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link navbar-link" href="{{ route('index') }}">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link navbar-link" href="{{ route('products') }}">Products</a>
            </li>

            <li class="nav-item">
                <a class="nav-link navbar-link" href="{{ route('contacts') }}">Contact Us</a>
            </li>

            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}">
                    <div class="input-group">
                        <input type='text' class="form-control search-form" placeholder="Search Products">
                        <span class="input-group-btn">
                            <button type="submit" class="btn search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <a href="#" class="nav-cart-btn">Cart
                <span class="nav-cart-quantity">{{ App\Models\Cart::totalItems() }}
                </span>
            </a>
            @guest

            <li class="nav-item">
                <a class="nav-link navbar-link" href="{{ route('login') }}">Login</a>
            </li>

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link navbar-link" href="{{ route('register') }}">Register</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" class="profile-image">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest

        </ul>
    </div>
</nav>
