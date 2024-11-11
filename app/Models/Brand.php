<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Brand",
 *     type="object",
 *     title="Brand",
 *     required={"name", "image", "rating"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the brand"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the brand"
 *     ),
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         description="Image URL of the brand"
 *     ),
 *     @OA\Property(
 *         property="rating",
 *         type="integer",
 *         description="Rating of the brand"
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
 *         property="countries",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Country"),
 *         description="List of related countries"
 *     )
 * )
 */
class Brand extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'brands';

    /**
     * Massive fill of the fields
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'image',
        'rating',
    ];

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * Connection with countries
     *
     * @return BelongsToMany
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'brand_country');
    }
}
