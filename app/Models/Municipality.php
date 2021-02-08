<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Municipality
 * @package App\Models
 * @mixin Builder
 */
class Municipality extends Model
{

    protected $table = 'municipalities';

    protected $guarded = [
        'name',
        'regions_id'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

}
