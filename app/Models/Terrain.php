<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Terrain extends Model
{
    protected $hidden = [
        'id'
    ];

    public function dump(): HasMany
    {
        return $this->hasMany(Dump::class);
    }
}
