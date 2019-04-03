@extends('layouts.user')

@section('content')

<div class="container main">
    <div class="row ">
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="{{ route('frontproducts.show', $product->id) }}">
                        <img class="card-img-top product-img" src="{{$product->img}}" alt="{{$product->name}}">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ route('frontproducts.show', $product->id) }}">{{$product->name}}</a>
                        </h4>
                        <h5></h5>
                        @if(isset($product->special_price))
                        <h5><del>{{$product->price}}€</del> {{$product->special_price}}€</h5>
                        @else
                        <h5>{{$product->price}}€</h5>
                        @endif
                    <p class="card-text">
                        {{ str_limit($product->description, $limit = 150, $end = '...') }}
                    </p>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="row">
            <div class="col-md-2 col-centered">
                {{$products->links()}}
            </div>
        </div>
        </div>
    </div>
</div>
@endsection