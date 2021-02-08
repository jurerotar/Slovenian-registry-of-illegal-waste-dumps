<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Coordinate
 * @package App\Models
 * @mixin Builder
 */
class Coordinate extends Model
{
    protected $hidden = [
        'dump_id',
        'relative_longitude',
        'relative_latitude'
    ];

    public function dump(): HasOne
    {
        return $this->hasOne(Dump::class);
    }
}
