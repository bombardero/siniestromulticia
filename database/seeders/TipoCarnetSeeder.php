<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoCarnet;

class TipoCarnetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoCarnets = [
            ['id' => 1, 'nombre' => 'Nacional'],
            ['id' => 2, 'nombre' => 'Provincial'],
        ];

        foreach($tipoCarnets as $tipoCarnet) {
            TipoCarnet::create($tipoCarnet);
        }
    }
}
