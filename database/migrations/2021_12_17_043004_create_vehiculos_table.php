<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();

            //vehiculo
            $table->text('carga_paso_5_vehiculo_marca_id')->nullable();
            $table->text('carga_paso_5_vehiculo_modelo_id')->nullable();
            $table->text('carga_paso_5_vehiculo_tipo')->nullable();
            $table->text('carga_paso_5_vehiculo_anio')->nullable();
            $table->text('carga_paso_5_vehiculo_dominio')->nullable();
            $table->text('carga_paso_5_vehiculo_motor')->nullable();
            $table->text('carga_paso_5_vehiculo_chasis')->nullable();
            $table->text('carga_paso_5_vehiculo_particular')->nullable();
            $table->text('carga_paso_5_vehiculo_comercial')->nullable();
            $table->text('carga_paso_5_vehiculo_taxi')->nullable();
            $table->text('carga_paso_5_vehiculo_tp')->nullable();
            $table->text('carga_paso_5_vehiculo_urgencia')->nullable();
            $table->text('carga_paso_5_vehiculo_seguridad')->nullable();
            $table->text('carga_paso_5_vehiculo_siniestro_danio')->nullable();
            $table->text('carga_paso_5_vehiculo_siniestro_robo')->nullable();
            $table->text('carga_paso_5_vehiculo_siniestro_incendio')->nullable();
            $table->text('carga_paso_5_vehiculo_detalles')->nullable();

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
        Schema::dropIfExists('vehiculos');
    }
}
