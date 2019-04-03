@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{$category->name}}</div>
    <div class="panel-body">
        <div class="row ">
            <div class="col-8 m-auto">
                <h1 class="display-4 font-weight-normal text-center">{{$category->name}}</h1>
                <p class="lead font-weight-normal text-center">{{$category->description}}</p>
                <a class="btn btn-outline-secondary mb-2" href="{{ route('categories.edit', $category->id) }}">{{ __('Edit') }}</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    <button class="btn btn-outline-secondary" type="submit" class="btn btn-primary">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection