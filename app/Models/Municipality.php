<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Municipality extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'area',
        'population',
        'population_per_area',
        'villages',
        'region_id',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function dumps(): HasMany
    {
        return $this->hasMany(Dump::class);
    }

    public function clearedDumps(): HasMany
    {
        return $this->hasMany(Dump::class)->whereCleared(true);
    }

    public function dangerousDumps(): HasMany
    {
        return $this->hasMany(Dump::class)->whereDangerous(true);
    }

    public function lastUpdated(): HasOne
    {
        return $this->hasOne(Dump::class)->orderByDesc('updated_at')->select(['municipality_id', 'updated_at']);
    }

}
