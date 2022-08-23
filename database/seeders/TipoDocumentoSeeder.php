<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $tipoDocumentos = [
            ['id' => 1, 'nombre' => 'DNI'],
            ['id' => 2, 'nombre' => 'LC'],
            ['id' => 3, 'nombre' => 'Pasaporte'],
        ];

        foreach($tipoDocumentos as $tipoDocumento) {
            TipoDocumento::create($tipoDocumento);
        }
    }
}
