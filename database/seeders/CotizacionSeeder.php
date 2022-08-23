<?php

namespace Database\Seeders;

use App\Models\Cotizacion;
use Illuminate\Database\Seeder;

class CotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cotizaciones = [
            ['tipo_alquiler' => 'vivienda','duracion' => -1, 'valor_desde' => 0,     'valor_hasta' => 25000, 'precio' => 35000 ],
            ['tipo_alquiler' => 'comercial','duracion' => -1, 'valor_desde' => 0,     'valor_hasta' => 25000, 'precio' => 35000 ],
            ['tipo_alquiler' => 'vivienda','duracion' => -1, 'valor_desde' => 25001, 'valor_hasta' => 45000, 'precio' => 55000 ],
            ['tipo_alquiler' => 'comercial','duracion' => -1, 'valor_desde' => 25001, 'valor_hasta' => 45000, 'precio' => 55000 ],
            ['tipo_alquiler' => 'vivienda','duracion' => -1, 'valor_desde' => 45001, 'valor_hasta' => 75000, 'precio' => 85000 ],
            ['tipo_alquiler' => 'comercial','duracion' => -1, 'valor_desde' => 45001, 'valor_hasta' => 75000, 'precio' => 85000 ],
        ];  

        foreach($cotizaciones as $cotizacion) {
            Cotizacion::create($cotizacion);
        }
    }
}
