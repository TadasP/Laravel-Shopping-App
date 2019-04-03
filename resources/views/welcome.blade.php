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
  </head>
  <body>
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container">
            <a class="navbar-brand" href="">ShareProduct.lt</a>
            @auth
            <a  class="btn btn-primary" href="{{ url('/home') }}">Home</a>
            @else
                <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <header class="masthead text-white text-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Create your own shop and sell your products via our amazing app!</h1>
          </div>
          @auth
          @else
              <div class="col-md-4 col-lg-4 col-xl-4 mx-auto">
                  <div class="text-center">
                      <a href="{{ route('register') }}"><button type="submit" class="btn btn-block btn-lg btn-primary" style="margin:auto !important;">Sign up now!</button></a>
                  </div>
              </div>
          @endauth
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

    <footer class="footer">
      <div class="container">
        <div class="footer-copyright text-center py-3">© 2019 Copyright:
          <a href=""> ShareProduct.lt</a>
        </div>
      </div>
    </footer>
  </body>
</html>
