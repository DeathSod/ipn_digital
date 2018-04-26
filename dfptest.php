<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DFP Tests</title>
	<link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
	<style type="text/css" media="screen">
		h1, strong {
			font-family: 'Gugi', cursive;
		}
	</style>
</head>
<body>

<?php

	require 'vendor/autoload.php';
    use Google\AdsApi\Common\OAuth2TokenBuilder;
    use Google\AdsApi\Dfp\Util\v201802\DfpDateTimes;
    use Google\AdsApi\Dfp\Util\v201802\StatementBuilder;
	use Google\AdsApi\Dfp\DfpServices;
	use Google\AdsApi\Dfp\DfpSession;
	use Google\AdsApi\Dfp\DfpSessionBuilder;
	use Google\AdsApi\Dfp\v201708\NetworkService;
	use Google\AdsApi\Dfp\v201802\PlacementService;
	use Google\AdsApi\Dfp\v201802\LineItemService;
	use Google\AdsApi\Dfp\v201802\InventoryService;
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

	// Generate a refreshable OAuth2 credential for authentication.
	$oAuth2Credential = (new OAuth2TokenBuilder())
	    ->fromFile()
	    ->build();

	// Construct an API session configured from a properties file and the OAuth2
	// credentials above.
	$session = (new DfpSessionBuilder())
	    ->fromFile()
	    ->withOAuth2Credential($oAuth2Credential)
	    ->build();

	// Get a service.
	$dfpServices = new DfpServices();

	//Todas las clases útiles del API para IPN Digital
	$networkService = $dfpServices->get($session, NetworkService::class);
	$placementService = $dfpServices->get($session, PlacementService::class);
	$lineItemService = $dfpServices->get($session, LineItemService::class);
	$inventoryService = $dfpServices->get($session, InventoryService::class);
	$forecastService = $dfpServices->get($session, ForecastService::class);

	// Make a request
	
	echo "<h1>Datos de la plataforma de IPN Digital</h1>";

	$network = $networkService->getCurrentNetwork();
	printf(
	    "Network with code %d and display name '%s' was found.\n <br><br><hr>",
	    $network->getNetworkCode(),
	    $network->getDisplayName()
	);

	//------------------------------------------------------------------------------------

	// echo "<h1>Datos de los emplazamientos existentes</h1>";

	// $pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
	// $statementBuilder = (new StatementBuilder())->orderBy('id ASC')
    //         ->limit($pageSize);

    // $totalResultSetSize = 0;

    // do {
    //     $page = $placementService->getPlacementsByStatement(
    //         $statementBuilder->toStatement()
    //     );
    //     // Print out some information for each placement.
    //     echo "<ul>";
    //     if ($page->getResults() !== null) {
    //         $totalResultSetSize = $page->getTotalResultSetSize();
    //         $i = $page->getStartIndex();
    //         foreach ($page->getResults() as $placement) {
    //             printf(
    //                 "<li>%d) Placement with ID <strong>%d</strong>, name <strong>'%s'</strong>, placement code <strong>'%s'</strong>, status <strong>'".$placement->getStatus()."'</strong> was found with the following description: <strong>'%s'</strong>.\n<br>",
    //                 $i++,
    //                 $placement->getId(),
    //                 $placement->getName(),
    //                 $placement->getPlacementCode(),
    //                 $placement->getDescription()
    //             );
    //             echo "It has the following ad units: </li>";
    //             echo "<ul>";
    //             foreach ($placement->getTargetedAdUnitIds() as $ads) {
    //             	echo "<li>".$ads."</li>";
    //             }
    //             echo"</ul>";
    //         }
    //     }
    //     echo "</ul>";
    //     $statementBuilder->increaseOffsetBy($pageSize);
    // } while ($statementBuilder->getOffset() < $totalResultSetSize);

    // printf("Number of results found: %d\n<br><hr>", $totalResultSetSize);

    // //------------------------------------------------------------------------------------
    
    // echo "<h1>Datos de las líneas de pedido existentes</h1>";

    // $pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
    // $statementBuilder = (new StatementBuilder())->where("status = 'DELIVERING'")->orderBy('id ASC')
    //     ->limit($pageSize);
    
    // $totalResultSetSize = 0;
    // do {
    //     $page = $lineItemService->getLineItemsByStatement(
    //         $statementBuilder->toStatement()
    //     );
    
    //     if ($page->getResults() !== null) {
    //         $totalResultSetSize = $page->getTotalResultSetSize();
    //         $i = $page->getStartIndex();
    //         foreach ($page->getResults() as $lineItem) {
    //             printf(
    //                 "%d) Line item with ID <strong>%d</strong> and name <strong>'%s'</strong> was found with the line item type of <strong>'%s'</strong> and is <strong>%s</strong>.\n<br>",
    //                 $i++,
    //                 $lineItem->getId(),
    //                 $lineItem->getName(),
    //                 $lineItem->getlineItemType(),
    //                 $lineItem->getStatus()
    //             );
    //             echo "Cost: ".($lineItem->getCostPerUnit()->getMicroAmount()/1000000)." ".$lineItem->getCostPerUnit()->getCurrencyCode()." per ".$lineItem->getCostType()."<br><br>";
    //         }
    //     }
    //     $statementBuilder->increaseOffsetBy($pageSize);
    // } while ($statementBuilder->getOffset() < $totalResultSetSize);
    // printf("Number of results found: %d\n<br><hr>", $totalResultSetSize);

    // //------------------------------------------------------------------------------------

    // echo "<h1>Datos de los Ad Units existentes</h1>";

    // $pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
    // $statementBuilder = (new StatementBuilder())/*->where('status = \'ACTIVE\'')*/->orderBy('status ASC')
    //     ->limit($pageSize);
    // // Retrieve a small amount of ad units at a time, paging
    // // through until all ad units have been retrieved.
    // $totalResultSetSize = 0;
    // do {
    //     $page = $inventoryService->getAdUnitsByStatement(
    //         $statementBuilder->toStatement()
    //     );
    //     // Print out some information for each ad unit.
    //     if ($page->getResults() !== null) {
    //         $totalResultSetSize = $page->getTotalResultSetSize();
    //         $i = $page->getStartIndex();
    //         foreach ($page->getResults() as $adUnit) {
    //             printf(
    //                 "%d) Ad unit with ID <strong>'%s'</strong> and name <strong>'%s'</strong> was found. Status: <strong>'%s'</strong>\n<br>",
    //                 $i++,
    //                 $adUnit->getId(),
    //                 $adUnit->getName(),
    //                 $adUnit->getStatus()
    //             );

    //             if($adUnit->getAdUnitSizes())
    //             {
    //             	$j = 0;
    //             	echo "<h3>Ad Units sizes:</h3>";
    //             	foreach($adUnit->getAdUnitSizes() as $size)
    //             	{
    //             		//var_dump($size);
    //             		$j++;
    //             		echo $j.") Width: ".$size->getSize()->getWidth()." Height: ".$size->getSize()->getHeight()."<br>";
    //             		//echo $size."<br>";
    //             	}
    //             	echo "<h3>Number of sizes available for this ad unit: ".$j."</h3>";
    //             }
    //             else{
    //             	echo "<strong>- This Ad Unit doesn't have any configured sizes at this moment -</strong><br>";
    //             }
    //             echo "<br>";
    //         }
    //     }
    //     $statementBuilder->increaseOffsetBy($pageSize);
    // } while ($statementBuilder->getOffset() < $totalResultSetSize);
    // printf("Number of results found: %d\n<br><hr>", $totalResultSetSize);

    //-------------------------------------------------------------------

    $lineItem = new LineItem();
    $lineItem->setLineItemType(LineItemType::STANDARD);
    $lineItem->setPriority(6);
    $lineItem->setCreativeRotationType(CreativeRotationType::OPTIMIZED);
    $lineItem->setStartDateTimeType(StartDateTimeType::IMMEDIATELY);
    $lineItem->setEndDateTime(
        DfpDateTimes::fromDateTime(
            new DateTime('+30 days', new DateTimeZone('America/New_York'))
        )
    );
    $lineItem->setCostType(CostType::CPM);

    $goal = new Goal();
    $goal->setGoalType(GoalType::LIFETIME);
    $goal->setUnitType(UnitType::IMPRESSIONS);
    $goal->setUnits(200000);
    $lineItem->setPrimaryGoal($goal);

    $size = new Size();
    $size->setWidth(300);
    $size->setHeight(250);
    $size->setIsAspectRatio(false);
    $creativePlaceholder = new CreativePlaceholder();
    $creativePlaceholder->setSize($size);
    $lineItem->setCreativePlaceholders([$creativePlaceholder]);

    // var_dump($lineItem);
    // var_dump($goal);
    // var_dump($size);
    // var_dump($creativePlaceholder);

    $rootAdUnitId = $networkService->getCurrentNetwork()->getEffectiveRootAdUnitId();
    $adUnitTargeting = new AdUnitTargeting();
    $adUnitTargeting->setAdUnitId($rootAdUnitId);
    $adUnitTargeting->setIncludeDescendants(true);
    $inventoryTargeting = new InventoryTargeting();
    $inventoryTargeting->setTargetedAdUnits([$adUnitTargeting]);
    $targeting = new Targeting();
    $targeting->setInventoryTargeting($inventoryTargeting);
    $lineItem->setTargeting($targeting);

    $prospectiveLineItem = new ProspectiveLineItem();
    $prospectiveLineItem->setLineItem($lineItem);
    $options = new AvailabilityForecastOptions();
    $options->setIncludeContendingLineItems(true);
    $options->setIncludeTargetingCriteriaBreakdown(true);

    $forecast = $forecastService->getAvailabilityForecast(
        $prospectiveLineItem,
        $options
    );

    var_dump($forecast);

    $availableUnits = $forecast->getAvailableUnits();
    $deliveredUnits = $forecast->getDeliveredUnits();
    $matchedUnits = $forecast->getMatchedUnits();
    $possibleUnits = $forecast->getPossibleUnits();
    $reservedUnits = $forecast->getReservedUnits();

    $unitType = strtolower($forecast->getUnitType());
    if ($matchedUnits > 0) {
        //$percentAvailableUnits = (($availableUnits - $reservedUnits));
        //$percentPossibleUnits = $possibleUnits / $matchedUnits * 100;
        echo "$deliveredUnits Delivered<br>";
        if($reservedUnits < $matchedUnits)
        {
            echo "$reservedUnits Likely to deliver<br>";
            echo "0 Unlikely to deliver<br>";
        }
        else{
            echo "$matchedUnits Likely to deliver<br>";
            echo $reservedUnits - $matchedUnits." Unlikely to deliver<br>";
        }
        //echo "$percentAvailableUnits $unitType available ";
        // printf("%.2d%% %s available.\n", $percentAvailableUnits, $unitType);
        // printf("%.2d%% %s possible.\n", $percentPossibleUnits, $unitType);
    }
    else {
        echo "There are no matched impressions at this moment to deliver your request<br>";
    }
    printf("%d %s matched.<br>\n", $matchedUnits, $unitType);
    // printf(
    //     "%d contending line items.\n",
    //     count($forecast->getContendingLineItems())
    // );

?>

	
</body>
</html>