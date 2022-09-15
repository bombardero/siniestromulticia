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
            $table->string('identificador');
            $table->string('estado_carga');
            $table->string('dominio_vehiculo_asegurado');
            $table->date('fecha');
            $table->time('hora');
            $table->string('lugar_nombre');
            $table->string('codigo_postal');
            $table->string('direccion');
            $table->string('nombre_conductor');
            $table->text('descripcion');
            $table->string('responsable_contacto_nombre');
            $table->string('responsable_contacto_domicilio');
            $table->string('responsable_contacto_telefono');
            $table->string('responsable_contacto_email');

            $table->enum('momento_dia',['diurno', 'nocturno'])->nullable();
            $table->boolean('estado_tiempo_seco')->nullable();
            $table->boolean('estado_tiempo_lluvia')->nullable();
            $table->boolean('estado_tiempo_niebla')->nullable();
            $table->boolean('estado_tiempo_despejado')->nullable();
            $table->boolean('estado_tiempo_nieve')->nullable();
            $table->boolean('estado_tiempo_granizo')->nullable();
            $table->string('estado_tiempo_otros_detalles')->nullable();

            $table->foreignId('province_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('calle')->nullable();
            $table->foreignId('tipo_calzada_id')->nullable()->constrained('tipo_calzadas');
            $table->string('calzada_detalle')->nullable();
            $table->string('interseccion')->nullable();
            $table->boolean('cruce_senalizado')->nullable();
            $table->boolean('tren')->nullable();
            $table->boolean('semaforo')->nullable();
            $table->boolean('semaforo_funciona')->nullable();
            $table->boolean('semaforo_intermitente')->nullable();
            $table->string('semaforo_color')->nullable();

            $table->boolean('intervino_otro_vehiculo')->nullable();
            $table->boolean('intervino_otro_vehiculo_datos')->nullable();

            $table->boolean('hubo_danios_materiales')->nullable();
            $table->boolean('hubo_lesionados')->nullable();

            $table->boolean('tipo_accidente_frontal')->nullable();
            $table->boolean('tipo_accidente_posterior')->nullable();
            $table->boolean('tipo_accidente_cadena')->nullable();
            $table->boolean('tipo_accidente_lateral')->nullable();
            $table->boolean('tipo_accidente_vuelco')->nullable();
            $table->boolean('tipo_accidente_desplaza')->nullable();
            $table->boolean('tipo_accidente_incendio')->nullable();
            $table->boolean('tipo_accidente_inmersion')->nullable();
            $table->boolean('tipo_accidente_explosion')->nullable();
            $table->boolean('tipo_accidente_carga')->nullable();
            $table->boolean('tipo_accidente_otros')->nullable();

            $table->boolean('lugar_autopista')->nullable();
            $table->boolean('lugar_calle')->nullable();
            $table->boolean('lugar_avenida')->nullable();
            $table->boolean('lugar_curva')->nullable();
            $table->boolean('lugar_pendiente')->nullable();
            $table->boolean('lugar_tunel')->nullable();
            $table->boolean('lugar_puente')->nullable();
            $table->boolean('lugar_otros')->nullable();

            $table->boolean('colision_peaton')->nullable();
            $table->boolean('colision_vehiculo')->nullable();
            $table->boolean('colision_edificio')->nullable();
            $table->boolean('colision_columna')->nullable();
            $table->boolean('colision_animal')->nullable();
            $table->boolean('colision_transporte_publico')->nullable();
            $table->boolean('colision_otros')->nullable();

            $table->string('denuncia_policial_comisaria')->nullable();
            $table->string('denuncia_policial_acta')->nullable();
            $table->string('denuncia_policial_folio')->nullable();
            $table->string('denuncia_policial_sumario')->nullable();
            $table->string('denuncia_policial_juzgado')->nullable();
            $table->string('denuncia_policial_secretaria')->nullable();
            $table->string('croquis_url')->nullable();
            $table->string('croquis_path')->nullable();
            $table->string('croquis_descripcion')->nullable();

            $table->string('nro_poliza')->nullable();
            $table->string('nro_denuncia')->nullable();
            $table->string('nro_siniestro')->nullable();
            $table->string('estado')->default('ingresado');

            $table->timestamps();
            $table->softDeletes();
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
