<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCiaColumnInDenunciaSiniestroSisUnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestro_sis_unicos', function (Blueprint $table) {
            $table->string('cia')->nullable()->change();
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
            $table->string('cia')->nullable(false)->change();
        });
    }
}
