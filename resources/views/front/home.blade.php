@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Categories</h1>
            <div class="list-group">
                <div class="row">
                    <nav class="navbar navbar-default" role="navigation" style="width:100%;">
                        {!! $categories !!}
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                <img class="d-block img-fluid" src="{{url('img/carusel1.jpg')}}" alt="First slide" style=" width:100%; height:350px">
                </div>
                <div class="carousel-item">
                <img class="d-block img-fluid" src="{{url('img/carusel2.png')}}" alt="Second slide" style="width:100%; height:350px">
                </div>
                <div class="carousel-item">
                <img class="d-block img-fluid" src="{{url('img/carusel3.jpg')}}" alt="Third slide" style="width:100%; height:350px">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
            
            @include('front.home.products', ['products' => $productsIds]) 
        </div>
    </div>
</div>
@endsection