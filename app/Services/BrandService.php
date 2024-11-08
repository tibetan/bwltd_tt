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

    /**
     * Get brand by ID
     *
     * @param int $id
     * @return array
     */
    public function getBrand(int $id): array
    {
        return $this->brandRepository->getBrandById($id);
    }

    public function createBrand(array $data): array
    {
        return $this->brandRepository->create($data);
    }
}
