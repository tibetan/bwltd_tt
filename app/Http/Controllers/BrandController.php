<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Http\Resources\BrandCollectionResource;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function __construct(
        private BrandService $brandService,
    ) {}

    /**
     * Get all brands
     *
     * @param Request $request
     * @return BrandCollectionResource
     */
    public function index(Request $request): BrandCollectionResource
    {
        $countryCode = $request->input('country_code');
        $topList = $this->brandService->getToplistByCountry($countryCode);

        return new BrandCollectionResource($topList);
    }

    /**
     * @param int $id
     * @return BrandResource
     */
    public function show(int $id): BrandResource
    {
        $brand = $this->brandService->getBrand($id);

        return new BrandResource($brand);
    }

}
