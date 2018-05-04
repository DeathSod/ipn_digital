<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\People;
use App\Companies;
use DateTime;
use DateTimeZone;

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
use Google\AdsApi\Dfp\v201802\PlacementService;
use Google\AdsApi\Dfp\v201802\LineItemService;
use Google\AdsApi\Dfp\v201802\InventoryService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function existsDataArray(&$array, $width, $height)
    {
        foreach ($array as $arr) {
			if ($arr['Width'] == $width && $arr['Height'] == $height) {
				return false;
			}
		}
		array_push($array, array("Width" => $width, "Height" => $height));
		return true;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user->companies)
        {
            return view('home')->with(['user' => $user, 'companies' => $user->companies, 'home' => 'active']);
        }
        elseif($user->people)
        {
            return view('home')->with(['user' => $user, 'people' => $user->people, 'home' => 'active']);
        }
    }

    public function settings()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user->companies)
        {
            return view('pages.settings')->with(['user' => $user, 'companies' => $user->companies, 'settings' => 'active']);
        }
        elseif($user->people)
        {
            return view('pages.settings')->with(['user' => $user, 'people' => $user->people, 'settings' => 'active']);
        }
        
    }

    public function portals()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $portals = Companies::all();
        if($user->companies)
        {
            return view('pages.portals')->with(['user' => $user, 'companies' => $user->companies, 'portals' => $portals, 'portals_active' => 'active']);
        }
        elseif($user->people)
        {
            return view('pages.portals')->with(['user' => $user, 'people' => $user->people, 'portals' => $portals, 'portals_active' => 'active']);
        }
    }

    public function companies($id)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $company = Companies::where('CO_id', $id)->first();
        
        try
        {
            if($company->CO_Name == 'IPN Digital C.A.'){
                $oAuth2Credential = (new OAuth2TokenBuilder())
                ->fromFile('../adsapi_php.ini')
                ->build();

                $session = (new DfpSessionBuilder())
                                ->fromFile("../adsapi_php.ini")
                                ->withOAuth2Credential($oAuth2Credential)
                                ->build();

                $dfpServices = new DfpServices();
                
                $inventoryService = $dfpServices->get($session, InventoryService::class);
                $pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
                $statementBuilder = (new StatementBuilder())->where('name = \'prueba_tesis\' OR name = \'prueba_300x250\'')->orderBy('status ASC')->limit($pageSize);
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
                        foreach ($page->getResults() as $adUnit) {
                            // var_dump($adUnit->getAdUnitSizes());
                            if($adUnit->getAdUnitSizes())
                            {
                                foreach ($adUnit->getAdUnitSizes() as $size) {
                                    self::existsDataArray($adSizes, $size->getSize()->getWidth(), $size->getSize()->getHeight());
                                }
                            }
                        }
                    }
                    $statementBuilder->increaseOffsetBy($pageSize);
                } while ($statementBuilder->getOffset() < $totalResultSetSize);
                return view('pages.buyads')->with(['user' => $user, 'company' => $company, 'adSizes' => $adSizes, 'portals_active' => 'active']);
            }
            else
            {
                return view('pages.buyads')->with(['user' => $user, 'company' => $company, 'message' => 'This company has no associated ads to sell. Try with another one.', 'portals_active' => 'active']);
            }
        }
        catch(\Exception $e)
        {
            return view('pages.buyads')->with(['user' => $user, 'company' => $company, 'message' => 'There was an error connecting to DFP. Go back and try again.', 'portals_active' => 'active']);
        }
    }

    public function forecast()
    {
        $reservedUnits = 0;
        $availableUnits = 0;
        $unavailableSizes[] = '';
        $unavailablePos = 0;

        $data = [
            'sizes' => request('sizes'),
            'startDate' => request('start'),
            'endDate' => request('end'),
            'cpm' => request('cpm'),
            'importance' => request('impLvl')
        ];

        $dataForecast = [];

        try{
            $oAuth2Credential = (new OAuth2TokenBuilder())
                        ->fromFile("../adsapi_php.ini")
                        ->build();

            $session = (new DfpSessionBuilder())
                ->fromFile("../adsapi_php.ini")
                ->withOAuth2Credential($oAuth2Credential)
                ->build();

            $dfpServices = new DfpServices();
            $networkService = $dfpServices->get($session, NetworkService::class);
            $forecastService = $dfpServices->get($session, ForecastService::class);

            $lineItem[] = new LineItem();
            $i = 0;

            foreach($data['sizes'] as $auxSize)
            {
                $auxLineItem = new LineItem();
                $auxLineItem->setLineItemType(LineItemType::STANDARD);

                if($data['cpm'] == 'High')
                {
                    $auxLineItem->setPriority(6);
                }
                elseif($data['cpm'] == 'Normal')
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

                $goal = new Goal();
                $goal->setGoalType(GoalType::LIFETIME);
                $goal->setUnitType(UnitType::IMPRESSIONS);
                $goal->setUnits($data['cpm']);
                $auxLineItem->setPrimaryGoal($goal);

                $auxSize = explode("x",$auxSize);
                $size = new Size();
                $size->setWidth($auxSize[0]);
                $size->setHeight($auxSize[1]);
                $size->setIsAspectRatio(false);
                $creativePlaceholder = new CreativePlaceholder();
                $creativePlaceholder->setSize($size);

                $auxLineItem->setCreativePlaceholders([$creativePlaceholder]);

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

                if($matchedUnits > 0)
                {
                    if($reservedUnits > $availableUnits)
                    {
                        $unavailableSizes[$unavailablePos] = $data['sizes'][$i];
                        $unavailablePos++;
                    }
                }
                else
                {
                    $unavailableSizes[$unavailablePos] = $data['sizes'][$i];
                    $unavailablePos++;
                }

                array_push($dataForecast, [
                    'availableUnits' => $availableUnits,
                    'deliveredUnits' => $deliveredUnits,
                    'matchedUnits' => $matchedUnits,
                    'possibleUnits' => $possibleUnits,
                    'reservedUnits' => $reservedUnits,
                    'unavailableUnits' => $unavailableUnits
                ]);

                $i++;

            }
            
            return view('pages.forecast')->with(['data' => $data, 'dataForecast' => $dataForecast, 'unavailableSizes' => $unavailableSizes, 'unavailablePos' => $unavailablePos]);
        }
        catch(\Exception $e)
        {
            return view('pages.forecast')->with(['connect' => 'There was a problem fetching the data, try again.']);
        }
    }
}
