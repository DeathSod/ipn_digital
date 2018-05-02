@extends('layouts.app')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Login</title>
@endsection

@section('navbar')
    @include('../layouts/nav')
@endsection

@section('content')
    <div class="login-body">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
                <p class="form-header text-center">
                    If you still don't have an account please <a href="/register">register here</a>.
                </p>
            </div>
            
            <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                <label for="inputEmail">Email address</label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
                <label for="inputPassword">Password</label>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="checkbox mb-3 text-center">
                <label class="">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="remember-me"> Remember me
                </label>
            </div>
            
            <div class="form-group mb-0">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary col mb-1">
                        {{ __('Login') }}
                    </button>

                    <a class="btn btn-link col" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            </div>
            <p class="mt-3 mb-3 text-muted text-center">&copy; 2017-2018</p>
        </form>
    </div>

@endsection
