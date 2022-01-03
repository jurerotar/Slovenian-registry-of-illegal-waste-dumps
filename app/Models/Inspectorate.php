<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspectorate extends Model
{
    protected $fillable = [
        'name',
        'address',
        'email',
        'tel',
        'url',
        'type',
    ];


}
