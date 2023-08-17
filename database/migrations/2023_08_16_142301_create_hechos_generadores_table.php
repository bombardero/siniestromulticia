<?php

use App\Models\HechoGenerador;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHechosGeneradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hechos_generadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->char('codigo_compania',2);
            $table->timestamps();
        });
        HechoGenerador::create(['nombre' => 'RC LESIONES TERC/TRANSPORTADOS', 'codigo_compania' => '01']);
        HechoGenerador::create(['nombre' => 'RC LESIONES TERC/NO TRANSPORT.', 'codigo_compania' => '02']);
        HechoGenerador::create(['nombre' => 'RC DAÑOS A COSAS', 'codigo_compania' => '03']);
        HechoGenerador::create(['nombre' => 'ROBO PARCIAL', 'codigo_compania' => '04']);
        HechoGenerador::create(['nombre' => 'ROBO TOTAL', 'codigo_compania' => '05']);
        HechoGenerador::create(['nombre' => 'INCENDIO PARCIAL', 'codigo_compania' => '06']);
        HechoGenerador::create(['nombre' => 'INCENDIO TOTAL', 'codigo_compania' => '07']);
        HechoGenerador::create(['nombre' => 'DAÑO PARCIAL (TODO RIESGO)', 'codigo_compania' => '08']);
        HechoGenerador::create(['nombre' => 'DAÑO TOTAL (TODO RIESGO)', 'codigo_compania' => '09']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hechos_generadores');
    }
}
