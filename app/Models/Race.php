<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Race extends Model
{
    protected $table = 'races';

    protected $fillable = [
        'name',
        'slug',
        'discipline_id',
        'description',
        'image',
        'place'
    ];

    protected $appends = ['final_place', 'image_url', 'provinces'];

    protected function getImageUrlAttribute(): string
    {
        return Storage::url($this->image);
    }

    protected function getFinalPlaceAttribute(): string
    {
        return $this->place ??
            ($this->places->first()->place ?? $this->places->first()->locality->name).', '.$this->places->first()->province->name;
    }

    protected function getProvincesAttribute(): array
    {
        if(!$this->places->count())
        {
            return [];
        }
        return $this->places->pluck('provinces.name')->unique()->toArray();
    }

    public  function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    public function editions(): HasMany
    {
        return $this->hasMany(Edition::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }

    public function searches(): HasMany
    {
        return $this->hasMany(Search::class);
    }

    public static function generateSlug(string $text): string
    {
        // Convert the text to lowercase
        $slug = strtolower($text);

        // Replace accented and special characters
        $slug = str_replace(
            ['á', 'é', 'í', 'ó', 'ö', 'ú', 'ñ', 'ü'],
            ['a', 'e', 'i', 'o', 'o', 'u', 'n', 'u'],
            $slug
        );

        // Replace special characters
        $slug = str_replace(
            ['&', '\r\n', '\n', '+'],
            ['y', ' ', ' ', 'y'],
            $slug
        );

        // Replace anything that is not a letter, number, or space with a hyphen
        $slug = preg_replace('/[^a-z0-9\s-]/', '-', $slug);

        // Replace spaces and multiple hyphens with a single hyphen
        $slug = preg_replace('/[\s-]+/', '-', $slug);

        // Remove hyphens from the beginning and end of the slug
        return trim($slug, '-');
    }
}
