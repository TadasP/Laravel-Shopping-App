@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Edit User') }}</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @method('PUT')  
            @csrf
            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control" name="email" value="{{$user->email}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="text" class="form-control" name="password" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                <div class="col-md-6">
                    <select id="role_id" class="form-control" name="role_id">
                        <option selected value="1">Super Admin</option>
                        <option value="2">Admin</option>
                        <option value="3">Moderator</option>
                        <option value="4">Reseller</option>
                        <option value="5">Customer</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update User') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection