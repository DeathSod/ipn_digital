<div class="row py-2">
    <div class="col-md-7 flex-column text-center">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col" class="align-middle">Sizes</th>
                    <th scope="col">Likely to deliver</th>
                    <th scope="col">Unlikely to deliver</th>
                    <th scope="col" class="align-middle">Unavailable</th>
                    <th scope="col">Matched Units</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataForecast as $forecast)
                    @if($forecast['matchedUnits'] > 0)
                        <tr>
                            <th scope='row'>{{ $data['sizes'][$loop->index] }}</th>
                            @if($forecast['reservedUnits'] < $forecast['availableUnits'])
                                <td>{{ $forecast['availableUnits'] }}</td>
                                <td class="bg-success text-light">0</td>
                                <td>{{ $forecast['unavailableUnits'] }}</td>
                            @else
                                @if($forecast['reservedUnits'] > $forecast['availableUnits'])
                                    <td>{{ $forecast['availableUnits'] }}</td>
                                    <td class="bg-danger text-light">{{ $forecast['reservedUnits'] - $forecast['availableUnits'] }}</td>
                                    <td>{{ $forecast['unavailableUnits'] }}</td>
                                @else
                                    <td>{{ $forecast['availableUnits'] }}</td>
                                    <td class="bg-success text-light">{{ $forecast['reservedUnits'] - $forecast['availableUnits'] }}</td>
                                    <td>{{ $forecast['unavailableUnits'] }}</td>
                                @endif
                            @endif
                            <td>{{ $forecast['matchedUnits'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <th scope='row'>{{ $data['sizes'][$loop->index] }}</th>
                            <td>{{ $forecast['availableUnits'] }}</td>
                            <td class="bg-danger text-light">0</td>
                            <td>{{ $forecast['unavailableUnits'] }}</td>
                            <td>{{ $forecast['matchedUnits'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{-- @foreach($location as $loc)
            <p> {{var_dump($loc)}} </p>
        @endforeach --}}
    </div>
    <div class="col-md-5 text-center">
        @if($unavailablePos > 0)
            <h3 class="text-center text-danger"><i class="fas fa-times-circle"></i></h3>
            <h4 class="text-danger"> Please change the following sizes or change the number of impressions to continue:</h4>
            {{-- <table class="mt-4 table table-bordered text-center">
                <tr> --}}
            <div class="d-flex flex-wrap">
                @foreach($unavailableSizes as $auxSizes)
                    <div class="border col-3 py-2">{{ $auxSizes }}</div>
                @endforeach
            </div>
                {{-- </tr>
            </table> --}}
        @else
            <h3 class="text-center text-success"><i class="fas fa-check-circle"></i></h3>
            <h4 class="text-success">Your requirements are met! Please click the button to continue.</h4>
            <button type="button" class="btn btn-success mt-2 text-center" id="continueAv">Continue!</button>
        @endif
    </div>
</div>
<script>
    var continueButton = document.getElementById('continueAv');

    continueButton.onclick = function()
    {
        var buyDiv = document.getElementById('buy-div');
        var settingsDiv = document.getElementById('settings-div');

        buyDiv.classList.remove('d-none');
        settingsDiv.classList.add('d-none');
    }
</script>