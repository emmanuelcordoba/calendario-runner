<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Busqueda extends Model
{
    protected $table = 'busquedas';

    protected $fillable = [
        'carrera_id',
        'desde',
        'hasta',
        'disciplina'
    ];

    protected $casts = [
        'desde' => 'date:Y-m-d',
        'hasta' => 'date:Y-m-d'
    ];

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }
}
