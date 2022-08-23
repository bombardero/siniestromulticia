<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoCalzada;

class TipoCalzadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoCalzadas = [
            ['id' => 1, 'nombre' => 'Pavimento'],
            ['id' => 2, 'nombre' => 'Ripio'],
            ['id' => 3, 'nombre' => 'Tierra'],
        ];

        foreach($tipoCalzadas as $tipoCalzada) {
            TipoCalzada::create($tipoCalzada);
        }
    }
}
