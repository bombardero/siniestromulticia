<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLesionadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesionados', function (Blueprint $table) {
            $table->id();
            $table->text('carga_paso_8_lesionado_nombre')->nullable();
            $table->text('carga_paso_8_lesionado_telefono')->nullable();
            $table->text('carga_paso_8_lesionado_documento_id')->nullable();
            $table->text('carga_paso_8_lesionado_documento_numero')->nullable();
            $table->text('carga_paso_8_lesionado_codigo_postal')->nullable();
            $table->text('carga_paso_8_lesionado_domicilio')->nullable();
            $table->text('carga_paso_8_lesionado_estado_civil')->nullable();
            $table->text('carga_paso_8_lesionado_fecha_nacimiento')->nullable();
            $table->text('carga_paso_8_lesionado_relacion')->nullable();
            $table->text('carga_paso_8_lesionado_conductor')->nullable();
            $table->text('carga_paso_8_lesionado_pasajero_otro')->nullable();
            $table->text('carga_paso_8_lesionado_peaton')->nullable();
            $table->text('carga_paso_8_lesionado_pasajero_asegurado')->nullable();
            $table->text('carga_paso_8_lesionado_leve')->nullable();
            $table->text('carga_paso_8_lesionado_grave')->nullable();
            $table->text('carga_paso_8_lesionado_mortal')->nullable();
            $table->text('carga_paso_8_lesionado_alcoholemia_si')->nullable();
            $table->text('carga_paso_8_lesionado_alcoholemia_no')->nullable();
            $table->text('carga_paso_8_lesionado_alcoholemia_nego')->nullable();
            $table->text('carga_paso_8_lesionado_centro_asistencial')->nullable();

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
        Schema::dropIfExists('lesionados');
    }
}
