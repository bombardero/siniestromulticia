<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubestadoToDenunciaSiniestros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            $table->string('subestado')->nullable()->after('estado');
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
        });
    }
}
