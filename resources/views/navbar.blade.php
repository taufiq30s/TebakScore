<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      @if(Auth::check())
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="/login" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->idUser}}</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::user()->admin == 0)
          <a href="{{ route('profile') }}" class="dropdown-item">{{ __('Profile') }}</a>
          <a href="{{ route('tebak') }}" class="dropdown-item">{{ __('Area Tebak Score') }}</a>
          @endif
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
      @endif
      @if(Auth::check() && Auth::user()->admin == 1)
      <li class="nav-item">
        <a class="nav-link" href="/admin">Admin Area</a>
      </li>
      @endif
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Blog
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Blog 1</a>
          <a class="dropdown-item" href="#">Blog 1</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Blog 1</a>
          <a class="dropdown-item" href="#">Blog 1</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>