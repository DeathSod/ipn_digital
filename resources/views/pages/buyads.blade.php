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
        <form action="" method="post">
            <div id="settings-div">
                <div class="w-100 text-center pt-4 mb-4">
                    <h3>Step 1: Select your desired ad dimensions:</h3>
                </div>
                <div class="row justify-content-around pb-3 border-bottom" id="stepOne">
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
                <div class="pb-3 border-bottom text-center">
                    <div class="w-100 pt-4 mb-4">
                        <h3>Step 3: Select the countries where your ads will appear</h3>
                    </div>
                    <div class="row offset-md-4 col-md-4 pb-4" id="countrySection">
                        <label for="inputCountry">Country or Countries</label>
                        <select name="country[]" id="inputCountry" class="form-control countries-opt">
                            @foreach($places as $place)
                                @if(isset($people))
                                    @if($people->PE_FK_PL == $place->PL_id)
                                        <option selected value="{{ $place->PL_id }}"> {{ $place->PL_Name }} </option>
                                    @else
                                        <option value="{{ $place->PL_id }}"> {{ $place->PL_Name }} </option>
                                    @endif
                                @elseif(isset($companies))
                                    @if($companies->CO_FK_PL == $place->PL_id)
                                        <option selected value="{{ $place->PL_id }}"> {{ $place->PL_Name }} </option>
                                    @else
                                        <option value="{{ $place->PL_id }}"> {{ $place->PL_Name }} </option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <input class="btn btn-warning border-dark mx-1 my-2" type="button" value="Add" id="addCountry">
                    <input class="btn btn-danger border-dark mx-1 my-2" type="button" value="Remove" id="removeCountry">
                </div>
                <div class="pb-3 border-bottom">
                    <div class="w-100 text-center pt-4 mb-4">
                        <h3>Step 4: Select the level of importance for your campaign</h3>
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
        </form>
    @endif
@endsection

@section('special-js')
    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
            var countryButton = document.getElementById("addCountry")
            var removeCountry = document.getElementById('removeCountry');
            var countrySection = document.getElementById("countrySection");
            var countriesOption = document.getElementsByClassName('countries-opt');
            
            countryButton.onclick = function()
            {
                var input = document.createElement("select");
                input.setAttribute('name', 'country[]');
                input.className = 'form-control mt-1 countries-opt';
                
                var options = [
                    @foreach($places as $place)
                        ["{{ $place->PL_Name }}", "{{ $place->PL_id }}"],
                    @endforeach
                ];

                for(i = 0; i < options.length; i++){
                    input.options[input.options.length] = new Option(options[i][0], options[i][1]);
                }

                countrySection.append(input);
            }

            removeCountry.onclick = function()
            {
                var i = countriesOption.length - 1;

                if(i > 0)
                {
                    countriesOption[i].parentNode.removeChild(countriesOption[i]);
                }
                return;
            }
        });
    </script>
@endsection