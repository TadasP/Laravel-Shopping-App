@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{$product->name}}</div>
    <div class="panel-body">
            <div class="row ">
                <div class="col-8 m-auto">
                    <div class="container">
                    <p><b>Product name :</b> {{$product->name}}</p>
                    <p><b>Product price :</b> {{$product->price}}</p>
                    <p><b>Product special price :</b> {{$product->special_price}}</p>
                    <p><b>Product weight :</b> {{$product->weight}}</p>
                    <p><b>Product weight unit :</b> {{$product->unit_id}}</p>
                    <p><b>Product quantity :</b> {{$product->qty}}</p>
                    <p><b>Product description :</b> {{$product->description}}</p>
                    <p><b>Product photo :</b> {{$product->img}}</p>
                    <p>
                    <b>Active :</b> 
                    @if( $product->active == 1)
                    {{ __('Yes') }}
                    @else
                    {{ __('No') }}
                    @endif
                    </p>
                    <a href="{{ route('products.edit', $product->id) }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Edit Product') }}
                    </button>
                    </a>
                    @if($product->active == 1)
                    <br>
                    <br>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" >
                            {{ __('Delete Product') }}
                        </button>
                    </form>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection