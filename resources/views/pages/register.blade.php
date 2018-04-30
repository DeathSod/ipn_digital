@extends('layouts.app')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Register Now!</title>
@endsection

@section('content')
    <div class="register-section">
        <div class="py-4">
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
                @if( $errors->any() )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p><strong>The following error(s) have ocurred:</strong></p>
                        @foreach($errors->all() as $err)
                            <p>{{ $err }}</p>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(session()->has('success'))
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
                                <input type="text" id="inputFirstName" name="firstName" class="form-control" placeholder="Enter Your First Name" value=
                                    @if(isset($data))
                                        "{{$data[0]['name']}}"
                                    @endif
                                >
                            </div>
                            
                            <div class="form-group col">
                                <label for="inputLastName">Last Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputLastName" name="lastName" class="form-control" placeholder="Enter Your Last Name" value=
                                @if(isset($data))
                                    "{{$data[0]['lastName']}}"
                                @endif
                            >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputCountry">Country: <span class="requiredForm">*</span></label>
                            <select id="inputCountry" name="country" class="form-control">
                                @if(!isset($data))
                                    <option selected value="choose">Choose One...</option>
                                    @foreach($places as $place)
                                        <option value="{{ $place->PL_Name }}"> {{ $place->PL_Name }} </option>
                                    @endforeach
                                @else
                                    <option value="choose">Choose One...</option>
                                    @foreach($places as $place)
                                        @if($place->PL_Name == $data[0]['country'])
                                            <option selected value="{{ $place->PL_Name }}"> {{ $place->PL_Name }} </option>
                                        @else
                                            <option value="{{ $place->PL_Name }}"> {{ $place->PL_Name }} </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email: <span class="requiredForm">*</span></label>
                            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Enter Your E-mail Here" value=
                            @if(isset($data))
                                "{{$data[0]['email']}}"
                            @endif
                        >
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Insert Your Password">
                        </div>

                        <div class="form-group">
                            <label for="inputRPassword">Repeat Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputRPassword" name="repeatPassword" class="form-control" placeholder="Repeat Your Password">
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
                                <input type="text" id="inputCompany" name="company" class="form-control" placeholder="Enter the name of your company here">
                            </div>

                            <div class="form-group col">
                                <label for="inputWebsite">Website: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputWebsite" name="website" class="form-control" placeholder="Example: https://www.ipndigital.com">
                            </div>

                            <div class="form-group col">
                                <label for="inputWorkArea">Company's Line of Work: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputWorkArea" name="workArea" class="form-control" placeholder="Example: Technology, Agriculture, Construction">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputFirstNameC">Contact's First Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputFirstNameC" name="firstNameContact" class="form-control" placeholder="Enter Your First Name">
                            </div>

                            <div class="form-group col">
                                <label for="inputLastNameC">Contact's Last Name: <span class="requiredForm">*</span></label>
                                <input type="text" id="inputLastNameC" name="lastNameContact" class="form-control" placeholder="Enter Your Last Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputCountryC">Country: <span class="requiredForm">*</span></label>
                            <select id="inputCountryC" name="country" class="form-control">
                                <option selected value="choose">Choose One...</option>
                                @foreach($places as $place)
                                    <option> {{ $place->PL_Name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputEmailC">Email: <span class="requiredForm">*</span></label>
                            <input type="text" id="inputEmailC" name="email" class="form-control" placeholder="Enter Your E-mail Here">
                        </div>

                        <div class="form-group">
                            <label for="inputPasswordC">Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputPasswordC" name="password" class="form-control" placeholder="Insert Your Password">
                        </div>

                        <div class="form-group">
                            <label for="inputRPasswordC">Repeat Password: <span class="requiredForm">*</span></label>
                            <input type="password" id="inputRPasswordC" name="repeatPassword" class="form-control" placeholder="Repeat Your Password">
                        </div>

                        <div class="form-group">
                            <p class="text-center">
                                <input class="form-check-input" name="termsAndConditions" type="checkbox" id="gridCheckC">
                                <label class="form-check-label" for="gridCheckC">
                                I've read the terms and conditions
                                </label>
                            </p>
                        </div>

                        <p class="text-center"><button type="submit" name="submit" class="btn btn-outline-dark col-md-6">Sign in!</button></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection