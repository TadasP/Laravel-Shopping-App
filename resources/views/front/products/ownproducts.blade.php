@extends('layouts.user')

@section('content')

<div class="container main">
    <div class="row">
        <div class="col-12">
            @if (count($products))
            <h1>Your Products</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Shop</th>
                    <th scope="col">Price</th>
                    <th scope="col">Special Price</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i = 1)
                    @foreach($products as $product)
                    <tr>
                    <th scope="row">{{$i}}</th>
                    <td>
                        <a href="{{ route('frontproducts.show', $product->id) }}">
                        {{$product->name}}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('shopping.show', $product->shop->id) }}">
                        {{$product->shop->shop_name}}
                        </a>
                    </td>
                    <td>{{$product->price}} €</td>
                    <td>
                        @if($product->special_price)
                        {{$product->special_price}} €
                        @else
                        None
                        @endif
                    </td>
                    <td>
                        @if($product->weight && $product->unit_id)
                        {{$product->weight}} {{$product->unit_id}}
                        @else
                        None
                        @endif
                    </td>
                    <td>{{$product->qty}}</td>
                    <td>
                        {{ str_limit($product->description, $limit = 25, $end = '...') }}
                    </td>
                    <td>
                    <a href="{{ route('frontproducts.edit', $product->id) }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Edit') }}
                    </button>
                    </a>
                    </td>
                    <td>
                    <form action="{{ route('frontproducts.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" type="submit">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    </td>
                    @php ($i++)
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h1>You have no products</h1>
            @endif
            <a href="{{ route('frontproducts.create') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Add New Product') }}
                </button>
            </a>
        </div>
    </div>
</div>

@endsection