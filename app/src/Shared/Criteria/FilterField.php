<?php

namespace App\Shared\Criteria;

use App\Shared\ValueObject\NotBlankStringValueObject;

class FilterField extends NotBlankStringValueObject
{
    public function __construct(string $field)
    {
        $this->ensureIsAValidField($field);

        parent::__construct($field);
    }

    protected function ensureIsAValidField(string $field): void
    {
    }
}
