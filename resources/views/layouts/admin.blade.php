<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Catalog App') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/admin/admin-panel.js') }}" defer></script>

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    
    <!-- Style -->
    <link href="{{ asset('css/admin/admin-panel.css') }}" rel="stylesheet">
    
    @yield('css')
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

</head>
<body>
    <div id="app">
        <div class="container">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            Administrator Panel
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{route('frontusers.show', Auth::user()->id )}}">Visit Site</a>
                            </li>
                            <li class="dropdown " > 
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <span class="caret"></span></a>

                                <ul class="dropdown-menu" role="menu">
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
            <div class="container-fluid main-container">
                <div class="col-md-2 sidebar">
                    <div class="row">
                        <div class="side-menu">
                            <nav class="navbar navbar-default" role="navigation">
                                <!-- Main Menu -->
                                <div class="side-menu-container">
                                    <ul class="nav navbar-nav">
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl1">
                                                <span class="glyphicon glyphicon-user"></span>  {{ __('Products') }} <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('products.index') }}">{{ __('All Products') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('products.create') }}">{{ __('Create Product') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl7">
                                                <span class="glyphicon glyphicon-dashboard"></span>  {{ __('Posts') }} <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl7" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('posts.index') }}">{{ __('All Posts') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('posts.create') }}">{{ __('Create Post') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl2">
                                                <span class="glyphicon glyphicon-plane"></span> {{ __('Categories') }} <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('categories.product-categories') }}">{{ __('All Product Categories') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('categories.post-categories') }}">{{ __('All Post Categories') }}</a>
                                                        </li>      
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('categories.create') }}">{{ __('Create Category') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl3">
                                                <span class="glyphicon glyphicon-user"></span> {{ __('Users') }} <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('users.index') }}">{{ __('All Users') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl4">
                                                <span class="glyphicon glyphicon-cloud"></span> {{ __('Shops') }} <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl4" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('shops.index') }}">{{ __('All Shops') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('shops.create') }}">{{ __('Create Shop') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl5">
                                                <span class="glyphicon glyphicon-dashboard"></span> {{ __('Roles') }} <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl5" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('roles.index') }}">{{ __('All Roles') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('roles.create') }}">{{ __('Create Role') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('roles.asign-permission') }}">{{ __('Assign Permissions') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('roles.asign-role') }}">{{ __('Assign Roles') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl6">
                                                <span class="glyphicon glyphicon-cloud"></span> {{ __('Permissions') }} <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl6" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('permissions.index') }}">{{ __('All Permissions') }}</a>
                                                        </li>
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('permissions.create') }}">{{ __('Create Permission') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>  		
                </div>
                <div class="col-md-10 content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@yield('js')
</body>
</html>
