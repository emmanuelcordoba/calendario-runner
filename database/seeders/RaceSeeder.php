<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Province;
use App\Models\Race;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $races = json_decode(file_get_contents(resource_path('data/races.json')), true);
        foreach($races['disciplines'] as $discipline) {
            Discipline::create([
                'name' => $discipline['name'],
                'description' => $discipline['description']
            ]);
        }
        foreach($races['races'] as $data) {
            $discipline = Discipline::where('name', $data['discipline'])->first();
            if($data['name'])
            {
                $race = Race::create([
                    "name" => $data['name'],
                    "slug" => Race::generateSlug($data['name']),
                    "discipline_id" => $discipline->id,
                    "description" => $data['description'],
                    "image" => $data['image'],
                    "place" => $data['place']
                ]);

                if($data['editions'])
                {
                    foreach ($data['editions'] as $edition) {
                        $race->editions()->create([
                            "start_date" => $edition['start_date'],
                            "end_date" => $edition['end_date'],
                            "distances" => $edition['distances']
                        ]);
                    }

                    foreach ($data['links'] as $link) {
                        $race->links()->create([
                            "type" => $link['type'],
                            "url" => $link['url']
                        ]);
                    }

                    foreach ($data['places'] as $place) {
                        $province = Province::where('name', $place['province'])->first();

                        if($province)
                        {
                            $locality = null;

                            if($place['locality'])
                            {
                                $locality = $province->localities()->where('name', $place['locality'])->first();
                                if(!$locality)
                                {
                                    $locality = $province->localities()->create(['name' => $place['locality']]);
                                }
                            }

                            $race->places()->create([
                                "province_id" => $province->id,
                                "locality_id" => $locality ? $locality->id : null,
                                "place" => $place['place']
                            ]);
                        }
                    }
                }
            }
        }
    }
}
