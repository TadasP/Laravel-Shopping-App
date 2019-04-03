@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('All Roles') }}</div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <th scope="row">{{$role->id}}</th>
                    <td>{{$role->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection