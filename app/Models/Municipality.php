<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Municipality extends Model
{

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function stateInspectorate(): HasOne
    {
        return $this->hasOne(StateInspectorate::class);
    }

    public function intermunicipalityInspectorate(): HasOne
    {
        return $this->hasOne(IntermunicipalityInspectorate::class);
    }

    public function location(): HasMany
    {
        return $this->HasMany(Location::class);
    }

}
