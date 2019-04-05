@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{$post->title}}</div>
    <div class="panel-body">
            <div class="row ">
                <div class="col-8 m-auto">
                    <div class="container">
                    <p><b>Title :</b> {{$post->title}}</p>
                    <p><b>Author :</b> {{$author->name}}</p>
                    <p style="width:70%;"><b>Content :</b> {{$post->content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection