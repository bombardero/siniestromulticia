<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsegurablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asegurables', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_asegurable');
            $table->string('dni_asegurable');
            $table->string('ocupacion');
            $table->string('cuit_asegurable');
            $table->string('condicion_iva');
            $table->string('lugar_nacimiento_asegurable');
            $table->string('fecha_nacimiento_asegurable');
            $table->string('edad_asegurable');
            $table->string('sexo_asegurable');
            $table->string('nacionalidad_asegurable');
            $table->boolean('mano_habil');
            $table->string('estado_civil');
            $table->string('domicilio_asegurable');
            $table->string('email_asegurable');
            $table->foreignId('province_id');
            $table->foreignId('city_id');
            $table->text('firma')->nullable();
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
        Schema::dropIfExists('asegurables');
    }
}
