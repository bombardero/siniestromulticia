<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPolizaSepeliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_poliza_sepelios', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_cobertura');
            $table->string('inicio_vigencia');
            $table->string('plazo_carencia');
            $table->string('facturacion');
            $table->string('cuotas');
            $table->foreignId('asegurable_id');
            $table->foreignId('productor_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_poliza_sepelios');
    }
}

