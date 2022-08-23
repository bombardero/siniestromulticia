<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_familiars', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_familia');
            $table->string('parentesco_familiar');
            $table->string('dni_familia');
            $table->string('fecha_nacimiento_familia');
            $table->string('celular_familia');
            $table->foreignId('asegurable_id');            
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
        Schema::dropIfExists('grupo_familiars');
    }
}
