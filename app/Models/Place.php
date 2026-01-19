<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Place extends Model
{
    protected $table = 'places';

    protected $fillable = [
        'place',
        'race_id',
        'province_id',
        'locality_id'
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }
}
