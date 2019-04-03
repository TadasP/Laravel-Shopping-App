@extends('layouts.user')

@section('content')

<div class="container main">
    <div class="row">
        <div class="col-12">
            <h1>Shop List</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Products</th>
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
                        <a href="{{ route('shopping.show', $shop->id) }}">{{$shop->shop_name}}</a>
                    </td>
                    <td>{{$shop->products->count()}}</td>
                    <td>{{$shop->shop_address}}</td>
                    <td>{{$shop->shop_phone}}</td>
                    @php ($i++)
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection