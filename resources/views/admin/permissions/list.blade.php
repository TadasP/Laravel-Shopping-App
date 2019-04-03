@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('All Permissions') }}</div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <th scope="row">{{$permission->id}}</th>
                    <td>{{$permission->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection