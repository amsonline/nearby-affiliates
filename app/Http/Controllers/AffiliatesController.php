<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affiliate;
use App\Services\Affiliates\AffiliatesDataInterface;
use App\Services\Affiliates\Affiliates;

class AffiliatesController extends Controller
{
    public function getNearbyAffiliates(AffiliatesDataInterface $affiliatesData, Affiliates $affiliates) {
        // In order to demonstrate MVC, the code will read data from file inside an interface. This can be easily changed to get data from any other sources.
        $affiliatesList = $affiliatesData->getAffiliates();
        
        $nearbyAffiliates = $affiliates->getNearbyAffiliatesFromArray($affiliatesList);

        return view('invitees', ['invitees' => $affiliates->sortAffiliatesById($nearbyAffiliates)]);
    }
}
