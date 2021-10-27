<?php

namespace App\Domain\Author\Company;

use App\Shared\Arrayable;

class Company implements Arrayable
{
    private CompanyName $name;
    private CompanyCatchPhrase $catchPhrase;

    public function __construct(CompanyName $name, CompanyCatchPhrase $catchPhrase)
    {
        $this->name = $name;
        $this->catchPhrase = $catchPhrase;
    }

    public function getName(): CompanyName
    {
        return $this->name;
    }

    public function getCatchPhrase(): CompanyCatchPhrase
    {
        return $this->catchPhrase;
    }

    public function asArray(): array
    {
        return [
            'name' => $this->getName()->getValue(),
            'catchPhrase' => $this->getCatchPhrase()->getValue()
        ];
    }
}
