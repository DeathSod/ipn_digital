@extends('layouts.app')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Welcome!</title>
@endsection

@section('nav-layout')
    <div class="form-box">
        <ul class="login-register row">
            <form class="form-inline" action="./includes/login.php" method="POST" accept-charset="utf-8">
                @csrf
                <li><div class="form-check">
                    <label class="form-check-label mr-2" for="rememberMe" style="color:#fff;font-family: 'GO'">Remember Me?</label>
                    <input class="form-check-input" type="checkbox" id="rememberMe" value="1">
                </div></li>
                <li><input class="form-control form-control-sm" type="text" name="user" placeholder="Enter Email" required="true"></li>
                <li><input class="form-control form-control-sm" type="password" name="password" placeholder=" Enter Password" required="true"></li>
                <li><button class="btn btn-outline-light" type="submit" name="login">Log In</button></li>
            </form>
            <li><a href="/register"><button class="btn btn-outline-light">Register Now</button></a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid jumbotron-index">
        <div class="container text-center">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-success btn-lg" href="/login" role="button">Login</a>
            <a class="btn btn-outline-primary btn-lg" href="/register" role="button">Register</a>
        </div>
    </div>
    <div class="info-container">
        <section>
            <div class="info-desc">
                <hr class="hr-info col-offset-1">
                <h2 class="text-center offset-md-4 col-md-4">With us you can</h2>
            </div>
            <div class="info row justify-content-around">
                <div class="util-ipn">
                    <figure class="figure">
                        <img class="figure-img img-fluid rounded" src="{{asset('img/buy.svg')}}" alt="">
                        <p class="text-center"><span class="font-weight-bold">Buy</span> ads</span></p>
                    </figure>
                </div>
                <div class="util-ipn">
                    <figure class="figure">
                        <img class="figure-img img-fluid rounded" src="{{asset('img/sell.svg')}}" alt="">
                        <p class="text-center"><span class="font-weight-bold">Sell</span> spaces</span></p>
                    </figure>
                </div>
                <div class="util-ipn">
                    <figure class="figure">
                        <img class="figure-img img-fluid rounded" src="{{asset('img/dfp.png')}}" alt="">
                        <p class="text-center"><span class="font-weight-bold">Connect</span> to your DFP</p>
                    </figure>
                </div>
                <div class="util-ipn">
                    <figure class="figure">
                        <img class="figure-img img-fluid rounded" src="{{asset('img/report.svg')}}" alt="">
                        <p class="text-center"><span class="font-weight-bold">Tailored</span> Reports</p>
                    </figure>
                </div>
            </div>
        </section>	
    </div>
@endsection