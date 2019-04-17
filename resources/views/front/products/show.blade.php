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
        <div style="margin:auto;" class="mb-5 mt-5"><h1>Reviews</h1></div>
    </div>
    @foreach($comments as $comment)
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="panel panel-default">
                <section class="row panel-body">
                    <section class="col-md-9">
                        <h5><a  href="{{ route('frontusers.show', $comment->user_id) }}">{{$comment->author->name}}</a></h5>
                        <div id="comment-content-{{$comment->id}}">
                            <p>{{$comment->content}}</p>
                        </div>
                    </section>
                        
                    <section id="user-description" class="col-md-3 ">
                        <section class="well">
                            <dd>{{$comment->created_at}}</dd>
                            @if($comment->user_id == Auth::user()->id)
                            <dd>
                                <a href="" style="display:inline-block;">
                                    <button class="btn btn-outline-primary btn-sm edit" value="{{$comment->id}}" type="submit">
                                        {{ __('Edit') }}
                                    </button>
                                </a>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"  onclick="return confirm('Are you sure?')" type="submit" >
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
                <h3>{{ __('Add Review') }}</h3>
                <textarea class="form-control rounded-0" id="content" row="10"  name="content" placeholder="Add review here..."></textarea>
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
<script>
    $(document).ready(function(index){
        $(".edit").each(function(){
            var commentId = $(this).val();
            $(this).click( function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('comment-form') }}",
                method: 'post',
                data: {
                    id: commentId
                },
                success: function(result){
                    $('#comment-content-' + commentId).html(result);
                }});
            });
        })
    });
</script>
@endsection