<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsNroPolizaNroDenunciaNroSiniestroEstadoToDenunciaSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            //
             $table->text('nro_poliza')->nullable();
             $table->text('nro_denuncia')->nullable();
             $table->text('nro_siniestro')->nullable();
             $table->text('estado')->default('ACEPTADO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            $table->dropColumn('nro_poliza');
            $table->dropColumn('nro_denuncia');
            $table->dropColumn('nro_siniestro');
            $table->dropColumn('estado');
        });
    }
}
