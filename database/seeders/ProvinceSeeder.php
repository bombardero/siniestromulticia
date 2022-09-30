<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = json_decode(file_get_contents(asset('data/provincias.json')), true);

        foreach($provincias['provincias'] as $provincia) {
            Province::create([
                "id" => $provincia['id'],
                "name" => $provincia['iso_nombre'],
                "data" => $provincia
            ]);
        }
    }
}
