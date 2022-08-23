<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAseguradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asegurados', function (Blueprint $table) {
            $table->id();

            //asegurado
            $table->text('carga_paso_4_asegurado_nombre')->nullable();
            $table->text('carga_paso_4_asegurado_documento_id')->nullable();
            $table->text('carga_paso_4_asegurado_documento_numero')->nullable();
            $table->text('carga_paso_4_asegurado_domicilio')->nullable();
            $table->text('carga_paso_4_asegurado_codigo_postal')->nullable();
            $table->text('carga_paso_4_asegurado_pais_id')->nullable();
            $table->text('carga_paso_4_asegurado_provincia_id')->nullable();
            $table->text('carga_paso_4_asegurado_localidad_id')->nullable();
            $table->text('carga_paso_4_asegurado_ocupacion')->nullable();
            $table->text('carga_paso_4_asegurado_telefono')->nullable();

            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');

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
        Schema::dropIfExists('asegurados');
    }
}
