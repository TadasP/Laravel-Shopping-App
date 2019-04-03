@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Edit Your Category') }}</div>

    <div class="panel-body">
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @method('PUT')  
            @csrf
            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{$category->name}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <textarea id="description" row="8" class="form-control" name="description">{{$category->description}}</textarea>
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

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Category') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection