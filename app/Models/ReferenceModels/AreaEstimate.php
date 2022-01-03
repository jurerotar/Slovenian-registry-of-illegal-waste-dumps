<?php

namespace App\Models\ReferenceModels;

use App\Models\Dump;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaEstimate extends Model
{
    protected $fillable = [
        'area',
        'description',
        'average'
    ];

    public function dump(): HasMany
    {
        return $this->hasMany(Dump::class);
    }

}
