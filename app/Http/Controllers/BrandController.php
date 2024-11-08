<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Http\Resources\BrandCollectionResource;

class BrandController extends Controller
{
    public function __construct(
        private BrandService $brandService,
    ) {}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): BrandCollectionResource
    {
        $countryCode = $request->input('country_code');
        $topList = $this->brandService->getToplistByCountry($countryCode);

        return new BrandCollectionResource($topList);
    }
}
