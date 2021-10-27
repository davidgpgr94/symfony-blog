<?php

namespace App\Infrastructure\Persistence\Author;

use App\Domain\Author\Company\Company;
use App\Domain\Author\Company\CompanyCatchPhrase;
use App\Domain\Author\Company\CompanyName;

class JSONPlaceholderAuthorCompanyParser
{
    public function toDomain(array $jsonPlaceholderUserCompany): Company
    {
        $name = new CompanyName($jsonPlaceholderUserCompany['name']);
        $catchPhrase = new CompanyCatchPhrase($jsonPlaceholderUserCompany['catchPhrase']);

        return new Company($name, $catchPhrase);
    }
}