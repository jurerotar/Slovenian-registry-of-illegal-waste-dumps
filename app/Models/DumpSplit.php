<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DumpSplit extends Model
{
    protected $fillable = [
        'dump_id',
        'organic_waste',
        'construction_waste',
        'municipal_waste',
        'bulk_waste',
        'tires',
        'vehicles',
        'asbestos_plates',
        'hazardous_waste',
        'created_at',
        'updated_at'
    ];

    protected $touches = [
        'dump'
    ];

    public function dump(): BelongsTo
    {
        return $this->belongsTo(Dump::class);
    }
}
