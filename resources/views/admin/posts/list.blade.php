@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('All Posts') }}</div>
    <div class="panel-body">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td><a href="{{ route('posts.show', $post->id) }}">{{$post->title}}</a></td>
                <td>
                <a href="{{ route('posts.edit', $post->id) }}">
                <button class="btn btn-primary btn-sm" type="submit">
                    {{ __('Edit') }}
                </button>
                </a>
                </td>
                <td>
                @if($post->active == 1)
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit">
                        {{ __('Delete') }}
                    </button>
                </form>
                @else Not active
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection