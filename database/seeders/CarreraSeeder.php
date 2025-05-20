<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Disciplina;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carreras = json_decode(file_get_contents(resource_path('data/carreras.json')), true);
        foreach($carreras['disciplinas'] as $disciplina) {
            Disciplina::create([
                'nombre' => $disciplina['nombre'],
                'descripcion' => $disciplina['descripcion']
            ]);
        }
        foreach($carreras['carreras'] as $data) {
            $disciplina = Disciplina::where('nombre', $data['disciplina'])->first();
            if($data['nombre'])
            {
                $carrera = Carrera::create([
                    "nombre" => $data['nombre'],
                    "slug" => Carrera::generarSlug($data['nombre']),
                    "disciplina_id" => $disciplina->id,
                    "descripcion" => $data['descripcion'],
                    "imagen" => $data['imagen'],
                    "lugar" => $data['lugar']
                ]);

                if($data['ediciones'])
                {
                    foreach ($data['ediciones'] as $edicion) {
                        $carrera->ediciones()->create([
                            "desde" => $edicion['desde'],
                            "hasta" => $edicion['hasta'],
                            "distancias" => $edicion['distancias']
                        ]);
                    }

                    foreach ($data['enlaces'] as $enlace) {
                        $carrera->enlaces()->create([
                            "tipo" => $enlace['tipo'],
                            "url" => $enlace['url']
                        ]);
                    }

                    foreach ($data['lugares'] as $lugar) {
                        $provincia = Provincia::where('nombre', $lugar['provincia'])->first();

                        if($provincia)
                        {
                            $localidad = null;

                            if($lugar['localidad'])
                            {
                                $localidad = $provincia->localidades()->where('nombre', $lugar['localidad'])->first();
                                if(!$localidad)
                                {
                                    $localidad = $provincia->localidades()->create(['nombre' => $lugar['localidad']]);
                                }
                            }

                            $carrera->lugares()->create([
                                "provincia_id" => $provincia->id,
                                "localidad_id" => $localidad ? $localidad->id : $localidad,
                                "lugar" => $lugar['lugar']
                            ]);
                        }
                    }
                }
            }
        }
    }
}
