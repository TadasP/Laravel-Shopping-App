@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ __('All Product Categories') }}</div>
    <div class="panel-body">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>
                <a href="{{ route('categories.edit', $category->id) }}">
                <button class="btn btn-primary btn-sm" type="submit">
                    {{ __('Edit') }}
                </button>
                </a>
                </td>
                <td>
                @if($category->active == 1)
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit">
                        {{ __('Delete') }}
                    </button>
                </form>
                @else Not active
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection