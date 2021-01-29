<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Irsop extends Model
{
    protected $hidden = [
        'id'
    ];

    protected $guarded = [
        'name',
        'address',
        'email',
        'tel'
    ];

    public function dump(): HasOne
    {
        return $this->HasOne(Dump::class);
    }
}
