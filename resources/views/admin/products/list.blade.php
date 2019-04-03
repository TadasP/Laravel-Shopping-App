@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('All Products') }}</div>
    <div class="panel-body">
            <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="thumbnail">
                            <a href="{{ route('products.show', $product->id) }}">
                            <img style="width:150px; height:100px;" src="{{$product->img}}" alt="{{$product->name}}" style="width:100%">
                            <div class="name">
                                    <p style="text-align:center">{{$product->name}}</p>
                            </div>
                            </a>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-md-3 col-centered">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection