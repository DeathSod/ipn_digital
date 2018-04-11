<?php

	require 'vendor/autoload.php';
	use Google\AdsApi\Common\OAuth2TokenBuilder;
	use Google\AdsApi\Dfp\DfpServices;
	use Google\AdsApi\Dfp\DfpSession;
	use Google\AdsApi\Dfp\DfpSessionBuilder;
	use Google\AdsApi\Dfp\v201708\NetworkService;

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
	$networkService = $dfpServices->get($session, NetworkService::class);

	// Make a request
	$network = $networkService->getCurrentNetwork();
	printf(
	    "Network with code %d and display name '%s' was found.\n",
	    $network->getNetworkCode(),
	    $network->getDisplayName()
	);
	
?>