<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    public function getBrandsByCountry(string $countryCode): array
    {
        return Brand::whereHas('countries', function ($query) use ($countryCode) {
            $query->where('code', $countryCode);
        })->orderBy('rating', 'desc')->get()->toArray();
    }

    public function getDefaultToplist(): array
    {
        return Brand::orderBy('rating', 'desc')->take(5)->get()->toArray();
    }

    public function getBrandById(int $id): array
    {
        return Brand::findOrFail($id)->toArray();
    }
}
