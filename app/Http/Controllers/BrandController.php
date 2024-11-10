<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
     * Get the brand by ID
     *
     * @param int $id
     * @return BrandResource
     */
    public function show(int $id): BrandResource
    {
        $brand = $this->brandService->getBrand($id);

        return new BrandResource($brand);
    }

    /**
     * Get form for the creation of the brand
     *
     * @return BrandResource
     */
    public function create(): BrandResource
    {
        $emptyBrand = $this->brandService->getEmptyBrand();
        $countries = $this->countryService->getCountries();

        return (new BrandResource($emptyBrand))->additional(['countries' => $countries]);
    }

    /**
     * Save new brand
     *
     * @param StoreBrandRequest $brandRequest
     * @return JsonResponse
     */
    public function store(StoreBrandRequest $brandRequest): JsonResponse
    {
        if ($brandRequest->file('image')) {
            $file = $brandRequest->file('image');
            $filePath = $file->storeAs('img', $file->getClientOriginalName(), 'public');
            $imageUrl = str_replace('public/', '', $filePath);
        }

        $brandData = $brandRequest->validated();
        $brandData['image'] = $imageUrl;

        $brand = $this->brandService->createBrand($brandData);

        return (new BrandResource($brand))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Get form for the update of the brand
     *
     * @return BrandResource
     */
    public function edit(int $id): BrandResource
    {
        $brand = $this->brandService->getBrand($id);
        $countries = $this->countryService->getCountries();

        return (new BrandResource($brand))->additional(['countries' => $countries]);
    }

    /**
     * Update brand
     *
     * @param StoreBrandRequest $brandRequest
     * @return JsonResponse
     */
    public function update(StoreBrandRequest $brandRequest, int $id): JsonResponse
    {
        $brand = $this->brandService->updateBrand($brandRequest->validated(), $id);

        return (new BrandResource($brand))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $this->brandService->deleteBrand($id);
        return response()->noContent();
    }
}
