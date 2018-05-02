@extends('layouts.app')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Register Now!</title>
@endsection

@section('navbar')
    @include('../layouts/nav')
@endsection

@section('content')
    <div class="register-section">
        <div class="py-5">
            <h1 class="text-center">
                ¡Welcome to IPN Digital!
            </h1>
            <p class="form-header text-center">
                If you already have an account please <a href="/login">log in</a>.
            </p>
            <p class="text-center">
                <button id="personForm" class="btn btn-primary btn-form col-md-2 m-0">Person</button>
                <button id="companyForm" class="btn btn-form col-md-2 m-0">Company</button>
            </p>
            <div class="container">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {!! session()->get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="/people">
                    {{ csrf_field() }}
                    <div id="personLayout" class="my-4">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputFirstName">First Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputFirstName" name="firstName" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" placeholder="Enter Your First Name" value="{{ old('firstName') }}">
                                @if ($errors->has('firstName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group col">
                                <label for="inputLastName">Last Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputLastName" name="lastName" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" placeholder="Enter Your Last Name" value="{{ old('lastName') }}">
                                @if ($errors->has('lastName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputCountry">Country: <span class="requiredForm">*</span></label>
                            <select id="inputCountry" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}">
                                <option selected value="choose">Choose One...</option>
                                @foreach($places as $place)
                                    <option value="{{ $place->PL_Name }}"> {{ $place->PL_Name }} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email: <span class="requiredForm">*</span></label>
                            <input type="text" id="inputEmail" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter Your E-mail Here" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputPassword" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Insert Your Password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="inputRPassword">Repeat Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputRPassword" name="password_confirmation" class="form-control" placeholder="Repeat Your Password">
                        </div>

                        <div class="form-group">
                            <p class="text-center col"><input class="form-check-input" name="termsAndConditions" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                            I've read the terms and conditions
                            </label></p>
                        </div>

                        <p class="text-center"><button type="submit" name="submit" class="btn btn-outline-dark col-md-5">Sign in!</button></p>
                    </div>
                </form>
                <form method="POST" action="/companies">
                    
                    {{ csrf_field() }}

                    <div id="companyLayout" class="d-none my-4">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputCompany">Company Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputCompany" name="company" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" placeholder="Enter the name of your company here" value="{{ old('company')}}">
                                @if ($errors->has('company'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col">
                                <label for="inputWebsite">Website: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputWebsite" name="website" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" placeholder="Example: https://www.ipndigital.com" value="{{ old('website') }}">
                                @if ($errors->has('website'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col">
                                <label for="inputWorkArea">Company's Line of Work: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputWorkArea" name="workArea" class="form-control{{ $errors->has('workArea') ? ' is-invalid' : '' }}" placeholder="Example: Technology, Agriculture, Construction" value="{{ old('workArea') }}">
                                @if ($errors->has('workArea'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('workArea') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputFirstNameC">Contact's First Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputFirstNameC" name="firstNameContact" class="form-control{{ $errors->has('firstNameContact') ? ' is-invalid' : '' }}" placeholder="Enter Your First Name" value="{{ old('firstNameContact') }}">
                                @if ($errors->has('firstNameContact'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstNameContact') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col">
                                <label for="inputLastNameC">Contact's Last Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputLastNameC" name="lastNameContact" class="form-control{{ $errors->has('lastNameContact') ? ' is-invalid' : '' }}" placeholder="Enter Your Last Name" value="{{ old('lastNameContact') }}">
                                @if ($errors->has('lastNameContact'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastNameContact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputCountryC">Country: <span class="requiredForm">*</span></label>
                            <select id="inputCountryC" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}">
                                <option selected value="choose">Choose One...</option>
                                @foreach($places as $place)
                                    <option> {{ $place->PL_Name }} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="inputEmailC">Email: <span class="requiredForm">*</span></label>
                            <input type="text" id="inputEmailC" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter Your E-mail Here" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="inputPasswordC">Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputPasswordC" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Insert Your Password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="inputRPasswordC">Repeat Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputRPasswordC" name="password_confirmation" class="form-control" placeholder="Repeat Your Password">
                        </div>

                        <div class="form-group">
                            <p class="text-center">
                                <input class="form-check-input{{ $errors->has('termsAndConditions') ? ' is-invalid' : '' }}" name="termsAndConditions" type="checkbox" id="gridCheckC">
                                <label class="form-check-label" for="gridCheckC">
                                    I've read the terms and conditions
                                </label>
                            </p>
                            <p>
                                @if ($errors->has('termsAndConditions'))
                                    <span class="invalid-feedback text-center">
                                        <strong>{{ $errors->first('termsAndConditions') }}</strong>
                                    </span>
                                @endif
                            </p>
                        </div>

                        <p class="text-center"><button type="submit" name="submit" class="btn btn-outline-dark col-md-6">Sign in!</button></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
