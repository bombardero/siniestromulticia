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
        $provinces = [
            ['id' => 1, 'cod' => 'CABA', 'name' => 'CIUDAD AUTÓNOMA DE BUENOS AIRES'],
            ['id' => 2, 'cod' => 'BA', 'name' => 'BUENOS AIRES'],
            ['id' => 3, 'cod' => 'CT', 'name' => 'CATAMARCA'],
            ['id' => 4, 'cod' => 'CBA', 'name' => 'CÓRDOBA'],
            ['id' => 5, 'cod' => 'CR', 'name' => 'CORRIENTES'],
            ['id' => 6, 'cod' => 'ER', 'name' => 'ENTRE RÍOS'],
            ['id' => 7, 'cod' => 'JY', 'name' => 'JUJUY'],
            ['id' => 8, 'cod' => 'MZ', 'name' => 'MENDOZA'],
            ['id' => 9, 'cod' => 'LR', 'name' => 'LA RIOJA'],
            ['id' => 10, 'cod' => 'SA', 'name' => 'SALTA'],
            ['id' => 11, 'cod' => 'SJ', 'name' => 'SAN JUAN'],
            ['id' => 12, 'cod' => 'SL', 'name' => 'SAN LUIS'],
            ['id' => 13, 'cod' => 'SF', 'name' => 'SANTA FE'],
            ['id' => 14, 'cod' => 'SE', 'name' => 'SANTIAGO DEL ESTERO'],
            ['id' => 15, 'cod' => 'TM', 'name' => 'TUCUMÁN'],
            ['id' => 16, 'cod' => 'CC', 'name' => 'CHACO'],
            ['id' => 17, 'cod' => 'CH', 'name' => 'CHUBUT'],
            ['id' => 18, 'cod' => 'FO', 'name' => 'FORMOSA'],
            ['id' => 19, 'cod' => 'MN', 'name' => 'MISIONES'],
            ['id' => 20, 'cod' => 'NQ', 'name' => 'NEUQUÉN'],
            ['id' => 21, 'cod' => 'LP', 'name' => 'LA PAMPA'],
            ['id' => 22, 'cod' => 'RN', 'name' => 'RÍO NEGRO'],
            ['id' => 23, 'cod' => 'SC', 'name' => 'SANTA CRUZ'],
            ['id' => 24, 'cod' => 'TF', 'name' => 'TIERRA DEL FUEGO'],
        ];

        foreach($provinces as $province) {
            Province::create($province);
        }
    }
}
