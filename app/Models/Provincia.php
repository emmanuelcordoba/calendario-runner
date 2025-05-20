<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provincia extends Model
{
    protected $table = 'provincias';

    public function localidades(): HasMany
    {
        return $this->hasMany(Localidad::class);
    }
}
