<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BrandService;

class BrandController extends Controller
{
    public function __construct(
        private BrandService $brandService,
    ) {}

    public function index(Request $request)
    {
        $countryCode = $request->input('country_code');
        $topList = $this->brandService->getToplistByCountry($countryCode);

        return response()->json([
            'data' => $topList
        ]);
    }
}
