<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BrandRepositoryInterface;

class BrandService
{
    public function __construct(
        private BrandRepositoryInterface $brandRepository,
    ) {
    }

    /**
     * Get top list of brand
     *
     * @param string|null $countryCode
     * @return array
    */
    public function getTopListByCountry(?string $countryCode): array
    {
        if ($countryCode) {
            $brands = $this->brandRepository->getBrandsByCountry($countryCode);

            if (!empty($brands)) {
                return $brands;
            }
        }

        return $this->brandRepository->getDefaultToplist();
    }
}
