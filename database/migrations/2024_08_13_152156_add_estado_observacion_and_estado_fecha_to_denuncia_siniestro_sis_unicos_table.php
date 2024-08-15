<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoObservacionAndEstadoFechaToDenunciaSiniestroSisUnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestro_sis_unicos', function (Blueprint $table) {
            $table->string('estado_observacion')->nullable()->after('estado');
            $table->date('estado_fecha')->nullable()->after('estado_observacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('denuncia_siniestro_sis_unicos', function (Blueprint $table) {
            $table->dropColumn('estado_observacion');
            $table->dropColumn('estado_fecha');
        });
    }
}
