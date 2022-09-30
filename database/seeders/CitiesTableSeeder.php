<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localidades = json_decode(file_get_contents(asset('data/localidades.json')), true);

        foreach($localidades['localidades'] as $localidad) {
            City::create([
                'province_id' => $localidad['provincia']['id'],
                'name' => $localidad['nombre'],
                'data' => $localidad,
            ]);
        }
    }
}
