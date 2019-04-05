@extends('layouts.user')

@section('content')

<div class="container main">
    <div class="row">
        <div class="col-12">
            @if (count($shops))
            <h1>Your Shops</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Company Code</th>
                    <th scope="col">Pvm Payer's Code</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
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
                    <td>{{$shop->shop_code}}</td>
                    <td>{{$shop->pvm_code}}</td>
                    <td>
                    <a href="{{ route('shopping.edit', $shop->id) }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Edit') }}
                    </button>
                    </a>
                    </td>
                    <td>
                    <form action="{{ route('shopping.destroy', $shop->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" type="submit">
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
            <h1>You have no shops</h1>
            @endif
            <a href="{{ route('shopping.create') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Create New Shop') }}
                </button>
            </a>
        </div>
    </div>
</div>
@endsection