<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaLocalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = json_decode(file_get_contents(resource_path('data/provincias.json')), true);
        foreach($provincias['provincias'] as $provincia) {
            $prov = Provincia::create(["nombre" => $provincia['nombre']]);
            foreach($provincia['localidades'] as $localidad) {
                $prov->localidades()->create(["nombre" => $localidad['nombre']]);
            }
        }
    }
}
