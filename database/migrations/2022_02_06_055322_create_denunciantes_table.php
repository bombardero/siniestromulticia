<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denunciantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');
            $table->string('nombre');
            $table->string('telefono',15);
            $table->string('domicilio');
            $table->string('codigo_postal',8)->nullable();
            $table->foreignId('pais_id')->nullable()->constrained('paises');
            $table->foreignId('province_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('otro_pais_provincia_localidad')->nullable();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->string('documento_numero',8);
            $table->boolean('asegurado');
            $table->string('asegurado_relacion')->nullable();
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
        Schema::dropIfExists('denunciantes');
    }
}
