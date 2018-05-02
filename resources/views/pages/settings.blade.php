@extends('layouts.nav')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Your Settings</title>
@endsection

@section('navbar')
    @include('../layouts/nav')
@endsection

@section('content-main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Settings</h1>
    </div>
    {{-- <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
