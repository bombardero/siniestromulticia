<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanioMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danio_materiales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');
            $table->string('detalles');
            $table->string('propietario_nombre')->nullable();
            $table->foreignId('propietario_tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('propietario_documento_numero',8)->nullable();
            $table->string('propietario_codigo_postal',8)->nullable();
            $table->string('propietario_domicilio')->nullable();
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
        Schema::dropIfExists('danio_materiales');
    }
}
