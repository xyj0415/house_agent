<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/index">Database Project</a>
    </div>

    <div id="navbar" class="collapse navbar-collapse">

      <ul class="nav navbar-nav">
        <li><a href="/for_sell">Buy</a></li>
        <li><a href="/for_rent">Rent</a></li>
        <li class="dropdown">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sell<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/for_sell/create">Sell my house</a></li>
            <li><a href="/for_rent/create">Rent my house</a></li>
          </ul>
        </li>
        <li><a href="/about">About</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
          @if (!Auth::check())
              <li><a href="/login">Login</a></li>
              <li><a href="/register">Register</a></li>
          @else
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                      <li><a href="/user/{{ Auth::user()->id }}">User Center</a></li>
                      <li><a href="/transaction">Transactions</a></li>
                      <li><a href="/message">Messages</a></li>
                      @if (Auth::user()->type == 'agent')
                        <li><a href="/user/auth">Authentication</a></li>
                      @endif
                      <li><a href="{{ url('/logout') }}">Logout</a></li>
                  </ul>
              </li>
          @endif
      </ul>

    </div>

  </div>
</nav>