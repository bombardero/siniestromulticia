<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamoVehiculoTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamo_vehiculo_terceros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reclamo_tercero_id')->constrained('reclamo_terceros');
            $table->string('dominio',7);
            $table->string('tipo');
            $table->year('anio');
            $table->string('motor');
            $table->string('chasis');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('modelo_id')->nullable()->constrained('modelos');
            $table->string('otra_marca')->nullable();
            $table->string('otro_modelo')->nullable();
            $table->string('compania_seguros');
            $table->string('numero_poliza');
            $table->string('tipo_cobertura');
            $table->integer('franquicia');

            $table->string('conductor_nombre')->nullable();
            $table->string('conductor_telefono',15)->nullable();
            $table->foreignId('conductor_tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('conductor_documento_numero',8)->nullable();
            $table->string('conductor_domicilio')->nullable();
            $table->string('conductor_codigo_postal',8)->nullable();
            $table->foreignId('conductor_pais_id')->nullable()->constrained('paises');
            $table->unsignedInteger('conductor_province_id')->nullable();
            $table->foreign('conductor_province_id')->references('id')->on('provinces');
            $table->foreignId('conductor_city_id')->nullable()->constrained('cities');
            $table->string('conductor_otro_pais_provincia_localidad')->nullable();

            $table->string('licencia_numero')->nullable();
            $table->string('licencia_clase')->nullable();

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
        Schema::dropIfExists('reclamo_vehiculo_terceros');
    }
}
