<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();

            //conductor
            $table->text('carga_paso_3_nombre')->nullable();
            $table->text('carga_paso_3_telefono')->nullable();
            $table->text('carga_paso_3_domicilio')->nullable();
            $table->text('carga_paso_3_codigo_postal')->nullable();
            $table->text('carga_paso_3_pais_id')->nullable();
            $table->text('carga_paso_3_provincia_id')->nullable();
            $table->text('carga_paso_3_localidad_id')->nullable();
            $table->text('carga_paso_3_fecha_nacimiento')->nullable();
            $table->text('carga_paso_3_documento_id')->nullable();
            $table->text('carga_paso_3_documento_numero')->nullable();
            $table->text('carga_paso_3_ocupacion')->nullable();
            $table->text('carga_paso_3_numero_registro')->nullable();
            $table->text('carga_paso_3_estado_civil')->nullable();
            $table->text('carga_paso_3_carnet_id')->nullable();
            $table->text('carga_paso_3_carnet_categoria')->nullable();
            $table->text('carga_paso_3_carnet_vencimiento')->nullable();
            $table->text('carga_paso_3_alcoholemia_si')->nullable();
            $table->text('carga_paso_3_alcoholemia_no')->nullable();
            $table->text('carga_paso_3_alcoholemia_nego')->nullable();
            $table->text('carga_paso_3_habitual_si')->nullable();
            $table->text('carga_paso_3_habitual_no')->nullable();
            $table->text('carga_paso_3_asegurado_si')->nullable();
            $table->text('carga_paso_3_asegurado_no')->nullable();
            $table->text('carga_paso_3_asegurado_relacion')->nullable();

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
        Schema::dropIfExists('conductores');
    }
}
