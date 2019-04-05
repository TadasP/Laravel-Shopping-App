@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{$user->name}}</div>
    <div class="panel-body">
            <div class="row ">
                <div class="col-8 m-auto">
                    <div class="container">
                    <p><b>User name :</b> {{$user->name}}</p>
                    <p><b>User email :</b> {{$user->email}}</p>
                    <p>
                    <b>Active :</b> 
                    @if( $user->active == 1)
                    {{ __('Yes') }}
                    @else
                    {{ __('No') }}
                    @endif
                    </p>
                    <a href="{{ route('users.edit', $user->id) }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Edit User') }}
                    </button>
                    </a>
                    <br>
                    <br>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit" >
                            {{ __('Delete User') }}
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection