<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @if(Auth::check())
      @if(Route::has('login-view'))
        <a class="navbar-brand" href="{{ route('show-activities') }}">Home</a>
      @endif
    @else
      <a class="navbar-brand" href="#">Navbar</a>

    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          @if(Auth::check())
            @if(Route::has('login-view'))
              <a class="nav-link" href="{{ route('/') }}">{{ now()->format('l') }} <span class="sr-only">(current)</span></a>
            @endif
          @else
              <a class="nav-link" href="{{ route('/') }}">Home <span class="sr-only">(current)</span></a>
          @endif
        </li>
        <li class="nav-item">
          @if (Auth::check())
            @if(Route::has('login-view'))
            <a class="nav-link" href="#">{{ Auth::user()->districts->districtName }}</a>
            @endif
          @else
            <a class="nav-link" href="#">About Us</a>

          @endif
        </li>
        <li class="nav-item">
          @if(Auth::check())
            @if(Route::has('login-view'))
              <a class="nav-link" href="#">{{ Auth::user()->circles->circleName }}</a>
            @endif
          @else
              <a class="nav-link" href="#">Contact Us</a>
          @endif
        </li>

        <li class="nav-item">
          @if(Auth::check())
            @if(Route::has('login-view'))
              <a class="nav-link" href="{{ route('user.index') }}">Create Activity</a>
            @endif
          @else
              <a class="nav-link" href="#"></a>
          @endif
        </li>


        <li class="nav-item">
            @if(Auth::check())
              @if(Route::has('login-view'))
                <a class="nav-link" href="{{ route('get-password') }}">Change Password</a>
              @endif
            @else
                <a class="nav-link" href="#"></a>
            @endif
          </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        @if (Auth::check())
          @if(Route::has('login-view'))
            <a href="{{ route('user.index') }}" class="btn btn-outline-success m-2 my-sm-2">Hello {{Auth::user()->name }}</a>
            <a href="{{ route('logout') }}" class="btn btn-outline-success m-2 my-sm-2">Logout</a>
          @endif

        @else
        <a href="{{ route('login-view') }}" class="btn btn-outline-success m-2 my-sm-2">Login</a>
        <a href="{{ route('user-register') }}" class="btn btn-outline-success m-2 my-sm-2">Register</a>
        @endif
      </form>
    </div>
  </nav>
