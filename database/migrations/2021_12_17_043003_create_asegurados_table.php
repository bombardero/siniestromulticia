<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAseguradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asegurados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');
            $table->string('nombre');
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->string('documento_numero',8);
            $table->string('domicilio');
            $table->string('codigo_postal',8);
            $table->foreignId('pais_id')->nullable()->constrained('paises');
            $table->foreignId('province_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('otro_pais_provincia_localidad')->nullable();
            $table->string('ocupacion');
            $table->string('telefono',15);
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
        Schema::dropIfExists('asegurados');
    }
}
