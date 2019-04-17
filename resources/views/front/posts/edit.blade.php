@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-7">
        <form method="POST" action="{{ route('frontposts.update', $post->id) }}">
            @method('PUT')  
            @csrf

            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input id="title" type="text" class="form-control" name="title" value="{{$post->title}}" required>
            </div>

            <div class="form-group">
                <label for="content">{{ __('Content') }}</label>
                <textarea class="form-control" id="content" rows="10"  name="content">{{$post->content}}</textarea>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
            </div>
            @endif
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Post') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection