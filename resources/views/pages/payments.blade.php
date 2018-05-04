@extends('layouts.nav')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Purchase History</title>
@endsection

@section('navbar')
    @include('../layouts/nav')
@endsection

@section('content-main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Purchase History</h1>
    </div>
    <div class="container">
        @if(count($payments) > 0)
            <table class="table table-bordered table-hover text-center">
                <thead class="bg-dark text-light">
                    <th scope="col">Payment</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td> {{ $payment->PA_Payment }} $ </td>
                            <td> {{ $payment->PA_Description }} </td>
                            <td> {{ Carbon\Carbon::parse($payment->created_at)->toFormattedDateString() }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You haven't done any payments so far...</p>
        @endif
    </div>
@endsection