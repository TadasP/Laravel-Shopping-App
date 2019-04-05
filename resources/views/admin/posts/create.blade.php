@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('Create Post') }}</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('posts.store') }}">
            @method('POST')  
            @csrf
            
            <div class="form-group row">
                <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Categpory') }}</label>
                <div class="col-md-6">
                    <select id="category_id" class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" required>
                </div>
            </div>


            <div class="form-group row">
                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                <div class="col-md-6">
                    <textarea id="content" row="8" class="form-control" name="content">
                    </textarea>
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
                        {{ __('Create Product') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection