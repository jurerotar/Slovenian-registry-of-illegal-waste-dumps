<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IntermunicipalityInspectorate extends Model
{
    protected $hidden = [
        'id'
    ];

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }
}
