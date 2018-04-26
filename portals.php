<?php
	
	session_start();

	if (!isset($_SESSION['logged_uid'])) {
		header("Location: index.php");
	}

	require_once 'includes/db_connection.php';
	require_once 'includes/tables/user.php';

	$user = new User();

	$user = $user->getUserById($_SESSION['logged_uid']);

	$company_id = $_GET['company'];

	require 'vendor/autoload.php';
	use Google\AdsApi\Common\OAuth2TokenBuilder;
	use Google\AdsApi\Dfp\DfpServices;
	use Google\AdsApi\Dfp\DfpSession;
	use Google\AdsApi\Dfp\DfpSessionBuilder;
	use Google\AdsApi\Dfp\v201708\NetworkService;
	use Google\AdsApi\Dfp\Util\v201802\StatementBuilder;
	use Google\AdsApi\Dfp\v201802\PlacementService;
	use Google\AdsApi\Dfp\v201802\LineItemService;
	use Google\AdsApi\Dfp\v201802\InventoryService;

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

	function existsDataArray (&$array, $width, $height) {
		foreach ($array as $arr) {
			if ($arr['Width'] == $width && $arr['Height'] == $height) {
				return false;
			}
		}
		array_push($array, array("Width" => $width, "Height" => $height));
		return true;
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPN Digital | Order Page</title>
		<meta charset="utf-8">
		<!--Bootstrap CSS-->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<!-- *********** -->
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css">
	</head>
	<body>
		<div class="nav">
			<div class="container">
				<div class="row d-flex justify-content-between mt-3">
					<div class="ml-5">
						<button class="btn btn-primary p-1">
							<a class="nav-link text-light" href="./mainpage.php">IPN Digital</a>
						</button>
					</div>
					<div class="">
						<button class="btn btn-warning p-1">
							<a class="nav-link text-dark" href="./companies.php"><i class="fas fa-arrow-left"></i> Go back</a>
						</button>
						<button class="btn btn-info p-1">
							<a class="nav-link text-light" href="./account_config.php"><i class="fas fa-cog"></i> Account Config</a>
						</button>
						<button class="btn btn-danger p-1">
							<a class="nav-link text-light" href="./includes/logout.php"><i class="fas fa-power-off"></i> Log out!</a>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="my-4">
			<div class="container px-0">
				<form action="">
					<div id="config-1">
						<div>
							<div>
								<div class="w-100 text-center pt-4 mb-4 border-top">
									<h3>Step 1: Select your desired ad dimensions:</h3>
								</div>
								<div class="container row mx-0 justify-content-center pb-4">
									<?php 
										$inventoryService = $dfpServices->get($session, InventoryService::class);

										$pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
									    $statementBuilder = (new StatementBuilder())->where('name = \'prueba_tesis\' OR name = \'prueba_300x250\'')->orderBy('status ASC')
									        ->limit($pageSize);
									    // Retrieve a small amount of ad units at a time, paging
									    // through until all ad units have been retrieved.
									    $totalResultSetSize = 0;
									    do {
									        $page = $inventoryService->getAdUnitsByStatement(
									            $statementBuilder->toStatement()
									        );
									        // Print out some information for each ad unit.
									        if ($page->getResults() !== null) {
									            $totalResultSetSize = $page->getTotalResultSetSize();
									            $adSizes = array();
									            $i = $page->getStartIndex();
									            foreach ($page->getResults() as $adUnit)
									            {
									                if($adUnit->getAdUnitSizes())
									                {
									                	$j = 0;
									                	foreach($adUnit->getAdUnitSizes() as $size)
									                	{
									                		$j++;
									                		if(existsDataArray($adSizes, $size->getSize()->getWidth(), $size->getSize()->getHeight()))
									                		{
									                			echo "<div><input class='check-sizes p-3 mx-4 my-3 btn btn-danger border-dark' type='button' id='inputSizeWd".$j."' name='SizeWd".$j."' value='".$size->getSize()->getWidth()."x".$size->getSize()->getHeight()."'></div>";
									                		//echo "<ul><li class='adWidth'>".$size->getSize()->getWidth()."</li><li class='adHeight'> ".$size->getSize()->getHeight()."</li></ul>";
									                		}
									                	}
									                }
									            }
									        }
									        $statementBuilder->increaseOffsetBy($pageSize);
									    } while ($statementBuilder->getOffset() < $totalResultSetSize);
									 ?>
							 	</div>
							 </div>
						</div>
						<div>
						 	<div class="w-100 text-center pt-4 mb-4 border-top">
								<h3>Step 2: Select your campaign dates and number of impressions</h3>
							</div>
							<div class="row pb-4">
								<div class="form-group text-center offset-md-2 col-md-4 mb-4 border-right">
									<label for="inputCampaignDateStart"> Campaign Start Date </label>
									<input type="date" id="inputCampaignDateStart" name="campaignDateStart" class="form-control col-md-8 offset-md-2 text-center">
									<label for="inputCampaignDateEnd" class="mt-2"> Campaign End Date </label>
									<input type="date" id="inputCampaignDateEnd" name="campaignDateEnd" class="form-control col-md-8 offset-md-2 text-center">
								</div>
								<div class="text-center col-md-4">
									<label for="inputCpm"> Number of Impresions (CPM)</label>
									<input type="text" id="inputCpm" name="Cpm" class="form-control col-md-8 offset-md-2 text-center" placeholder="Example: 5000">
								</div>
							</div>
						</div>
						<div>
							<div class="w-100 text-center pt-4 mb-4 border-top">
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
					</div>
					<div id="av-div" class="my-4 py-3 border-top"><h1 class="text-center">Your forecast will appear here</h1></div>
					<div id="config-2">						
					</div>
				</form>
			</div>
		</div>
		<!-- JQuery * Popper * Bootstrap JS -->
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/font-awesome.js"></script>
		<script src="js/portals.js"></script>
	</body>
</html>