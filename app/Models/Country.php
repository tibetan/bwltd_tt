<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
