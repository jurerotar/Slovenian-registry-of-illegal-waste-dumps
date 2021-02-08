<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class CadastralMunicipality
 * @package App\Models
 * @mixin Builder
 */
class CadastralMunicipality extends Model
{

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

}
