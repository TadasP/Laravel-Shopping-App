@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-7">
        <form method="POST" action="{{ route('shopping.store') }}">
            @method('POST')  
            @csrf
            
            <div class="form-group row">
                <label for="name">{{ __('Shop Name') }}</label>
                <input id="name" type="text" class="form-control" name="name">
            </div>

            <div class="form-group row">
                <label for="address">{{ __('Shop Address') }}</label>
                <input id="address" type="text" class="form-control" name="address">
            </div>

            <div class="form-group row">
                <label for="phone">{{ __('Shop Phone') }}</label>
                <input id="phone" type="text" class="form-control" name="phone" required>
            </div>

            <div class="form-group row">
                <label for="company_code">{{ __('Company Code') }}</label>
                <input id="company_code" type="text" class="form-control" name="company_code" required>
            </div>

            <div class="form-group row">
                <label for="pvm_code">{{ __('Pvm Payers Code') }}</label>
                <input id="pvm_code" type="text" class="form-control" name="pvm_code">
            </div>

            <div class="form-group row">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create Shop') }}
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection