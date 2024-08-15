<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertificadoColumnsToDenunciaSiniestroSisUnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestro_sis_unicos', function (Blueprint $table) {
            $table->string('certificado_cobertura_name')->nullable()->after('link_enviado');
            $table->string('certificado_cobertura_url')->nullable()->after('certificado_cobertura_name');
            $table->string('certificado_cobertura_path')->nullable()->after('certificado_cobertura_url');
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
            $table->dropColumn(['certificado_cobertura_name','certificado_cobertura_url', 'certificado_cobertura_path']);
        });
    }
}
