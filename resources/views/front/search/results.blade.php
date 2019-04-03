@extends('layouts.user')

@section('content')
<div class="container main">
    @if(isset($error))
    <div class="row mb-5">
        <div class="col-12">
            <h1 style="color:red">{{$error}}</h1>
        </div>
    </div>
    @else
    <div class="row mb-5">
        <div class="col-12">
            <h3>Searching by: {{$searchNeedle}}</h3>
        </div>
    </div>
    @if (count($posts) || count($shops) || count($products))
        @if (count($products))
        <div class="row">
            <div class="col-12">
                <h1>Products</h1>
            </div>
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
        @endif
        @if (count($shops))
        <div class="row">
            <div class="col-12">
                <h1>Shops</h1>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($i = 1)
                        @foreach($shops as $shop)
                        <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                            <a href="{{ route('shopping.show', $shop->id) }}">
                                {{$shop->shop_name}}
                            </a>
                        </td>
                        <td>{{$shop->shop_address}}</td>
                        <td>{{$shop->shop_phone}}</td>
                        @php ($i++)
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @if (count($posts))
        <div class="row">
            <div class="col-12">
                <h1>Posts</h1>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($i = 1)
                        @foreach($posts as $post)
                        <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                        <a href="{{ route('frontposts.show', $post->id) }}">
                        {{$post->title}}
                        </a>
                        </td>
                        <td>
                            {{ str_limit($post->content, $limit = 200, $end = '...') }}
                        </td>
                        @php ($i++)
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    @else
    <h2>We can't find anything with your description</h2>
    @endif
    @endif
</div>
@endsection