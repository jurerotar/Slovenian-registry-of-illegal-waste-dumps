<?php

namespace App\Models\ReferenceModels;

use App\Models\Dump;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class TerrainType extends Model
{
    protected $fillable = [
        'type',
        'description'
    ];

    public function dump(): HasMany
    {
        return $this->hasMany(Dump::class);
    }
}
