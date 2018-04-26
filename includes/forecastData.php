<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="row py-4">
        <div class="col-md-7 flex-column text center">
            <?php
                require '../vendor/autoload.php';
                use Google\AdsApi\Common\OAuth2TokenBuilder;
                use Google\AdsApi\Dfp\Util\v201802\DfpDateTimes;
                use Google\AdsApi\Dfp\Util\v201802\StatementBuilder;
                use Google\AdsApi\Dfp\DfpServices;
                use Google\AdsApi\Dfp\DfpSession;
                use Google\AdsApi\Dfp\DfpSessionBuilder;
                use Google\AdsApi\Dfp\v201708\NetworkService;
                use Google\AdsApi\Dfp\v201802\ForecastService;
                use Google\AdsApi\Dfp\v201802\LineItem;
                use Google\AdsApi\Dfp\v201802\LineItemType;
                use Google\AdsApi\Dfp\v201802\Goal;
                use Google\AdsApi\Dfp\v201802\GoalType;
                use Google\AdsApi\Dfp\v201802\UnitType;
                use Google\AdsApi\Dfp\v201802\AdUnitTargeting;
                use Google\AdsApi\Dfp\v201802\CreativeRotationType;
                use Google\AdsApi\Dfp\v201802\StartDateTimeType;
                use Google\AdsApi\Dfp\v201802\CostType;
                use Google\AdsApi\Dfp\v201802\Size;
                use Google\AdsApi\Dfp\v201802\CreativePlaceholder;
                use Google\AdsApi\Dfp\v201802\InventoryTargeting;
                use Google\AdsApi\Dfp\v201802\Targeting;
                use Google\AdsApi\Dfp\v201802\ProspectiveLineItem;
                use Google\AdsApi\Dfp\v201802\AvailabilityForecastOptions;

                $reservedUnits = 0;
                $availableUnits = 0;
                $unavailableSizes[] = '';
                $unavailablePos = 0;

                try{
                    $oAuth2Credential = (new OAuth2TokenBuilder())
                        ->fromFile("../adsapi_php.ini")
                        ->build();

                    $session = (new DfpSessionBuilder())
                        ->fromFile("../adsapi_php.ini")
                        ->withOAuth2Credential($oAuth2Credential)
                        ->build();

                    $dfpServices = new DfpServices();
                    $sizes = $_POST["phpSizes"];
                    $startDate = $_POST["start"];
                    $endDate = $_POST["end"];
                    $numImp = $_POST["cpm"];
                    $impLvl = $_POST["impLvl"];

                    $networkService = $dfpServices->get($session, NetworkService::class);
                    $forecastService = $dfpServices->get($session, ForecastService::class);

                    $lineItem[] = new LineItem();
                    $i = 0;
                    
                    echo 
                    '<table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Sizes</th>
                                <th scope="col">Likely to deliver</th>
                                <th scope="col">Unlikely to deliver</th>
                                <th scope="col">Unavailable</th>
                                <th scope="col">Matched Units</th>
                            </tr>
                        </thead>
                        <tbody>';

                    foreach ($sizes as $auxSize) {
                        
                        //Crea la línea de pedido y le coloca los datos para calcular el pronóstico
                        $auxLineItem = new LineItem();
                        $auxLineItem->setLineItemType(LineItemType::STANDARD);
                        if($impLvl == 'High')
                        {
                            $auxLineItem->setPriority(6);
                        }
                        elseif($impLvl == 'Normal')
                        {
                            $auxLineItem->setPriority(8);
                        }
                        else {
                            $auxLineItem->setPriority(10);
                        }
                        $auxLineItem->setCreativeRotationType(CreativeRotationType::OPTIMIZED);
                        $auxLineItem->setStartDateTimeType(StartDateTimeType::IMMEDIATELY);
                        $auxLineItem->setEndDateTime(
                            DfpDateTimes::fromDateTime(
                                new DateTime('+30 days', new DateTimeZone('America/New_York'))
                            )
                        );
                        $auxLineItem->setCostType(CostType::CPM);

                        //Crea la meta mínima a alcanzar
                        $goal = new Goal();
                        $goal->setGoalType(GoalType::LIFETIME);
                        $goal->setUnitType(UnitType::IMPRESSIONS);
                        $goal->setUnits($numImp);
                        $auxLineItem->setPrimaryGoal($goal);

                        //Obtiene las medidas del ancho y largo del creativo para pronóstico
                        $auxSize = explode("x",$auxSize);
                        $size = new Size();
                        $size->setWidth($auxSize[0]);
                        $size->setHeight($auxSize[1]);
                        $size->setIsAspectRatio(false);
                        $creativePlaceholder = new CreativePlaceholder();
                        $creativePlaceholder->setSize($size);
                        
                        $auxLineItem->setCreativePlaceholders([$creativePlaceholder]);

                        //Obtiene el Ad Unit raíz mas todos sus hijos para ver disponibilidad
                        $rootAdUnitId = $networkService->getCurrentNetwork()->getEffectiveRootAdUnitId();
                        $adUnitTargeting = new AdUnitTargeting();
                        $adUnitTargeting->setAdUnitId($rootAdUnitId);
                        $adUnitTargeting->setIncludeDescendants(true);
                        $inventoryTargeting = new InventoryTargeting();
                        $inventoryTargeting->setTargetedAdUnits([$adUnitTargeting]);
                        $targeting = new Targeting();
                        $targeting->setInventoryTargeting($inventoryTargeting);
                        $auxLineItem->setTargeting($targeting);

                        $prospectiveLineItem = new ProspectiveLineItem();
                        $prospectiveLineItem->setLineItem($auxLineItem);
                        $options = new AvailabilityForecastOptions();
                        $options->setIncludeContendingLineItems(true);
                        $options->setIncludeTargetingCriteriaBreakdown(true);

                        //Crea el pronóstico
                        $forecast = $forecastService->getAvailabilityForecast(
                            $prospectiveLineItem,
                            $options
                        );

                        $availableUnits = $forecast->getAvailableUnits();
                        $deliveredUnits = $forecast->getDeliveredUnits();
                        $matchedUnits = $forecast->getMatchedUnits();
                        $possibleUnits = $forecast->getPossibleUnits();
                        $reservedUnits = $forecast->getReservedUnits();
                        $unavailableUnits = 0;

                        if($forecast->getContendingLineItems())
                        {
                            foreach($forecast->getContendingLineItems() as $contendingLineItems)
                            {
                                $unavailableUnits += $contendingLineItems->getContendingImpressions();
                            }
                        }

                        if ($matchedUnits > 0) {
                            echo "<tr><th scope='row'>$sizes[$i]</th>";
                            if($reservedUnits < $availableUnits)
                            {
                                echo "<td>$availableUnits</td>";
                                echo "<td class='bg-success text-light'>0</td>";
                                echo "<td>$unavailableUnits</td>";
                            }
                            else{
                                if($reservedUnits > $availableUnits) {
                                    echo "<td>$availableUnits</td>";
                                    echo "<td class='bg-danger text-light'>".($reservedUnits - $availableUnits)."</td>";
                                    echo "<td>$unavailableUnits</td>";
                                    $unavailableSizes[$unavailablePos] = $sizes[$i];
                                    $unavailablePos++;

                                }
                                else {
                                    echo "<td>$availableUnits</td>";
                                    echo "<td class='bg-success text-light'>".($reservedUnits - $availableUnits)."</td>";
                                    echo "<td>$unavailableUnits</td>";
                                }
                            }
                            printf("<td>%d</td></tr>\n", $matchedUnits);
                        }
                        else {
                            echo "<tr><th scope='row'>$sizes[$i]</th>";
                            echo "<td>$availableUnits</td>";
                            echo "<td class='bg-danger text-light'>0</td>";
                            echo "<td>$unavailableUnits</td>";
                            printf("<td>%d</td></tr>\n", $matchedUnits);
                            $unavailableSizes[$unavailablePos] = $sizes[$i];
                            $unavailablePos++;
                        }

                        $i++;
                    }

                    echo '</tbody></table>';
                    
                    // // $unitType = strtolower($forecast->getUnitType());
                }
                catch(Exception $e)
                {
                    echo "There was an error fetching the data from the server. Try again<br>";
                    exit;
                }

            ?>
        </div>
        <div class="col-md-5 text-center">
            <?php
                if($unavailablePos > 0)
                {
                    echo '<h3 class="text-center text-danger"><i class="fas fa-times-circle"></i></h3>';
                    echo '<h4 class="text-danger"> Please change the following sizes or change the number of impressions to continue:</h4>';
                    echo '<table class="mt-4 table table-bordered table-hover text-center"><tr>';
                    foreach($unavailableSizes as $auxSize)
                    {
                        echo "<td>$auxSize</td>";
                    }
                    echo "</tr></table>";
                }
                else {
                    echo '<h3 class="text-center text-success"><i class="fas fa-check-circle"></i></h3>';
                    echo '<h4 class="text-success">Your requirements are met! Please click the button to continue.</h4>';
                    echo '<button type="button" class="btn btn-success mt-2 text-center" id="continueAv">Continue!</button>';
                }
            ?>
        </div>
    </div>
</body>
</html>