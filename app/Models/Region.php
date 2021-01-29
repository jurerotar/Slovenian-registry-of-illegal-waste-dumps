<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Region extends Model
{

    protected $hidden = [
        'id'
    ];

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
