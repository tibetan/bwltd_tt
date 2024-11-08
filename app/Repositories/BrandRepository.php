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

    public function create(array $data): array
    {
        $brand = Brand::create($data);

        if (!empty($data['country_id'])) {
            $brand->countries()->attach($data['country_id']);
        }

        return $brand->toArray();
    }

    public function update(array $data, int $id): array
    {
        $brand = Brand::findOrFail($id);

        if (!empty($data['country_id'])) {
            $brand->countries()->sync($data['country_id']);
        }

        $brand->update($data);

        return $brand->toArray();
    }

    public function getEmptyBrand(): array
    {
        return [
            'id' => null,
            'name' => null,
            'image' => null,
            'rating' => null,
            'created_at' => null,
            'updated_at' => null,
        ];
    }
}
