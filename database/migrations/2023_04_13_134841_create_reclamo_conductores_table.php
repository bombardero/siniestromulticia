<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamoConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamo_conductores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reclamo_tercero_id')->constrained('reclamo_terceros');
            $table->string('nombre')->nullable();
            $table->string('telefono',15)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->foreignId('tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('documento_numero',8)->nullable();
            $table->string('domicilio')->nullable();
            $table->string('codigo_postal',8)->nullable();
            $table->foreignId('pais_id')->nullable()->constrained('paises');
            $table->unsignedInteger('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->string('otro_pais_provincia_localidad')->nullable();
            $table->string('licencia_numero');
            $table->string('licencia_clase');
            $table->boolean('alcoholemia');
            $table->boolean('alcoholemia_se_nego');
            $table->boolean('lesiones')->default(false);
            $table->enum('gravedad_lesion',['leve','grave','mortal'])->nullable();
            $table->string('centro_asistencial')->nullable();
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
        Schema::dropIfExists('reclamo_conductores');
    }
}
