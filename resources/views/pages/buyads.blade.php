@extends('layouts.nav')

@section('title')
    <title>{{config('app.name', 'IPN Digital')}} | Purchase form</title>
@endsection

@section('navbar')
    @include('../layouts/nav')
@endsection

@section('content-main')
    <p><a style="text-decoration: none;" href="/home/portals"><i class="fas fa-arrow-left"></i> Back</a></p>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">{{$company->CO_Name}}</h1>
    </div>
    @if(isset($message))
        {{ $message }}
    @else
        <div class="w-100 text-center pt-4 mb-4">
            <h3>Step 1: Select your desired ad dimensions:</h3>
        </div>
        <div class="row justify-content-around pb-3 border-bottom">
            @foreach($adSizes as $sizes)
                <input class="btn btn-danger border-dark col-md-3 mx-1 my-2 check-sizes" type="button" value="{{ $sizes['Width'].'x'.$sizes['Height'] }}">
            @endforeach
        </div>
        <div class="pb-3 border-bottom">
            <div class="w-100 text-center pt-4 mb-4">
                <h3>Step 2: Select your campaign dates and number of impressions</h3>
            </div>
            <div class="row justify-content-around">
                <div class="form-group col-md-4">
                    <label for="inputCampaignDateStart" class="font-weight-bold"> Campaign Start Date: </label>
                    <input type="date" id="inputCampaignDateStart" name="campaignDateStart" class="form-control text-center">
                    <label for="inputCampaignDateEnd" class="mt-2 font-weight-bold"> Campaign End Date: </label>
                    <input type="date" id="inputCampaignDateEnd" name="campaignDateEnd" class="form-control text-center">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCpm" class="font-weight-bold"> Number of Impresions (CPM):</label>
                    <input type="text" id="inputCpm" name="Cpm" class="form-control text-center" placeholder="Example: 5000">
                </div>
            </div>
        </div>
        <div class="pb-3 border-bottom">
            <div class="w-100 text-center pt-4 mb-4">
                <h3>Step 3: Select the level of importance for your campaign</h3>
            </div>
            <div class="text-center offset-md-4 col-md-4 pb-4">
                <label for="inputImportanceLevel">Level of importance</label>
                <select name="importanceLevel" id="inputImportanceLevel" class="form-control">
                    <option selected value="High">High</option>
                    <option value="Normal">Normal</option>
                    <option value="Low">Low</option>
                </select>
            </div>
        </div>
        <div class="w-100 text-center mt-4">
            <button type="button" class="btn btn-warning" id="checkAv">Check Availability</button>
        </div>
        <div id="av-div" class="my-4 py-3 border-bottom">
            <h1 class="text-center">The availability of your ads will appear here.</h1>
        </div>
        {{-- This should be dynamic with the sizes --}}
        <div id="buy-div" class="pb-3 border-bottom d-none">
            <div class="w-100 text-center pt-4 mb-4">
                <h3>Step 4: Upload your creatives</h3>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Insert a name for the creative</label>
                <input class="form-control" type="text" placeholder="File Name">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Upload the creative file</label>
                <input type="file" class="form-control-file" accept="image/*">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Insert a description for the creative</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <h4>Or if you have already uploaded a file...</h4>
                <select class="form-control">
                    <option>Default select</option>
                </select>
            </div>
        </div>
    @endif
@endsection
