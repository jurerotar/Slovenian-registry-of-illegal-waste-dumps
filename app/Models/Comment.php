<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    public $timestamps = [
        'created_at'
    ];

    protected $hidden = [
        'dump_id',
        'deleted_at',
        'id',
        'user_id'
    ];

    protected $appends = [
        'username'
    ];

    public function dump(): BelongsTo
    {
        return $this->belongsTo(Dump::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUsernameAttribute(): string
    {
        return $this->user()->first()->name;
    }
}
