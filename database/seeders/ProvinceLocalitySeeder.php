<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceLocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = json_decode(file_get_contents(resource_path('data/provinces.json')), true);
        foreach($provinces['provinces'] as $province) {
            $prov = Province::create(["name" => $province['name']]);
            foreach($province['localities'] as $locality) {
                $prov->localities()->create(["name" => $locality['name']]);
            }
        }
    }
}
