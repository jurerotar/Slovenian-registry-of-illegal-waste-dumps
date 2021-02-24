<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Region extends Model
{

    public function location(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }
}
