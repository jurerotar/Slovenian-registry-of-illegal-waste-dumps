<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TrashType
 * @package App\Models
 * @mixin Builder
 */
class TrashType extends Model
{

    protected $hidden = [
        'dump_id'
    ];

    public function dump(): BelongsTo
    {
        return $this->belongsTo(Dump::class);
    }
}
