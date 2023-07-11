<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubestadoAndEstadoObservacionAndEstadoFechaToReclamoTerceros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reclamo_terceros', function (Blueprint $table) {
            $table->string('subestado')->nullable()->after('estado');
            $table->string('estado_observacion')->nullable()->after('subestado');
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
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            $table->dropColumn('subestado');
            $table->dropColumn('estado_observacion');
            $table->dropColumn('estado_fecha');
        });
    }
}
