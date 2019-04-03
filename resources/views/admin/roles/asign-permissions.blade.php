@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Asign Permissions') }}</div>
    <div class="panel-body">
        <form method="POS" action="{{ route('roles.store-permission') }}">
            @method('POST')  
            @csrf

            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                <div class="col-md-6">
                    <select id="role" class="form-control" name="role">
                        {{$i = 0}}
                        @foreach($roles as $role)
                            @if($i == 0)
                            <option selected value="{{$role->id}}">{{$role->name}}</option>
                            @else
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                            {{$i = 1}}
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="permissions" class="col-md-4 col-form-label text-md-right">{{ __('Permissions') }}</label>
                <div class="col-md-6">
                    @foreach($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$permission->id}}" id="{{$permission->name}}" name="permissions[]">
                        <label class="form-check-label" for="{{$permission->name}}">
                            {{$permission->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Asign Permissions') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection