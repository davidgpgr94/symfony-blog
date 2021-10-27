<?php

namespace App\Infrastructure\Persistence\Author;

use App\Domain\Author\Address\Address;
use App\Domain\Author\Address\AddressCity;
use App\Domain\Author\Address\AddressGeolocation;
use App\Domain\Author\Address\AddressStreet;
use App\Domain\Author\Address\AddressSuite;
use App\Domain\Author\Address\AddressZipcode;
use App\Domain\Author\Address\Latitude;
use App\Domain\Author\Address\Longitude;

class JSONPlaceholderAuthorAddressParser
{
    public function toDomain(array $jsonPlaceholderUserAddress): Address
    {
        $street = new AddressStreet($jsonPlaceholderUserAddress['street']);
        $suite = new AddressSuite($jsonPlaceholderUserAddress['suite']);
        $city = new AddressCity($jsonPlaceholderUserAddress['city']);
        $zipcode = new AddressZipcode($jsonPlaceholderUserAddress['zipcode']);
        $geolocation = new AddressGeolocation(
            new Latitude($jsonPlaceholderUserAddress['geo']['lat']),
            new Longitude($jsonPlaceholderUserAddress['geo']['lng'])
        );

        return new Address(
            $street,
            $suite,
            $city,
            $zipcode,
            $geolocation
        );
    }
}