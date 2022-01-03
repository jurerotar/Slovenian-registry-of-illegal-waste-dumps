<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeodeticInformation extends Model
{
    public function dump(): BelongsTo
    {
        return $this->belongsTo(Dump::class);
    }

    public function cadastralMunicipality(): BelongsTo
    {
        return $this->belongsTo(CadastralMunicipality::class);
    }
}
