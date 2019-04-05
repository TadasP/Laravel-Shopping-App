<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ShareProduct</title>

  <script src="{{ asset('js/app.js') }}" defer></script>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  <link href="{{url('css/front/shop-homepage.css')}}" rel="stylesheet">
  @yield('css')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">ShareProduct.lt</a>
        <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('search.result') }}">
            <input class="form-control form-control-sm search-input" type="search" name="q" placeholder="Search..." aria-label="Search">
            <button class="btn btn-sm my-2 my-sm-0 mr-sm-2 search-glass" type="submit"></button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/home') }}">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">{{ __('Products') }}</a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('frontproducts.index') }}">
                                {{ __('Products Catalog') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontproducts.create') }}">
                                {{ __('Add Product') }}
                            </a>
                        </li>  
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">{{ __('Shops') }}</a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('shopping.index') }}">
                                {{ __('Shops Catalog') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('shopping.create') }}">
                                {{ __('Create Shop') }}
                            </a>
                        </li>  
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontposts.index') }}">{{ __('Forum') }}</a>
                </li>
                
                <li class="dropdown"> 
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                        @if (Auth::user()->contacts == null)
                        <img class="card-img-top nav-portret" src="https://www.viawater.nl/files/default-user.png" alt="{{Auth::user()->name}}"/>
                        @else
                        <img class="card-img-top nav-portret" src="{{Auth::user()->contacts->photo}}" alt="{{Auth::user()->name}}"/>
                        @endif
                    {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('frontusers.show', Auth::user()->id) }}">
                                {{ __('Your Profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontproducts.own-products') }}">
                                {{ __('Your Products') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('shopping.own-shops') }}">
                                {{ __('Your Shops') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontposts.own-posts') }}">
                                {{ __('Your Posts') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
    </nav>
  @yield('content')

  <footer class="bg-dark">
        <div class="container">
            <div class="footer-copyright text-center py-3" style="color:white">© 2019 Copyright 
                <a href="{{ url('/home') }}" style="color:gray"> ShareProduct.lt</a>
            </div>
        </div>
  </footer>
</body>

</html>
