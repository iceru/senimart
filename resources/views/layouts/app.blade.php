<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield ('title')</title>

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
  <div id="app">
    <header>
      <nav class="navbar1" id="navbar1">
        <div class="left">
          @guest
          <div class="signin">
            <i class="fa fa-user"></i>&nbsp;<a href="{{ route('login') }}">{{ __('Login |') }}</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
          </div>
          @endif
          @else
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              Welcome, {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                  Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>

              <li>
                <a href="{{route('cart.wishindex')}}">Wishlist &nbsp;<i class="fa fa-heart"></i></a>
              </li>
            </ul>
          </li>
          @endguest
        </div>


        <div class="right" id="right">

          <a href="{{ route('cart.index') }}" id="cart">
            <div class="cart-nav">
              <p><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Cart</p>

              {{-- <span class="badge">{{ Cart::count() }}</span> --}}
            </div>
          </a>

          &nbsp;|&nbsp; {{-- 
          --}}
          <div class="search-button">
            <a href="#" class="search-toggle" data-selector="#right"> <i class="fa fa-search"
                aria-hidden="true"></i>&nbsp;Search
            </a>
          </div>
          <form action="{{ route('search') }}" method="GET" class="search-box">
            <input type="text" name="query" value="{{ request()->input('query') }}" id="query" class="text search-input"
              placeholder="Type here to search..." />
          </form>
        </div>
      </nav>
      <nav class="navbar2">
        <img src="/image/logo.png" alt="senimart" />
        <div class="burger" id="burger">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
      </nav>

      <nav class="navigation" id="nav-links">
        <ul class="nav-links">
          <img src="/image/logo.png" alt="senimart" />
          <li><a href="/">Home</a></li>
          <li><a href="{{route('artworks.index')}}">Artworks</a></li>
          <li><a href="{{route('artists.index')}}">Artists</a></li>
          <li><a href="{{route('projects.index')}}">Projects</a></li>
          <li><a href="{{route('about.index')}}">About</a></li>
        </ul>
      </nav>

    </header>

    <main>
      @yield('content')
    </main>

  </div>
  <footer>
    <img src="/image/logo.png" alt="senimart" />
    <div class="footersect">
      <div class="contactus">
        <i class="fa fa-map-marked-alt"></i>
        <h3>
          ARIMBI OFFICE SPACE <br />
          2nd floor, Suite 206
        </h3>
        <div class="break"></div>
        <p>
          Jl. Kemang Timur Raya No. 38 <br />
          Kemang, Jakarta Selatan
        </p>
        <div class="break"></div>
        <i class="fa fa-phone-alt"></i>
        <p id="p2">+62-816-627-582</p>
        <div class="break"></div>
        <i class="fa fa-envelope"></i>
        <p id="p2">contact@senimart.id</p>
      </div>
      <div class="link1">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#">Artworks</a></li>
          <li><a href="#">Artists</a></li>
          <li><a href="#">Projects</a></li>
          <li><a href="#">About</a></li>
        </ul>
      </div>
      <div class="link2">
        <ul>
          <li><a href="#">External Link</a></li>
          <li><a href="#">External Link</a></li>
          <li><a href="#">External Link</a></li>
          <li><a href="#">External Link</a></li>
        </ul>
      </div>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"
    integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <script>
    (function(){
 
    $("#cart").on("click", function() {
      $(".shopping-cart").fadeToggle( "fast");
    });
    
    })();
  </script>

  <script>
    let burger = document.getElementById('burger');
    let nav = document.getElementById('nav-links');

    burger.addEventListener('click', () => {
      nav.classList.toggle('activenav');
    });
  </script>

  <script>
    $('.right').on('click', '.search-toggle', function(e) {
  var selector = $(this).data('selector');

  $(selector).toggleClass('show').find('.search-input').focus();
  $(this).toggleClass('activenav');

  e.preventDefault();
});
  </script>

  @yield('js')




</body>

</html>