<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CountryRepositoryInterface;

class CountryService
{
    public function __construct(
        private CountryRepositoryInterface $countryRepository,
    ) {
    }

    public function getCountries(): array
    {
        return $this->countryRepository->getCountriesOrderedByCreatedAt();
    }
}
