<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHechoGeneradorIdToDenunciaSiniestros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            $table->foreignId('hecho_generador_id')->nullable()->after('user_id')->references('id')->on('hechos_generadores');
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
            $table->dropForeign(['hecho_generador_id']);
            $table->dropColumn(['hecho_generador_id']);
        });
    }
}
