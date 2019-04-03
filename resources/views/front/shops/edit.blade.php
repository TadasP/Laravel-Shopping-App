@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-7">
        <form method="POST" action="{{ route('shopping.update', $shop->id) }}">
            @method('PUT')  
            @csrf
            
            <div class="form-group row">
                <label for="name">{{ __('Shop Name') }}</label>
                <input id="name" type="text" class="form-control" name="name" value="{{$shop->shop_name}}" required>
            </div>

            <div class="form-group row">
                <label for="address">{{ __('Shop Address') }}</label>
                <input id="address" type="text" class="form-control" name="address" value="{{$shop->shop_address}}">
            </div>

            <div class="form-group row">
                <label for="phone">{{ __('Shop Phone') }}</label>
                <input id="phone" type="text" class="form-control" name="phone" value="{{$shop->shop_phone}}" required>
            </div>

            <div class="form-group row">
                <label for="company_code">{{ __('Company Code') }}</label>
                <input id="company_code" type="text" class="form-control" name="company_code" value="{{$shop->shop_code}}" required>
            </div>

            <div class="form-group row">
                <label for="pvm_code">{{ __('Pvm Payers Code') }}</label>
                <input id="pvm_code" type="text" class="form-control" name="pvm_code" value="{{$shop->pvm_code}}" required>
            </div>

            <div class="form-group row">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Shop') }}
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection