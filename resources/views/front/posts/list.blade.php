@extends('layouts.user')
@section('content')

<div class="container main">
    <div class="row">   
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>CATEGORIES</th>
                        <th>POSTS</th>
                        <th>DATE</th>        
                    </tr>
                </thead>
                <tbody>
                @php($i = 0)
                @foreach($categories as $category)
        
                @if($i == 0)
                <tr>
                    <td>
                    <a href="{{ route('frontposts.post-list', $category->id) }}">
                    <span style="font-size:26px;">{{$category->name}}</span><br/>{{$category->description}}
                    </a>
                    </td>
                    <td>{{$category->posts->count()}}</td>
                    <td>{{$category->created_at}}</td>
                </tr>
                @php($i++)

                @else
                <tr class="active">
                    <td>
                    <a href="{{ route('frontposts.post-list', $category->id) }}">
                    <span style="font-size:26px;">{{$category->name}}</span><br/>{{$category->description}}
                    </a>
                    </td>
                    <td>{{$category->posts->count()}}</td>
                    <td>{{$category->created_at}}</td>
                </tr>
                @php($i = 0)
                @endif

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection