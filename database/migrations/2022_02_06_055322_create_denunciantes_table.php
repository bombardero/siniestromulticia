<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denunciantes', function (Blueprint $table) {
            $table->id();

            //denunciante
            $table->text('carga_paso_12_nombre')->nullable();
            $table->text('carga_paso_12_telefono')->nullable();
            $table->text('carga_paso_12_domicilio')->nullable();
            $table->text('carga_paso_12_codigo_postal')->nullable();
            $table->text('carga_paso_12_provincia_id')->nullable();
            $table->text('carga_paso_12_localidad_id')->nullable();
            $table->text('carga_paso_12_documento_id')->nullable();
            $table->text('carga_paso_12_documento_numero')->nullable();
            $table->text('carga_paso_12_asegurado_si')->nullable();
            $table->text('carga_paso_12_asegurado_no')->nullable();
            $table->text('carga_paso_12_asegurado_relacion')->nullable();
            $table->text('carga_paso_12_fecha')->nullable();
            $table->text('carga_paso_12_hora')->nullable();
            $table->text('carga_paso_12_lugar')->nullable();

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
        Schema::dropIfExists('denunciantes');
    }
}
