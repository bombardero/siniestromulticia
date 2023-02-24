<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamoTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamo_terceros', function (Blueprint $table) {
            $table->id();
            $table->string('identificador');
            $table->string('estado_carga');
            $table->string('vehiculo_asegurado_dominio');
            $table->string('vehiculo_tercero_dominio')->nullable();
            $table->date('fecha');
            $table->time('hora');

            $table->string('lugar_nombre');

            $table->string('direccion');
            $table->text('descripcion');
            $table->string('responsable_contacto_nombre');
            $table->string('responsable_contacto_telefono');
            $table->string('responsable_contacto_email');

            //Asegurado
            $table->string('asegurado_nombre')->nullable();
            $table->string('vehiculo_asegurado_nro_poliza')->nullable();
            $table->foreignId('vehiculo_asegurado_marca_id')->nullable()->constrained('marcas');
            $table->foreignId('vehiculo_asegurado_modelo_id')->nullable()->constrained('modelos');
            $table->string('vehiculo_asegurado_otra_marca')->nullable();
            $table->string('vehiculo_asegurado_otro_modelo')->nullable();

            //Lugar
            $table->foreignId('pais_id')->nullable()->constrained('paises');
            $table->foreignId('province_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('otro_pais_provincia_localidad')->nullable();
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

            $table->string('croquis_url')->nullable();
            $table->string('croquis_path')->nullable();

            $table->boolean('link_enviado')->default(false);
            $table->boolean('reclamo_vehicular')->nullable();
            $table->boolean('reclamo_danios_materiales')->nullable();
            $table->boolean('reclamo_lesiones')->nullable();

            $table->unsignedBigInteger('monto_vehicular')->nullable();
            $table->unsignedBigInteger('monto_danios_materiales')->nullable();
            $table->unsignedBigInteger('monto_lesiones')->nullable();

            $table->string('comisaria')->nullable();
            $table->string('testigos')->nullable();

            $table->timestamps();
            $table->timestamp('finalized_at')->nullable();
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
        Schema::dropIfExists('reclamo_terceros');
    }
}
