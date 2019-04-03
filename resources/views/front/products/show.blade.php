@extends('layouts.user')

@section('content')

<div class="container main">
    <div class="row">
        <div class="col-12">
        <div class="card mt-4">
            <img class="card-img-top img-fluid" src="{{$product->img}}" alt="{{$product->name}}">
            <div class="card-body">
                <h3 class="card-title">{{$product->name}} <span style="font-size:18px;"> left: {{$product->qty}}</span></h3>
                @if(isset($product->special_price))
                <h4><del>{{$product->price}}€</del> {{$product->special_price}}€</h4>
                @else
                <h4>{{$product->price}}€</h4>
                @endif
                @if(isset($product->weight) && isset($product->unit_id))
                <h5>{{$product->weight}} {{$product->unit_id}}</h4>
                @endif
                <p class="card-text">{{$product->description}}</p>
                <button type="button" class="btn btn-success">Buy Now!</button>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div style="margin:auto;" class="mb-5 mt-5"><h2>Reviews</h2></div>
    </div>
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

        <div class="row">
        <div class="col-5">
        <form method="POST" action="{{ route('comments.store') }}">
            @method('POST')  
            @csrf

            <input type="hidden" id="type" name="type" value="{{base64_encode(2)}}">
            <input type="hidden" id="type_id" name="type_id" value="{{base64_encode($product->id)}}">
            
            <div class="form-group">
                <label for="content">{{ __('Add Review') }}</label>
                <textarea class="form-control rounded-0" id="content" row="10"  name="content" placeholder="Add review here...">
                </textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection