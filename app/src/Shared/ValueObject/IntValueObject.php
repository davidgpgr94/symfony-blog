<?php

namespace App\Shared\ValueObject;

use InvalidArgumentException;

class IntValueObject implements SimpleValueObject
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->ensureIsInt($value);

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function ensureIsInt(int $value)
    {
        if (false === filter_var($value, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException(sprintf('The value <%s> must be an integer', $value));
        }
    }
}