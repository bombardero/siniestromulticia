<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciaSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncia_siniestros', function (Blueprint $table) {
            $table->id();
            $table->text('identificador');
            $table->text('state');
            $table->text('precarga_dominio_vehiculo_asegurado');
            $table->date('precarga_fecha_siniestro');
            $table->time('precarga_hora_siniestro');
            $table->text('precarga_lugar');
            $table->text('precarga_codigo_postal');
            $table->text('precarga_direccion_siniestro');
            $table->text('precarga_conductor_vehiculo_nombre');
            $table->text('precarga_descripcion');
            $table->text('precarga_responsable_contacto_nombre');
            $table->text('precarga_responsable_contacto_domicilio');
            $table->text('precarga_responsable_contacto_telefono');
            $table->text('precarga_responsable_contacto_email');

            $table->text('carga_paso_1_diurno')->nullable();
            $table->text('carga_paso_1_nocturno')->nullable();
            $table->text('carga_paso_1_seco')->nullable();
            $table->text('carga_paso_1_lluvia')->nullable();
            $table->text('carga_paso_1_niebla')->nullable();
            $table->text('carga_paso_1_despejado')->nullable();
            $table->text('carga_paso_1_nieve')->nullable();
            $table->text('carga_paso_1_granizo')->nullable();
            $table->text('carga_paso_1_otros')->nullable();
            $table->text('carga_paso_1_otros_detalle')->nullable();

            $table->text('carga_paso_6_intervino_si')->nullable();
            $table->text('carga_paso_6_intervino_no')->nullable();
            $table->text('carga_paso_6_datos_si')->nullable();
            $table->text('carga_paso_6_datos_no')->nullable();

            $table->text('carga_paso_7_danios_si')->nullable();
            $table->text('carga_paso_7_danios_no')->nullable();

            $table->text('carga_paso_8_lesionados_si')->nullable();
            $table->text('carga_paso_8_lesionados_no')->nullable();

            $table->text('carga_paso_9_tipo_accidente_frontal')->nullable();
            $table->text('carga_paso_9_tipo_accidente_posterior')->nullable();
            $table->text('carga_paso_9_tipo_accidente_cadena')->nullable();
            $table->text('carga_paso_9_tipo_accidente_lateral')->nullable();
            $table->text('carga_paso_9_tipo_accidente_vuelco')->nullable();
            $table->text('carga_paso_9_tipo_accidente_desplaza')->nullable();
            $table->text('carga_paso_9_tipo_accidente_incendio')->nullable();
            $table->text('carga_paso_9_tipo_accidente_inmersion')->nullable();
            $table->text('carga_paso_9_tipo_accidente_explosion')->nullable();
            $table->text('carga_paso_9_tipo_accidente_carga')->nullable();
            $table->text('carga_paso_9_tipo_accidente_otros')->nullable();

            $table->text('carga_paso_9_lugar_autopista')->nullable();
            $table->text('carga_paso_9_lugar_calle')->nullable();
            $table->text('carga_paso_9_lugar_avenida')->nullable();
            $table->text('carga_paso_9_lugar_curva')->nullable();
            $table->text('carga_paso_9_lugar_pendiente')->nullable();
            $table->text('carga_paso_9_lugar_tunel')->nullable();
            $table->text('carga_paso_9_lugar_sobrepuente')->nullable();
            $table->text('carga_paso_9_lugar_otros')->nullable();

            $table->text('carga_paso_9_colision_peaton')->nullable();
            $table->text('carga_paso_9_colision_vehiculo')->nullable();
            $table->text('carga_paso_9_colision_edificio')->nullable();
            $table->text('carga_paso_9_colision_columna')->nullable();
            $table->text('carga_paso_9_colision_animal')->nullable();
            $table->text('carga_paso_9_colision_transporte')->nullable();
            $table->text('carga_paso_9_colision_otros')->nullable();


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
        Schema::dropIfExists('denuncia_siniestros');
    }
}
