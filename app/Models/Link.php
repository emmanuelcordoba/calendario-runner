<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    const TYPES = [
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

    protected $table = 'links';

    protected $fillable = [
        'race_id',
        'type',
        'title',
        'url'
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }
}
