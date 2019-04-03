@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('All Users') }}</div>
    <div class="panel-body">
            <div class="row">
            @foreach($users as $user)
                <div class="col-md-3">
                    <div class="thumbnail">
                        <a href="{{ route('users.show', $user->id) }}">
                        @if($user->contacts == null)
                        <img style="width:100px; height:100px;" src="https://www.viawater.nl/files/default-user.png"  alt="{{$user->name}}" style="width:100%">
                        @else
                        <img style="width:100px; height:100px;" src="{{$user->contacts->photo}}" alt="{{$user->name}}" style="width:100%">
                        @endif
                        <div class="name">
                                <p style="text-align:center">{{$user->name}}</p>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-md-3 col-centered">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection