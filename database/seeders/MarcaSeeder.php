<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = [
            ['id' => 1, 'nombre' => 'Peugeot'],
            ['id' => 2, 'nombre' => 'Renault'],
            ['id' => 3, 'nombre' => 'Fiat'],
        ];

        foreach($marcas as $marca) {
            Marca::create($marca);
        }
    }
}
