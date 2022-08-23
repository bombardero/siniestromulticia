<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_siniestros', function (Blueprint $table) {
            $table->id();

            //asegurado
            $table->text('carga_paso_10_comisaria')->nullable();
            $table->text('carga_paso_10_acta')->nullable();
            $table->text('carga_paso_10_folio')->nullable();
            $table->text('carga_paso_10_sumario')->nullable();
            $table->text('carga_paso_10_juzgado')->nullable();
            $table->text('carga_paso_10_secretaria')->nullable();
            $table->string('carga_paso_10_url_detalle')->nullable();
            $table->string('carga_paso_10_descripcion')->nullable();

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
        Schema::dropIfExists('detalle_siniestrs');
    }
}
