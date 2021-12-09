<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Affiliates\AffiliatesData;
use App\Services\Affiliates\Affiliates;

class AffiliatesTest extends TestCase
{
    private $testCases;

    public function setUp() : void {
        parent::setUp();

        $this->testCases = [
            (object) [
                'lat'       => 55.033,
                'long'      => -8.112,
                'distance'  => 223787.4817348777,
                'isNearby'  => false
            ],
            (object) [
                'lat'       => 53.2451022,
                'long'      => -6.238335,
                'distance'  => 9917.504471765307,
                'isNearby'  => true
            ],
            (object) [
                'lat'       => 51.999447,
                'long'      => -9.742744,
                'distance'  => 277510.65929916373,
                'isNearby'  => false
            ],
        ];
    }

    public function test_get_data_from_file()
    {
        $affiliatesData = new AffiliatesData();
        $affiliatesList = $affiliatesData->getAffiliates();

        // The result should be an array
        $this->assertTrue(is_array($affiliatesList));

        // Number of objects should be 32
        $this->assertEquals(count($affiliatesList), 32);

        // All members should be an object
        foreach ($affiliatesList as $affiliate) {
            $this->assertTrue(is_object($affiliate));
        }
    }

    /*
     * Testing the Great Circle Distance formula
     */
    public function test_great_circle_distance()
    {
        $affiliateOperation = new Affiliates();

        foreach ($this->testCases as $testCase) {
            $distance = $affiliateOperation->getGreatCircleDistance($testCase->lat, $testCase->long);
            $this->assertEquals($distance, $testCase->distance);
        }
    }
}
