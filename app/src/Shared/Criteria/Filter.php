<?php

namespace App\Shared\Criteria;

class Filter
{
    private FilterField $field;
    private FilterValue $value;

    public function __construct(FilterField $field, FilterValue $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function getField(): FilterField
    {
        return $this->field;
    }

    public function getValue(): FilterValue
    {
        return $this->value;
    }
}