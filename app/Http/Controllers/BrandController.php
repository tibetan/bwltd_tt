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
     * @OA\Get(
     *     path="/api/brands",
     *     summary="Get top list of Brands",
     *     tags={"Brand"},
     *     @OA\Parameter(ref="#/components/parameters/Accept"),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Brand")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     *
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
     * @OA\Get(
     *     path="/api/brands/{id}",
     *     summary="Get an brand by ID",
     *     tags={"Brand"},
     *     @OA\Parameter(ref="#/components/parameters/Accept"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Brand")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Brand not found"
     *     )
     * )
     *
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
     * @OA\Get(
     *     path="/api/brands/create",
     *     summary="Get form for creating a new brand",
     *     tags={"Brand"},
     *     @OA\Response(
     *         response=200,
     *         description="Form data for brand creation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="brand", ref="#/components/schemas/Brand"),
     *             @OA\Property(property="countries", type="array", @OA\Items(ref="#/components/schemas/Country"))
     *         ),
     *     )
     * )
     *
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
     * @OA\Post(
     *     path="/api/brands",
     *     summary="Create a new brand",
     *     tags={"Brand"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreBrandRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Brand created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Brand")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     *
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
     * @OA\Get(
     *     path="/api/brands/{id}/edit",
     *     summary="Get form for editing a brand",
     *     tags={"Brand"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the brand",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Form data for brand editing",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="brand", ref="#/components/schemas/Brand"),
     *             @OA\Property(property="countries", type="array", @OA\Items(ref="#/components/schemas/Country"))
     *         ),
     *     )
     * )
     *
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
     * @OA\Patch(
     *     path="/api/brands/{id}",
     *     summary="Update an existing brand",
     *     tags={"Brand"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the brand",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreBrandRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Brand")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     *
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
     * @OA\Delete(
     *     path="/api/brands/{id}",
     *     summary="Delete a brand",
     *     tags={"Brand"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the brand",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Brand deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $this->brandService->deleteBrand($id);
        return response()->noContent();
    }
}
