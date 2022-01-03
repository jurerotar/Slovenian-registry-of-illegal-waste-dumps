<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Region extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'area',
        'population',
        'population_per_area',
    ];

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }

    public function dumps(): HasManyThrough
    {
        return $this->HasManyThrough(Dump::class, Municipality::class);
    }
}
