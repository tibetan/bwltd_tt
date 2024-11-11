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

    /**
     * Save new brand to DB
     *
     * @param array $data
     * @return array
     */
    public function createBrand(array $data): array
    {
        return $this->brandRepository->create($data);
    }

    /**
     * Update brand in DB
     *
     * @param array $data
     * @return array
     */
    public function updateBrand(array $data, int $id): array
    {
        return $this->brandRepository->update($data, $id);
    }

    /**
     * Get empty brand
     *
     * @return array
     */
    public function getEmptyBrand(): array
    {
        return $this->brandRepository->getEmptyBrand();
    }

    /**
     * Delete Brand with all data
     *
     * @param int $id
     * @return bool
     */
    public function deleteBrand(int $id): bool
    {
        return $this->brandRepository->delete($id);
    }
}
