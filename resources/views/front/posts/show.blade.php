@extends('layouts.user')

@section('content')

<section class="container main">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <section class="panel-title">
                        <time class="pull-right">
                        {{$post->created_at}}
                        </time>
                    </section>
                </div>
                <section class="row panel-body">
                    <section class="col-md-9">
                        <h2>{{$post->title}}</h2>
                        <hr>
                        <p>{{$post->content}}</p>
                    </section>
                      
                    <section id="user-description" class="col-md-3 ">
                        <section class="well">
                            <h3><a  href="{{ route('frontusers.show', $author->id) }}">{{$author->name}}</a></h3>
                            <figure>
                            <img 
                            class="img-rounded img-responsive"
                            @if (!empty($author->contacts->photo))
                            src="{{$author->contacts->photo}}"
                            @else
                            src="https://www.viawater.nl/files/default-user.png" 
                            @endif
                            alt="{{$author->name}}"
                            style="width:150px; height:150px"
                            />
                            </figure>
                            <dl class="dl-horizontal">
                            <dt>Join date:</dt>
                            <dd>{{$author->created_at}}</dd>
                            <dt>Posts:</dt>
                            <dd>{{$posts}}</dd>
                        </dl>
                        
                        </section>
                    </section>
                </section>
            </div>
        </div>
    </div>
    <hr>
    @foreach($comments as $comment)
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="panel panel-default">
                <section class="row panel-body">
                    <section class="col-md-9">
                        <h5><a  href="{{ route('frontusers.show', $comment->user_id) }}">{{$comment->author->name}}</a></h5>
                        <p>{{$comment->content}}</p>
                    </section> 
                    <section id="user-description" class="col-md-3 ">
                        <section class="well">
                            <dl class="dl-horizontal">
                            <dd>{{$comment->created_at}}</dd>
                            @if($comment->user_id == Auth::user()->id)
                            <dd>
                                <a href="{{ route('comments.edit', $comment->id) }}" style="display:inline-block;">
                                    <button class="btn btn-outline-primary btn-sm" type="submit">
                                        {{ __('Edit') }}
                                    </button>
                                </a>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" type="submit" >
                                        {{ __('Delete') }}
                                    </button>
                                </form> 
                            <dd>
                            @endif
                        </section>
                    </section>
                </section>
            </div>
        </div>
    </div>
    <hr>
    @endforeach

    <div class="row mt-5">
        <div class="col-5">
        <form method="POST" action="{{ route('comments.store') }}">
            @method('POST')  
            @csrf

            <input type="hidden" id="type" name="type" value="{{base64_encode(1)}}">
            <input type="hidden" id="type_id" name="type_id" value="{{base64_encode($post->id)}}">
            
            <div class="form-group">
                <label for="content">{{ __('Add Comment') }}</label>
                <textarea id="content" row="1" class="form-control" name="content">
                </textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{ __('Add') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</section>
@endsection