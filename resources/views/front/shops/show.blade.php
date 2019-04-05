@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-md-10">
            <div class="profile-head">
                <h1>
                    {{$shop->shop_name}}
                </h1>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Owner</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            @if(Auth::user()->id == $shop->owner_id)
            <a href="{{ route('shopping.edit', $shop->id) }}">
            <button type="button" class="btn btn-primary btn-sm" style="margin-bottom:5px;">Edit Shop</button>
            </a>
            <form action="{{ route('shopping.destroy', $shop->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" type="submit" >
                    {{ __('Delete Shop') }}
                </button>
            </form> 
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="margin-top:20px;">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{$shop->shop_name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Address</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{$shop->shop_address}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{$shop->shop_phone}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Company Code</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{$shop->shop_code}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Pvm Payer's Code</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{$shop->pvm_code}}</p>
                        </div>
                    </div>   
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="margin-top:20px;">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <a href="{{ route('frontusers.show', $shop->owner_id) }}"><p>{{$shop->owner->name}}</p></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{$shop->owner->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4 mt-4"><h2>Products</h2>
        <hr>
        </div>
        
    </div>
    <div class="row">
    @foreach($shop->products as $product)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a href="{{ route('frontproducts.show', $product->id) }}">
                <img class="card-img-top product-img" src="{{$product->img}}" alt="{{$product->name}}">
            </a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('frontproducts.show', $product->id) }}">{{$product->name}}</a>
                </h4>
                <h5>€{{$product->price}}</h5>
            <p class="card-text"> {{ str_limit($product->description, $limit = 150, $end = '...') }}</p>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>        
@endsection