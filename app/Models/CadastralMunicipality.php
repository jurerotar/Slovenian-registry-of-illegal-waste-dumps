<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CadastralMunicipality extends Model
{
    public function geodeticInformation(): HasMany
    {
        return $this->hasMany(GeodeticInformation::class);
    }
}
