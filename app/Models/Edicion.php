<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Edicion extends Model
{
    protected $table = 'ediciones';

    protected $fillable = [
        'desde',
        'hasta',
        'distancias',
        'imagen'
    ];

    protected $casts = [
        'desde' => 'date:Y-m-d',
        'hasta' => 'date:Y-m-d',
        'distancias' => 'array',
    ];

    protected function getImagenUrlAttribute(): string
    {
        return Storage::url($this->imagen);
    }

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }

    protected function getUltimaEdicionDistancias(): ?array
    {
        $ultimaEdicion = Edicion::latest('desde')->first();
        return $ultimaEdicion ? $ultimaEdicion->distancias : [];
    }
}
