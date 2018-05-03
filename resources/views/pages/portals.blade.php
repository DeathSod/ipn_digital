@extends('layouts.nav')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Portals</title>
@endsection

@section('navbar')
    @include('../layouts/nav')
@endsection

@section('content-main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Portals</h1>
    </div>
    <div class="d-flex d-flex justify-content-around row">
        @foreach($portals as $portal)
            <div class="card companies-card col-md-3 px-0">
                <div class="card-header text-center bg-dark">
                    <h5 class="mb-0 font-weight-bold text-light">{{ $portal->CO_Name }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-center">Please, click the button below in order to buy an add with {{ $portal->CO_Name }}</p>
                    <p class="text-center mb-0"><a href="/home/portals/{{ $portal->CO_id }}" class="btn btn-primary">Purchase an ad</a></p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
