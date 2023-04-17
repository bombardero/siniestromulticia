<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamoDanioMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamo_danio_materiales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reclamo_tercero_id')->constrained('reclamo_terceros');
            $table->string('tipo');
            $table->text('detalles');
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
        Schema::dropIfExists('reclamo_danio_materiales');
    }
}
