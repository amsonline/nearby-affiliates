<?php

namespace App\Services\Affiliates;

class Affiliates {
    const COMPANY_LATITUDE = 0.9308544006774926;      // Company latitude in radians (53.3340285deg)
    const COMPANY_LONGITUDE = -0.10914502871144513;   // Company longitude in radians (-6.2535495deg)
    const EARTH_RADIUS = 6356752.3142;                // Earth radius in meters, we can change it to kilometers to get the result in kilometers
    const MINIMUM_DISTANCE = 100000;                  // Minimum distance in meters

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
		return ($distance <= self::MINIMUM_DISTANCE);
	}
	
	public function getGreatCircleDistance($latitude, $longitude) {
		$latitude = deg2rad($latitude);
		$longitude = deg2rad($longitude);
		$deltaLatitude = abs(self::COMPANY_LATITUDE - $latitude);
		$deltaLongitude = abs(self::COMPANY_LONGITUDE - $longitude);
		
		// The great circle distance formula below
		$centralAngle = asin(sqrt(pow(sin($deltaLatitude / 2), 2) + (1 - pow(sin($deltaLatitude / 2), 2) - pow(sin(($latitude + self::COMPANY_LATITUDE) / 2), 2)) * pow(sin($deltaLongitude / 2), 2))) * 2;
		return self::EARTH_RADIUS * $centralAngle;
	}
}