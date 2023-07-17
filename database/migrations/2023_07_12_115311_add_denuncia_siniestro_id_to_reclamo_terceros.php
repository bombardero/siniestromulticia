<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDenunciaSiniestroIdToReclamoTerceros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reclamo_terceros', function (Blueprint $table) {
            $table->foreignId('denuncia_siniestro_id')->nullable()->after('user_id')->constrained('denuncia_siniestros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reclamo_terceros', function (Blueprint $table) {
            $table->dropForeign(['denuncia_siniestro_id']);
            $table->dropColumn(['denuncia_siniestro_id']);
        });
    }
}
