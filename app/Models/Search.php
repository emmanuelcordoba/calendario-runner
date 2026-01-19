<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Search extends Model
{
    protected $table = 'searches';

    protected $fillable = [
        'race_id',
        'start_date',
        'end_date',
        'discipline'
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d'
    ];

    public function races(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }
}
