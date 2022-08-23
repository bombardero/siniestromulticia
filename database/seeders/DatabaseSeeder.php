<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         $this->call(RolAndPermissionSeeder::class);
         $this->call(ProvinceSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(UsersSeed::class);
         $this->call(CotizacionSeeder::class);
         $this->call(TipoCalzadaSeeder::class);
         $this->call(TipoDocumentoSeeder::class);
         $this->call(TipoCarnetSeeder::class);
         $this->call(MarcaSeeder::class);
         $this->call(ModeloSeeder::class);
    }
}
