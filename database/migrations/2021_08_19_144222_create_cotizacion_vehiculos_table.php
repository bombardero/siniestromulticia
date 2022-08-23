<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_vehiculos', function (Blueprint $table) {
            $table->id()->from(10000);
            $table->string("tipo");
            $table->string("año");
            $table->string("marca");
            $table->string("modelo");
            $table->string("usos");
            $table->string("codigo_postal");
            $table->string("email");
            $table->string("numero");
            $table->string("provincia");
            $table->text("coberturas")->nullable();
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
        Schema::dropIfExists('cotizacion_vehiculos');
    }
}
