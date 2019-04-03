@extends('layouts.user')

@section('css')
<link href="{{ asset('css/category-tree.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-7">
        <form method="POST" action="{{ route('frontproducts.store') }}">
            @method('POST')  
            @csrf
            
            <div class="form-group">
                <label for="shop_id">{{ __('Shop') }}</label>
                @if(count($shops) == 0)
                <br>
                <a href="{{ route('shopping.create') }}">{{ __('Create Shop')}}</a>
                @endif          
                <select id="shop_id" class="form-control" name="shop_id" required>
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="qty">{{ __('Quantity') }}</label>
                <input id="qty" type="number" class="form-control" name="qty" required>
            </div>

            <div class="form-group">
                <label for="price">{{ __('Price') }}</label>
                <input id="price" type="number" step="0.01" class="form-control" name="price" required>
            </div>

            <div class="form-group">
                <label for="special_price">{{ __('Special price') }}</label>
                <input id="special_price" type="number" step="0.01" class="form-control" name="special_price">
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
                <input id="weight" type="number" step="0.01" class="form-control" name="weight">
            </div>

            <div class="form-group">
                <label for="img">{{ __('Image') }}</label>
                <input id="img" type="text" class="form-control" name="img" required>
            </div>

            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                    <textarea id="description" rows="8" class="form-control" name="description">
                    </textarea>
            </div>

            <div class="form-group">
                <label for="category">{{ __('Categories:') }}</label>
                <div class="col-md-8">
                    {!! $categories !!}
                </div>
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
                    {{ __('Create Product') }}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/category-tree.js') }}"></script>

@endsection