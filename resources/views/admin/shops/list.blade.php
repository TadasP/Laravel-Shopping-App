@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('All Shops') }}</div>
    <div class="panel-body">
            <div class="row">
            @foreach($shops as $shop)
                <div class="col-md-3">
                    <div class="thumbnail">
                        <a href="{{ route('shops.show', $shop->id) }}">
                        <img style="width:140px; height:140px;" src="https://static1.squarespace.com/static/5ad3a0fb9f8770bff01a5fb9/t/5c3fce70c2241bef1d9129fe/1547817040053/shop+website+thumbnail.png?format=500w" alt="{{$shop->name}}" style="width:100%">
                        <div class="name">
                                <p style="text-align:center">{{$shop->shop_name}}</p>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-md-3 col-centered">
                    {{$shops->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection