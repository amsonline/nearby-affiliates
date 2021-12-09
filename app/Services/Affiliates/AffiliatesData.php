<?php

namespace App\Services\Affiliates;

use Illuminate\Support\Facades\Storage;

class AffiliatesData implements AffiliatesDataInterface {
    private $fileName = 'affiliates.txt';

    public function getAffiliates() {
        $affiliatesRawData = $this->getAffiliatesFromFile();

        // Decoding JSON strings
        $affiliatesData = $this->decodeJSONStrings($affiliatesRawData);

        return $affiliatesData;
    }

    private function getAffiliatesFromFile() {
        $rawData = Storage::get($this->fileName);
        $affiliatesData = explode("\n", $rawData);
        return $affiliatesData;
    }

    private function decodeJSONStrings(array $rawData) {
        $outputArray = [];
        foreach ($rawData as $affiliate) {
            $outputArray[] = json_decode($affiliate);
        }

        return $outputArray;
    }
}