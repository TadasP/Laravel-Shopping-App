@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Create Category') }}</div>

    <div class="panel-body">
        <form method="POST" action="{{ route('categories.store') }}">
            @method('POST')  
            @csrf
            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                <div class="col-md-6">
                    <select id="type" class="form-control" name="type">
                        <option selected value="0">Product Category</option>
                        <option value="1">Post Category</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('Parent Category') }}</label>
                <div class="col-md-6">
                    <select id="parent_id" class="form-control" name="parent_id">
                        <option selected value="0">None</option>
                        @foreach($parent_categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <textarea id="description" row="8" class="form-control" name="description"></textarea>
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
                        {{ __('Create Category') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection