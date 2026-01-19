<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discipline extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }
}
