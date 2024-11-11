<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Country",
 *     type="object",
 *     title="Country",
 *     required={"code", "name"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the country"
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         description="ISO-2 code of the country"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the country"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation timestamp"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Last update timestamp"
 *     ),
 *     @OA\Property(
 *         property="brands",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Brand"),
 *         description="List of related brands"
 *     )
 * )
 */
class Country extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * Connection with brands
     *
     * @return BelongsToMany
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'brand_country');
    }
}
