@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-7">
        <form method="POST" action="{{ route('frontusers.update', $user->id) }}">
            @method('PUT')  
            @csrf
            
            <div class="form-group row">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required>
            </div>

            <div class="form-group row">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="text" class="form-control" name="email" value="{{$user->email}}" required>
            </div>
                
            <div class="form-group row">
                <label for="address">{{ __('Address') }}</label>
                <input id="address" type="text" class="form-control" name="address" 
                    @if (isset($contact->address))
                    value="{{$contact->address}}"
                    @endif
                >
            </div>

            <div class="form-group row">
                <label for="phone">{{ __('Phone') }}</label>
                <input id="phone" type="text" class="form-control" name="phone"
                    @if (isset($contact->phone))
                    value="{{$contact->phone}}"
                    @endif
                >
            </div>

            <div class="form-group row">
                <label for="photo">{{ __('Photo') }}</label>
                <input id="photo" type="text" class="form-control" name="photo"
                    @if (isset($contact->photo))
                    value="{{$contact->photo}}"
                    @endif
                >
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
            </div>
            @endif
            
            <div class="form-group row">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Profile') }}
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection