<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo_terceros', function (Blueprint $table) {
            $table->id();

            $table->text('carga_paso_6_vehiculo_terceros_propietario_nombre')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_propietario_telefono')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_propietario_documento_id')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_propietario_documento_numero')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_propietario_codigo_postal')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_propietario_domicilio')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_marca_id')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_modelo_id')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_tipo')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_anio')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_dominio')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_motor')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_chasis')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_particular')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_comercial')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_taxi')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_tp')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_urgencia')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_seguridad')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_detalles')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_conductor_nombre')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_telefono')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_conductor_documento_id')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_documento_numero')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_codigo_postal')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_conductor_domicilio')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_registro')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_conductor_carnet_id')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_categoria')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_vencimiento')->nullable();

            $table->text('carga_paso_6_vehiculo_terceros_conductor_alcoholemia_si')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_alcoholemia_no')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_alcoholemia_nego')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_habitual_si')->nullable();
            $table->text('carga_paso_6_vehiculo_terceros_conductor_habitual_no')->nullable();


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
        Schema::dropIfExists('vehiculo_terceros');
    }
}
