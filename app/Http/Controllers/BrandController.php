<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Services\BrandService;
use App\Http\Resources\BrandResource;
use App\Services\CountryService;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{
    public function __construct(
        private BrandService $brandService,
        private CountryService $countryService,
    ) {}

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $countryCode = $request->input('country_code');
        $topList = $this->brandService->getToplistByCountry($countryCode);

        return BrandResource::collection($topList);
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

    public function create(): AnonymousResourceCollection
    {
        $countries = $this->countryService->getCountries();

        return BrandResource::collection([])
            ->additional(['countries' => $countries]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBrandRequest $brandRequest)
    {
        $brand = $this->brandService->createBrand($brandRequest->validated());

        return (new BrandResource($brand))
            ->response()
            ->setStatusCode(201);
    }
}
