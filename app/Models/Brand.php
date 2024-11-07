<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'brands';

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
