<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Resource for getting Brand model
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return $this->resource;
    }
}
