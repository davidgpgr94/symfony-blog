<?php

namespace App\Tests\Domain\Author\Address;

use App\Domain\Author\Address\AddressGeolocation;
use App\Domain\Author\Address\Latitude;
use App\Domain\Author\Address\Longitude;
use PHPUnit\Framework\TestCase;

class AddressGeolocationUnitTest extends TestCase
{
    private AddressGeolocation $geolocation;

    private array $keysGeolocationMustHaveAsArray = ['latitude', 'longitude'];

    /** @before */
    public function setUpValidGeolocation()
    {
        $this->geolocation = new AddressGeolocation(
            new Latitude('37.2138'),
            new Longitude('-93.3044')
        );
    }

    /** @test */
    public function asArrayShouldReturnAllAddressGeolocationFields()
    {
        $geolocationAsArray = $this->geolocation->asArray();

        $this->assertIsArray($geolocationAsArray);

        foreach ($this->keysGeolocationMustHaveAsArray as $keyGeolocationMustHave) {
            $this->assertArrayHasKey($keyGeolocationMustHave, $geolocationAsArray, "Missing key <{$keyGeolocationMustHave}>");
        }
    }
}
