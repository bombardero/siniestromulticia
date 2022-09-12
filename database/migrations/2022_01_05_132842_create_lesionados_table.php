<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLesionadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesionados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');
            $table->string('nombre')->nullable();
            $table->string('telefono',15)->nullable();
            $table->foreignId('tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('documento_numero',8)->nullable();
            $table->string('codigo_postal',8)->nullable();
            $table->string('domicilio')->nullable();
            $table->string('estado_civil')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('relacion')->nullable();
            $table->enum('tipo',['conductor','pasajero_otro_vehiculo','peaton','pasajero_vehiculo_asegurado'])->nullable();
            $table->enum('gravedad_lesion',['leve','grave','mortal'])->nullable();
            $table->boolean('alcoholemia')->nullable();
            $table->boolean('alcoholemia_se_nego')->nullable();
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
        Schema::dropIfExists('lesionados');
    }
}
