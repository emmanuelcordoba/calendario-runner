<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disciplina extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function carreras(): HasMany
    {
        return $this->hasMany(Carrera::class);
    }
}
