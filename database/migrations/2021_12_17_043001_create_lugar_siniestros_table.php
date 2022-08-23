<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLugarSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lugar_siniestros', function (Blueprint $table) {
            $table->id();

            //lugar siniestro
            $table->text('carga_paso_2_provincia_id')->nullable();
            $table->text('carga_paso_2_localidad_id')->nullable();
            $table->text('carga_paso_2_calle')->nullable();
            $table->text('carga_paso_2_calzada_id')->nullable();
            $table->text('carga_paso_2_calzada_detalle')->nullable();
            $table->text('carga_paso_2_interseccion')->nullable();
            $table->text('carga_paso_2_cruce_senalizado')->nullable();
            $table->text('carga_paso_2_tren_si')->nullable();
            $table->text('carga_paso_2_tren_no')->nullable();
            $table->text('carga_paso_2_semaforo')->nullable();
            $table->text('carga_paso_2_semaforo_funciona')->nullable();
            $table->text('carga_paso_2_semaforo_intermitente')->nullable();
            $table->text('carga_paso_2_semaforo_color')->nullable();

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
        Schema::dropIfExists('lugar_siniestros');
    }
}
