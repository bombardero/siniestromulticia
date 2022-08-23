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
            $table->text('carga_paso_7_danio_materiales_detalles')->nullable();
            $table->text('carga_paso_7_danio_materiales_nombre')->nullable();
            $table->text('carga_paso_7_danio_materiales_documento_id')->nullable();
            $table->text('carga_paso_7_danio_materiales_documento_numero')->nullable();
            $table->text('carga_paso_7_danio_materiales_codigo_postal')->nullable();
            $table->text('carga_paso_7_danio_materiales_domicilio')->nullable();

            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');

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
