@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Create Shop') }}</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('shops.store') }}">
            @method('POST')  
            @csrf
            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Shop Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="shop_name">
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Shop Address') }}</label>
                <div class="col-md-6">
                    <input id="address" type="text" class="form-control" name="address">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Shop Phone') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="company_code" class="col-md-4 col-form-label text-md-right">{{ __('Company Code') }}</label>
                <div class="col-md-6">
                    <input id="company_code" type="text" class="form-control" name="company_code" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="pvm_code" class="col-md-4 col-form-label text-md-right">{{ __('Pvm Payers Code') }}</label>
                <div class="col-md-6">
                    <input id="pvm_code" type="text" class="form-control" name="pvm_code">
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
                        {{ __('Create Shop') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection