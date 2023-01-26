<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamoVehiculoAseguradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamo_vehiculo_asegurados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reclamo_tercero_id')->constrained('reclamo_terceros');
            $table->string('dominio',7);
            $table->string('tipo');
            $table->year('anio');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('modelo_id')->nullable()->constrained('modelos');
            $table->string('otra_marca')->nullable();
            $table->string('otro_modelo')->nullable();
            $table->string('conductor_nombre')->nullable();
            $table->string('conductor_telefono',15)->nullable();
            $table->unsignedBigInteger('conductor_tipo_documento_id')->nullable();
            $table->foreign('conductor_tipo_documento_id','conductor_tipo_documento_id_foreign')->references('id')->on('tipo_documentos');
            $table->string('conductor_documento_numero',8)->nullable();
            $table->string('conductor_domicilio')->nullable();
            $table->string('conductor_codigo_postal',8)->nullable();
            $table->foreignId('conductor_pais_id')->nullable()->constrained('paises');
            $table->unsignedInteger('conductor_province_id')->nullable();
            $table->foreign('conductor_province_id')->references('id')->on('provinces');
            $table->foreignId('conductor_city_id')->nullable()->constrained('cities');
            $table->string('conductor_otro_pais_provincia_localidad')->nullable();
            $table->boolean('propietario_conductor')->nullable();
            $table->string('propietario_nombre')->nullable();
            $table->string('propietario_telefono',15)->nullable();
            $table->unsignedBigInteger('propietario_tipo_documento_id')->nullable();
            $table->foreign('propietario_tipo_documento_id','propietario_tipo_documento_id_foreign')->references('id')->on('tipo_documentos');
            $table->string('propietario_documento_numero',8)->nullable();
            $table->string('propietario_domicilio')->nullable();
            $table->string('propietario_codigo_postal',8)->nullable();
            $table->foreignId('propietario_pais_id')->nullable()->constrained('paises');
            $table->unsignedInteger('propietario_province_id')->nullable();
            $table->foreign('propietario_province_id')->references('id')->on('provinces');
            $table->foreignId('propietario_city_id')->nullable()->constrained('cities');
            $table->string('propietario_otro_pais_provincia_localidad')->nullable();



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
        Schema::dropIfExists('reclamo_vehiculo_asegurados');
    }
}
