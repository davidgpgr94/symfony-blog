<?php

namespace App\Tests\Domain\Author\Company;

use App\Domain\Author\Company\Company;
use App\Domain\Author\Company\CompanyCatchPhrase;
use App\Domain\Author\Company\CompanyName;
use PHPUnit\Framework\TestCase;

class CompanyUnitTest extends TestCase
{
    private Company $company;

    private array $keysCompanyMustHaveAsArray = [
        'name', 'catchPhrase'
    ];

    /** @before */
    public function setUpValidCompany()
    {
        $this->company = new Company(
            new CompanyName('Kwik-E-Mart'),
            new CompanyCatchPhrase('More than a badulaque')
        );
    }

    /** @test */
    public function asArrayShouldReturnAllCompanyFields()
    {
        $companyAsArray = $this->company->asArray();

        $this->assertIsArray($companyAsArray);

        foreach ($this->keysCompanyMustHaveAsArray as $keyCompanyMustHave) {
            $this->assertArrayHasKey($keyCompanyMustHave, $companyAsArray, "Missing key <{$keyCompanyMustHave}>");
        }
    }
}
