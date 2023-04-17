<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosReclamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_reclamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reclamo_tercero_id')->constrained('reclamo_terceros');
            $table->string('nombre');
            $table->string('type');
            $table->string('formato');
            $table->string('url');
            $table->string('path');
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
        Schema::dropIfExists('documentos_reclamos');
    }
}
