<?php

namespace App\Shared\Criteria;

use App\Shared\ValueObject\StringValueObject;

class OrderBy extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsAValidValue($value);

        parent::__construct($value);
    }

    public function ensureIsAValidValue(string $value): void
    {
    }
}
