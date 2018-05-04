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
    <div>
        <div class="container my-5">
            <div class="card px-0">
                <div class="card-header bg-light text-light">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item mx-1">
                            <a href="#personalInfo" class="nav-link active" id="personalInfo-tab" data-toggle="tab" role="tab" aria-controls="personalInfo" aria-selected="true">Personal Info Tab</a>
                        </li>
                        @if($user->US_isCompany == 1)
                            <li class="nav-item mx-1">
                                <a href="#dfp" class="nav-link" id="dfp-tab" role="tab" data-toggle="tab" aria-controls="dfp" aria-selected="false">DFP Settings Tab</a>
                            </li>
                        @endif
                        <li class="nav-item mx-1">
                            <a href="#credits" class="nav-link" id="credits-tab" role="tab" data-toggle="tab" aria-controls="credits" aria-selected="false">Credits Tab</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="personalInfo" role="tabpanel" aria-labelledby="personalInfo-tab">
                        <ul class="list-group list-group-flush">
                            @if($user->people)
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">First Name(s): </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->people->PE_Name }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#nameModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Last Name(s): </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->people->PE_LastName }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#lastNameModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Email: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->email }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#emailModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Password: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> ******** </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#passwordModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Delete Account: </h5>
                                        <p class="col"></p>
                                        <div class="col">
                                            <button class="btn btn-danger offset-4 col-6 font-weight-bold" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                    </div>
                                </li>
                            @elseif($user->companies)
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Company's Name: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->companies->CO_Name }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#companyNameModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Company's Website: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->companies->CO_Website }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#websiteModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Company's Work Area: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->companies->CO_WorkArea }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#workAreaModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Company's Contact First Name: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->companies->CO_ContactName }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#contactNameModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Company's Contact Last Name: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->companies->CO_ContactLastName }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#contactLastNameModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Email: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> {{ $user->email }} </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#emailModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Password: </h5>
                                        <p class="my-0 col text-center" style="line-height:37px;"> ******** </p>
                                        <div class="col">
                                            <button class="btn btn-primary offset-4 col-6" data-toggle="modal" data-target="#passwordModal"><i class="fas fa-wrench"></i> Change</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="container row justify-content-between mx-0">
                                        <h5 class="my-0 col" style="line-height:37px;">Delete Account: </h5>
                                        <p class="col"></p>
                                        <div class="col">
                                            <button class="btn btn-danger offset-4 col-6 font-weight-bold" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @if($user->companies)
                        <div class="tab-pane fade" id="dfp" role="tabpanel" aria-labelledby="dfp-tab">
                            <div class="container my-4">
                                <h1 class="text-center">COMING SOON...</h1>
                                <p>In this section you will be able to set your credentials to link your DFP account with our platform</p>
                                <p>For this to happen you need to follow these instructions:</p>
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane fade" id="credits" role="tabpanel" aria-labelledby="credits-tab">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="container">
                                    <h5 class="my-0" style="line-height:37px;">Credits available: {{ $user->US_Credits }} $</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
