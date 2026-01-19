<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Edition extends Model
{
    protected $table = 'editions';

    protected $fillable = [
        'start_date',
        'end_date',
        'distances',
        'imagen'
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'distances' => 'array',
    ];

    protected function getImageUrlAttribute(): string
    {
        return Storage::url($this->image);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    protected function getLastEditionDistancias(): ?array
    {
        $lastEdition = Edition::latest('start_date')->first();
        return $lastEdition ? $lastEdition->distancias : [];
    }
}
