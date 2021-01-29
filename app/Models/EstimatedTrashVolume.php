<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstimatedTrashVolume extends Model
{
    protected $hidden = [
        'dump_id'
    ];

    public function dump(): BelongsTo
    {
        return $this->belongsTo(Dump::class);
    }
}
