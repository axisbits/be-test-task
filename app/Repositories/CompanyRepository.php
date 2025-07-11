<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository extends Repository
{
    /**
     * Specify model class name.
     *
     * @return string
     */
    public function model(): string
    {
        return Company::class;
    }
}
