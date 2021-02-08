<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Volume
 * @package App\Models
 * @mixin Builder
 */
class Volume extends Model
{
    protected $hidden = [
        'id'
    ];

    public function dump(): HasOne
    {
        return $this->hasOne(Dump::class);
    }
}
