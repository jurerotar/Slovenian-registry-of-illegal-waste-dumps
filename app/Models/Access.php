<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Access
 * @package App\Models
 * @mixin Builder
 */
class Access extends Model
{
    protected $hidden = [
        'id'
    ];

    public function dump(): HasOne
    {
        return $this->HasOne(Dump::class);
    }
}
