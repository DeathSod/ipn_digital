@extends('layouts.app')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Register Now!</title>
@endsection

@section('content')
    <div class="register-section">
        <h1 class="text-center">
            ¡Welcome to IPN Digital!
        </h1>
        <p class="form-header text-center">
            Please leave your information below and begin your journey into <span>advertising</span>
        </p>
        <p class="text-center">
            <button id="personForm" class="btn btn-primary">Person</button>
            <button id="companyForm" class="btn btn-default">Company</button>
        </p>
        <div class="container">
            <form action="">
                <div class="personLayout">
                    <label for="inputFirstName">First Name: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputFirstName" name="firstName" class="form-control" placeholder="Enter Your First Name">
                    <label for="inputLastName">Last Name: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputLastName" name="lastName" class="form-control" placeholder="Enter Your Last Name">
                    <label for="inputCountry">Country: <span class="requiredForm">*</span></label>
                    <select id="inputCountry" name="country" class="form-control">
                        <option selected value="choose">Choose One...</option>
                    </select>
                    <label for="inputEmail">Email: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Enter Your E-mail Here">
                    <label for="inputPassword">Password: <span class="requiredForm">*</span></label>
                    <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Insert Your Password">
                    <label for="inputRPassword">Repeat Password: <span class="requiredForm">*</span></label>
                    <input type="password" id="inputRPassword" name="repeatPwd" class="form-control" placeholder="Repeat Your Password">
                    <input class="form-check-input" name="checkboxTC_P" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      I've read the terms and conditions
                    </label>
                    <button type="submit" name="submit" class="btn btn-outline-dark offset-md-3 col-md-6">Sign in!</button>
                </div>
                <div class="companyLayout d-none">
                    <label for="inputCompany">Company Name: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputCompany" name="company" class="form-control" placeholder="Enter the name of your company here">
                    <label for="inputWebsite">Website: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputWebsite" name="website" class="form-control" placeholder="Example: https://www.ipndigital.com">
                    <label for="inputWorkArea">Company's Line of Work: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputWorkArea" name="workArea" class="form-control" placeholder="Enter your company's line of work here">
                    <label for="inputFirstNameC">First Name: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputFirstNameC" name="firstNameC" class="form-control" placeholder="Enter Your First Name">
                    <label for="inputLastNameC">Last Name: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputLastNameC" name="lastNameC" class="form-control" placeholder="Enter Your Last Name">
                    <label for="inputCountryC">Country: <span class="requiredForm">*</span></label>
                    <select id="inputCountryC" name="countryC" class="form-control">
                        <option selected value="choose">Choose One...</option>
                    </select>
                    <label for="inputEmailC">Email: <span class="requiredForm">*</span></label>
                    <input type="text" id="inputEmailC" name="emailC" class="form-control" placeholder="Enter Your E-mail Here">
                    <label for="inputPasswordC">Password: <span class="requiredForm">*</span></label>
                    <input type="password" id="inputPasswordC" name="pwdC" class="form-control" placeholder="Insert Your Password">
                    <label for="inputRPasswordC">Repeat Password: <span class="requiredForm">*</span></label>
                    <input type="password" id="inputRPasswordC" name="repeatPwdC" class="form-control" placeholder="Repeat Your Password">
                    <input class="form-check-input" name="checkboxTC_C" type="checkbox" id="gridCheckC">
                    <label class="form-check-label" for="gridCheckC">
                      I've read the terms and conditions
                    </label>
                    <button type="submit" name="submitC" class="btn btn-outline-dark offset-md-3 col-md-6">Sign in!</button>
                </div>
            </form>
        </div>
    </div>
@endsection