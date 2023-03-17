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
        Schema::create('reclamo_lesionados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reclamo_tercero_id')->constrained('reclamo_terceros');
            $table->string('nombre')->nullable();
            $table->string('telefono',15)->nullable();
            $table->foreignId('tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('documento_numero',8)->nullable();
            $table->string('domicilio')->nullable();
            $table->string('codigo_postal',8)->nullable();
            $table->foreignId('pais_id')->nullable()->constrained('paises');
            $table->unsignedInteger('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->string('otro_pais_provincia_localidad')->nullable();
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
