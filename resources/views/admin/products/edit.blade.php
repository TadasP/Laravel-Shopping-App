@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Edit Your Product') }}</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @method('PUT')  
            @csrf
            
            <div class="form-group row">
                <label for="shop_id" class="col-md-4 col-form-label text-md-right">{{ __('Shop') }}</label>
                <div class="col-md-6">
                    <select id="shop_id" class="form-control" name="shop_id">
                        @foreach($shops as $shop)
                            <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{$product->name}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="qty" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
                <div class="col-md-6">
                    <input id="qty" type="number" class="form-control" name="qty" value="{{$product->qty}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                <div class="col-md-6">
                    <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{$product->price}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="special_price" class="col-md-4 col-form-label text-md-right">{{ __('Special price') }}</label>
                <div class="col-md-6">
                    <input id="special_price" type="number" step="0.01" class="form-control" name="special_price" value="{{$product->special_price}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('Weight units') }}</label>
                <div class="col-md-6">
                    <select id="unit_id" class="form-control" name="unit_id">
                        <option selected value="NULL">None</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="l">l</option>
                        <option value="ml">ml</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>
                <div class="col-md-6">
                    <input id="weight" type="number" step="0.01" class="form-control" name="weight" value="{{$product->weight}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                <div class="col-md-6">
                    <input id="img" type="text" class="form-control" name="img"  value="{{$product->img}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <textarea id="description" row="8" class="form-control" name="description">{{$product->description}}</textarea>
                </div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
            </div>
            @endif
            
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Product') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection