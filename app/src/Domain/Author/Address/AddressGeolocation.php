<?php

namespace App\Domain\Author\Address;

use App\Shared\Arrayable;

class AddressGeolocation implements Arrayable
{
    private Latitude $latitude;
    private Longitude $longitude;

    public function __construct(Latitude $latitude, Longitude $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): Latitude
    {
        return $this->latitude;
    }

    public function getLongitude(): Longitude
    {
        return $this->longitude;
    }

    public function asArray(): array
    {
        return [
            'latitude' => $this->getLatitude()->getValue(),
            'longitude' => $this->getLongitude()->getValue()
        ];
    }
}
