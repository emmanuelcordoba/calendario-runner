<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enlace extends Model
{
    const TIPOS = [
        'Web',
        'Instagram',
        'Facebook',
        'Twitter',
        'YouTube',
        'Telegram',
        'WhatsApp',
        'Email',
        'Teléfono'
    ];

    protected $table = 'enlaces';

    protected $fillable = [
        'tipo',
        'url',
    ];

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }
}
