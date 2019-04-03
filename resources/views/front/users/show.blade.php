@extends('layouts.user')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <img 
                @if (!empty($user->contacts->photo))
                src="{{$user->contacts->photo}}"
                @else
                src="https://www.viawater.nl/files/default-user.png" 
                @endif
                alt="{{$user->name}}"
                style="width:150px; height:150px"
                />
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
                    {{$user->name}}
                </h5>
                <h6>
                    @php ( $roles = $user->getRoleNames())
                    @foreach ($roles as $role){
                        {{$role}}
                    }
                    @endforeach
                </h6>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Statistics</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            @if(Auth::user()->id == $user->id)
            <a href="{{ route('frontusers.edit', $user->id) }}">
            <button type="button" class="btn btn-primary btn-sm" style="margin-bottom:5px;">Edit Profile</button>
            </a>
            <form action="{{ route('frontusers.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit" >
                    {{ __('Delete Profile') }}
                </button>
            </form> 
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$user->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$user->email}}</p>
                        </div>
                    </div>
                    @if ($user->contacts == null)
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$user->contacts->phone}}</p>   
                        </div>
                    </div>
                    @endif
                    @if ($user->contacts == null)
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$user->contacts->address}}</p>   
                        </div>
                    </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Number of shops</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$shops}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Number of products</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$products}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Number of posts</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$posts}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection