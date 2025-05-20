<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Carrera extends Model
{
    protected $table = 'carreras';

    protected $fillable = [
        'nombre',
        'slug',
        'disciplina_id',
        'descripcion',
        'imagen',
        'lugar'
    ];

    protected $appends = ['lugar_final'];

    protected function getImagenUrlAttribute(): string
    {
        return Storage::url($this->imagen);
    }

    protected function getLugarFinalAttribute(): string
    {
        return $this->lugar ??
            ($this->lugares->first()->lugar ?? $this->lugares->first()->localidad->nombre).', '.$this->lugares->first()->provincia->nombre;
    }

    protected function getProvinciasAttribute(): array
    {
        if(!$this->lugares)
        {
            return [];
        }
        return $this->lugares->pluck('provincia.nombre')->unique()->toArray();
    }

    public  function disciplina(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function ediciones(): HasMany
    {
        return $this->hasMany(Edicion::class);
    }

    public function enlaces(): HasMany
    {
        return $this->hasMany(Enlace::class);
    }

    public function lugares(): HasMany
    {
        return $this->hasMany(Lugar::class);
    }

    public function busquedas(): HasMany
    {
        return $this->hasMany(BusquedaCarrera::class);
    }

    public static function generarSlug(string $texto): string
    {
        // Convertir el texto a minúsculas
        $slug = strtolower($texto);

        // Reemplazar caracteres acentuados y especiales
        $slug = str_replace(
            ['á', 'é', 'í', 'ó', 'ö', 'ú', 'ñ', 'ü'],
            ['a', 'e', 'i', 'o', 'o', 'u', 'n', 'u'],
            $slug
        );

        // Reemplazar caracteres especiales
        $slug = str_replace(
            ['&', '\r\n', '\n', '+'],
            ['y', ' ', ' ', 'y'],
            $slug
        );

        // Reemplazar cualquier cosa que no sea una letra, número o espacio por un guión
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

        // Reemplazar espacios y guiones múltiples con un solo guión
        $slug = preg_replace('/[\s-]+/', '-', $slug);

        // Eliminar guiones al inicio y al final del slug
        $slug = trim($slug, '-');

        return $slug;
    }
}
