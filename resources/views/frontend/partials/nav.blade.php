<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">


    <a class="navbar-brand" href="{{ route('index') }}">Ecom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mt-3">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('contacts') }}">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 w-100 text-center" action="{{ route('search') }}" method="get">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="search" placeholder="Search Products" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary nav-search-btn" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </li>
      </ul>
      
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('carts') }}">
            <button class="btn btn-primary">
              <p class="d-inline">Cart</p>
              
              <span class="badge badge-danger"> 
              {{ App\Models\Cart::totalItems() }}
               </span>
            </button>
          </a>
        </li>
      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @endif
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" class="profile-image">
              {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
  </div>
</nav>
<!-- End Navbar Part -->
