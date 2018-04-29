@extends('layouts.app');

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Login</title>
@endsection

@section('content')
    <div class="login-body my-4">
        <form class="form-signin" method="POST">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
                <p class="form-header text-center">
                    If you still don't have an account please <a href="/register">register here</a>.
                </p>
            </div>
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
            </div>
            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
        </form>
    </div>
@endsection