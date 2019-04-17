<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Catalog App</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
      <link href="css/landing-page.min.css" rel="stylesheet">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Catalog App') }}</title>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>

      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <div class="container">
          <a class="navbar-brand" href="{{ url('/home') }}">ShareProduct.lt</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                  @auth
                  <li class="nav-item active">
                      <a class="nav-link" href="{{ url('/home') }}">Home
                      <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  @else
                  <li class="nav-item active">
                      <a class="nav-link" href="{{ url('/login') }}">Login
                      <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="{{ url('/register') }}">Register
                      <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  @endauth
              </ul>
          </div>
          </div>
      </nav>

    <header class="masthead text-white text-center">
      <div class="container">
        <div class="row">
            @if(View::hasSection('content'))
            @yield('content')
            @else
              <div class="col-xl-9 mx-auto">
                <h1 class="mt-5">Create your own shop and sell your products via our amazing app!</h1>
              </div>
            @endif
        </div>
      </div>
    </header>

    <section class="features-icons bg-light text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <h3>Fully Responsive</h3>
              <p class="lead mb-0">This app will let you create your own custom-built internet shop!</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <h3>User Friendly</h3>
              <p class="lead mb-0">We made sure to make your experience as smooth as possible!</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-0 mb-lg-3">
              <h3>Fast and Smart</h3>
              <p class="lead mb-0">With our app youll be selling your products in no time!</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-dark">
            <div class="container">
                <div class="footer-copyright text-center py-3" style="color:white">© 2019 Copyright 
                    <a href="{{ url('/home') }}" style="color:gray"> ShareProduct.lt</a>
                </div>
            </div>
    </footer>
  </body>
</html>
