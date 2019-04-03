@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-7">
        <form method="POST" action="{{ route('frontposts.store') }}">
            @method('POST')  
            @csrf

            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input id="title" type="text" class="form-control" name="title" required>
            </div>

            <div class="form-group">
                <label for="category_id">{{ __('Category') }}</label>       
                <select id="category_id" class="form-control" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="content">{{ __('Content') }}</label>
                <textarea id="content" rows="10" class="form-control" name="content">
                </textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create Post') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection