<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_denuncias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('type');
            $table->string('url');
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
        Schema::dropIfExists('documentos_denuncias');
    }
}
