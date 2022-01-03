<?php

namespace App\Models;

use App\Models\ReferenceModels\AccessType;
use App\Models\ReferenceModels\AreaEstimate;
use App\Models\ReferenceModels\TerrainType;
use App\Models\ReferenceModels\VolumeEstimate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;


class Dump extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'description',
        'cleared',
        'distance',
        'has_hazardous_liquids',
        'wgs_84_latitude',
        'wgs_84_longitude',
        'user_id',
        'volume_estimate_id',
        'area_estimate_id',
        'access_type_id',
        'terrain_type_id',
        'municipality_id',
    ];

    protected $hidden = [
//        'user_id',
//        'deleted_at',
//        'volume_estimate_id',
//        'terrain_type_id',
//        'access_type_id',
    ];

    protected $casts = [
//        'dangerous' => 'boolean',
//        'cleared' => 'boolean',
//        'urgent' => 'boolean',
    ];

    public function geodeticInformation(): HasOne
    {
        return $this->hasOne(GeodeticInformation::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function dumpSplit(): HasOne
    {
        return $this->hasOne(DumpSplit::class);
    }

    public function region(): HasOneThrough
    {
        return $this->hasOneThrough(Region::class, Municipality::class);
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function terrainType(): BelongsTo
    {
        return $this->belongsTo(TerrainType::class);
    }

    public function accessType(): BelongsTo
    {
        return $this->belongsTo(AccessType::class);
    }

    public function volumeEstimate(): BelongsTo
    {
        return $this->belongsTo(VolumeEstimate::class);
    }

    public function areaEstimate(): BelongsTo
    {
        return $this->belongsTo(AreaEstimate::class);
    }

    public function lastUpdated()
    {

    }
}
