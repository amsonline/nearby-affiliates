<?php

namespace App\Services\Affiliates;

class Affiliates {

    public function getNearbyAffiliatesFromArray(array $affiliatesList) {
        $nearbyAffiliates = [];
        foreach ($affiliatesList as $affiliate) {
            $isWithinRadius = $this->isWithinRadius($affiliate);
            
            if ($isWithinRadius) {
                $nearbyAffiliates[] = $affiliate;
            }
        }
        
        return $nearbyAffiliates;
    }

    public function sortAffiliatesById(array $affiliatesData) {
        usort($affiliatesData, function($a, $b) {return $a->affiliate_id - $b->affiliate_id;});
        return $affiliatesData;
    }
	
	private function isWithinRadius($affiliate) {
		$distance = $this->getGreatCircleDistance($affiliate->latitude, $affiliate->longitude);
		return ($distance <= 100000);
	}
	
	private function getGreatCircleDistance($latitude, $longitude) {
		$latitude = deg2rad($latitude);
		$longitude = deg2rad($longitude);
		$corporationLatitude = deg2rad(53.3340285);
		$corporationLongitude = deg2rad(-6.2535495);
		$earthRadius = 6356752.3142;
		$deltaLatitude = abs($corporationLatitude - $latitude);
		$deltaLongitude = abs($corporationLongitude - $longitude);
		
		// The great circle distance formula below
		$centralAngle = asin(sqrt(pow(sin($deltaLatitude / 2), 2) + (1 - pow(sin($deltaLatitude / 2), 2) - pow(sin(($latitude + $corporationLatitude) / 2), 2)) * pow(sin($deltaLongitude / 2), 2))) * 2;
		return $earthRadius * $centralAngle;
	}
}