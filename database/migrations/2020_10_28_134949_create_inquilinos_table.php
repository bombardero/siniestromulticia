<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquilinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquilinos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('dni');
            $table->string('telefono');
            $table->string('email');
            $table->string('domicilio');
            $table->foreignId('province_id');
            $table->foreignId('city_id');
            $table->integer('sueldo_uno')->nullable()->unsigned();;
            $table->integer('sueldo_dos')->nullable()->unsigned();;
            $table->integer('sueldo_tres')->nullable()->unsigned();;
            $table->boolean('type');
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
        Schema::dropIfExists('inquilinos');
    }
}
