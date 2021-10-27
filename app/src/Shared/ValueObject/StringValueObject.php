<?php

namespace App\Shared\ValueObject;

class StringValueObject implements SimpleValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}