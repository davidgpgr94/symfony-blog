<?php

namespace App\Domain\Author\Address;

use App\Shared\Arrayable;

class Address implements Arrayable
{
    private AddressStreet $street;
    private AddressSuite $suite;
    private AddressCity $city;
    private AddressZipcode $zipcode;
    private AddressGeolocation $geolocation;

    public function __construct(AddressStreet $street, AddressSuite $suite, AddressCity $city, AddressZipcode $zipcode, AddressGeolocation $geolocation)
    {
        $this->street = $street;
        $this->suite = $suite;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->geolocation = $geolocation;
    }

    public function getStreet(): AddressStreet
    {
        return $this->street;
    }

    public function getSuite(): AddressSuite
    {
        return $this->suite;
    }

    public function getCity(): AddressCity
    {
        return $this->city;
    }

    public function getZipcode(): AddressZipcode
    {
        return $this->zipcode;
    }

    public function getGeolocation(): AddressGeolocation
    {
        return $this->geolocation;
    }

    public function asArray(): array
    {
        return [
            'street' => $this->getStreet()->getValue(),
            'suite' => $this->getSuite()->getValue(),
            'city' => $this->getCity()->getValue(),
            'zipcode' => $this->getZipcode()->getValue(),
            'geolocation' => $this->getGeolocation()->asArray()
        ];
    }
}