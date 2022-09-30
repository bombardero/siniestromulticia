<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MarcasModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(asset('data/marcas-modelos.json')), true);

        foreach ($data['list'] as $marca => $modelos)
        {
            $marca = Marca::create(['nombre' => $marca]);
            foreach ($modelos as $modelo)
            {
                $marca->modelos()->create(['nombre' => $modelo]);
            }
        }
    }
}
