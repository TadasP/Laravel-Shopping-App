@extends('layouts.user')

@section('content')

<div class="container main">
    <div class="row">
        <div class="col-12">
            @if (count($posts))
            <h1>Your Posts</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i = 1)
                    @foreach($posts as $post)
                    <tr>
                    <th scope="row">{{$i}}</th>
                    <td>
                    <a href="{{ route('frontposts.show', $post->id) }}">
                    {{$post->title}}
                    </a>
                    </td>
                    <td>
                        {{ str_limit($post->content, $limit = 200, $end = '...') }}
                    </td>
                    <td>
                    <a href="{{ route('frontposts.edit', $post->id) }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Edit') }}
                    </button>
                    </a>
                    </td>
                    <td>
                    <form action="{{ route('frontposts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    </td>
                    @php ($i++)
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h1>You have no posts</h1>
            @endif
            <a href="{{ route('frontposts.create') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Add New Post') }}
                </button>
            </a>
        </div>
    </div>
</div>
@endsection