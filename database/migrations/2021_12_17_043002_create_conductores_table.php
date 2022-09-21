<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');
            $table->string('nombre')->nullable();
            $table->string('telefono',15)->nullable();
            $table->string('domicilio')->nullable();
            $table->string('codigo_postal',8)->nullable();
            $table->string('pais_id')->nullable();
            $table->foreignId('province_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->foreignId('tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('documento_numero',8)->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('numero_registro')->nullable();
            $table->string('estado_civil')->nullable();
            $table->foreignId('tipo_carnet_id')->nullable()->constrained('tipo_carnets');
            $table->string('carnet_categoria')->nullable();
            $table->date('carnet_vencimiento')->nullable();
            $table->boolean('alcoholemia')->nullable();
            $table->boolean('alcoholemia_se_nego')->nullable();
            $table->boolean('habitual')->nullable();
            $table->boolean('asegurado')->nullable();
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
        Schema::dropIfExists('conductores');
    }
}
