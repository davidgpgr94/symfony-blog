<?php

namespace App\Shared\ValueObject;

use InvalidArgumentException;

class NotBlankStringValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureNotBlank($value);

        parent::__construct($value);
    }

    private function ensureNotBlank(string $value)
    {
        if (empty(trim($value))) {
            throw new InvalidArgumentException(sprintf('The string <%s> cannot be blank', $value));
        }
    }
}