<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    public function getCountriesOrderedByCreatedAt(): array
    {
        return Country::orderBy('created_at', 'desc')->get()->toArray();
    }
}
