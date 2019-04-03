@extends('layouts.user')
@section('content')

<div class="container main">
    <div class="row">   
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>POST</th>
                        <th>REPLIES</th>
                        <th>AUTHOR</th>
                        <th>DATE</th>      
                    </tr>
                </thead>
                <tbody>
                @php($i = 0)
                @foreach($posts as $post)
        
                @if($i == 0)
                <tr>
                    <td><a href="{{ route('frontposts.show', $post->id) }}"><span style="font-size:26px;">{{$post->title}}</span></a></td>
                    <td>{{$post->comments->count()}}</td>
                    <td><a href="{{ route('frontusers.show', $post->user_id) }}">{{$post->author->name}}</a></td>
                    <td>{{$post->created_at}}</td>
                </tr>
                @php($i++)

                @else
                <tr class="active">
                    <td><a href="{{ route('frontposts.show', $post->id) }}"><span style="font-size:26px;">{{$post->title}}</span></a></td>
                    <td>{{$post->comments->count()}}</td>
                    <td><a href="{{ route('frontusers.show', $post->user_id) }}">{{$post->author->name}}</a></td>
                    <td>{{$post->created_at}}</td>
                </tr>
                @php($i = 0)
                @endif

                @endforeach
                </tbody>
            </table>
            <a href="{{ route('frontposts.create') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Add New Post') }}
                </button>
            </a>
        </div>
    </div>
</div>
@endsection