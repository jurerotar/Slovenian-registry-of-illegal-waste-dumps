<?php

namespace App\Models;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comment extends Model
{

    protected $fillable = [
        'dump_id',
        'user_id',
        'content',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dump(): BelongsTo
    {
        return $this->belongsTo(Dump::class);
    }

}
