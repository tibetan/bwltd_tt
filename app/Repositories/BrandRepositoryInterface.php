<?php

declare(strict_types=1);

namespace App\Repositories;

interface BrandRepositoryInterface
{
    public function getBrandsByCountry(string $countryCode): array;
    public function getDefaultTopList(): array;
    public function getBrandById(int $id): array;
}
