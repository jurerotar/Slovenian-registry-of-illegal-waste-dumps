<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Region
 * @package App\Models
 * @mixin Builder
 */
class Region extends Model
{

    protected $hidden = [
    ];

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }
}
