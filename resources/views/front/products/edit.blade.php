@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-7">
        <form method="POST" action="{{ route('frontproducts.update', $product->id) }}">
            @method('PUT')  
            @csrf
            
            <div class="form-group">
                <label for="shop_id">{{ __('Shop') }}</label>
                <br>  
                <select id="shop_id" class="form-control" name="shop_id" required>
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control" name="name" value="{{$product->name}}" required>
            </div>

            <div class="form-group">
                <label for="qty">{{ __('Quantity') }}</label>
                <input id="qty" type="number" class="form-control" name="qty" value="{{$product->qty}}" required>
            </div>

            <div class="form-group">
                <label for="price">{{ __('Price') }}</label>
                <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{$product->price}}" required>
            </div>

            <div class="form-group">
                <label for="special_price">{{ __('Special price') }}</label>
                <input id="special_price" type="number" step="0.01" class="form-control" name="special_price" value="{{$product->special_price}}">
            </div>

            <div class="form-group">
                <label for="unit_id">{{ __('Weight units') }}</label>
                <select id="unit_id" class="form-control" name="unit_id">
                    <option selected value="">None</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="l">l</option>
                    <option value="ml">ml</option>
                </select>
            </div>

            <div class="form-group">
                <label for="weight">{{ __('Weight') }}</label>
                <input id="weight" type="number" step="0.01" class="form-control" name="weight" value="{{$product->weight}}">
            </div>

            <div class="form-group">
                <label for="img">{{ __('Image') }}</label>
                <input id="img" type="text" class="form-control" name="img" value="{{$product->img}}" required>
            </div>

            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                    <textarea id="description" rows="8" class="form-control" name="description">
                    {{$product->description}}
                    </textarea>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
            </div>
            @endif
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Product') }}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection