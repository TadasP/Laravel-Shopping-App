@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Create Permission') }}</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('permissions.store') }}">
            @method('POST')  
            @csrf
            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Permission') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Permission') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection