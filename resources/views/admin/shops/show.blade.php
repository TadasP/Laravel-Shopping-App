@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{$shop->shop_name}}</div>
    <div class="panel-body">
            <div class="row ">
                <div class="col-8 m-auto">
                    <div class="container">
                    <p><b>Shop name :</b> {{$shop->shop_name}}</p>
                    <p><b>Shop Owner :</b> {{$owner->name}}</p>
                    <p><b>Shop Address :</b> {{$shop->shop_address}}</p>
                    <p><b>Shop Phone :</b> {{$shop->shop_phone}}</p>
                    <p><b>Company Code :</b> {{$shop->shop_code}}</p>
                    <p><b>Pvm Payers Code :</b> {{$shop->pvm_code}}</p>
                    <p>
                    <b>Active :</b> 
                    @if( $shop->active == 1)
                    {{ __('Yes') }}
                    @else
                    {{ __('No') }}
                    @endif
                    </p>
                    <a href="{{ route('shops.edit', $shop->id) }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('Edit Shop') }}
                    </button>
                    </a>
                    <br>
                    <br>
                    <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" >
                            {{ __('Delete Shop') }}
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection