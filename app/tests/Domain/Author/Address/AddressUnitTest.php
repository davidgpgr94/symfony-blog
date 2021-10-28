<?php

namespace App\Tests\Domain\Author\Address;

use App\Domain\Author\Address\Address;
use App\Domain\Author\Address\AddressCity;
use App\Domain\Author\Address\AddressGeolocation;
use App\Domain\Author\Address\AddressStreet;
use App\Domain\Author\Address\AddressSuite;
use App\Domain\Author\Address\AddressZipcode;
use App\Domain\Author\Address\Latitude;
use App\Domain\Author\Address\Longitude;
use PHPUnit\Framework\TestCase;

class AddressUnitTest extends TestCase
{
    private Address $address;

    private array $keysAddressMustHaveAsArray = [
        'street', 'suite', 'city', 'zipcode', 'geolocation'
    ];

    /** @before */
    public function setUpValidAddress()
    {
        $this->address = new Address(
            new AddressStreet('Evergreen Terrace'),
            new AddressSuite('742'),
            new AddressCity('Springfield'),
            new AddressZipcode('65619'),
            new AddressGeolocation(
                new Latitude('37.2138'),
                new Longitude('-93.3044')
            )
        );
    }

    /** @test */
    public function asArrayShouldReturnAllCompanyFields()
    {
        $companyAsArray = $this->address->asArray();

        $this->assertIsArray($companyAsArray);

        foreach ($this->keysAddressMustHaveAsArray as $keyAddressMustHave) {
            $this->assertArrayHasKey($keyAddressMustHave, $companyAsArray, "Missing key <{$keyAddressMustHave}>");
        }
    }
}
