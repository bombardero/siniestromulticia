<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modelo;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = [
            ['id' => 1, 'marca_id' => 1 ,'nombre' => '208 Active FULL'],
            ['id' => 2, 'marca_id' => 2 ,'nombre' => 'Fluence 1.6 Luxe'],
            ['id' => 3, 'marca_id' => 3 ,'nombre' => 'Palio 1.6 Base'],
            ['id' => 4, 'marca_id' => 1 ,'nombre' => '408 1.9 HDI Full'],
            ['id' => 5, 'marca_id' => 2 ,'nombre' => 'Alaskan 2.0'],
            ['id' => 6, 'marca_id' => 3 ,'nombre' => 'Cronos 1.5 Base'],
        ];

        foreach($modelos as $modelo) {
            Modelo::create($modelo);
        }

    }
}
