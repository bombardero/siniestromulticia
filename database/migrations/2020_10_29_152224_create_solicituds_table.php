<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('estado_inquilino_uno');
            $table->boolean('estado_propietario_dos');
            $table->boolean('estado_contrato_tres');
            $table->boolean('estado_inmobiliaria_cuatro');
            $table->boolean('estado_aval_cinco');
            $table->double('monto')->nullable();
            $table->string('status');
            $table->foreignId('cotizacion_id')->constrained('cotizacions')->onDelete('cascade');
            $table->foreignId('inquilino_id')->nullable()->constrained('inquilinos')->onDelete('cascade');
            $table->foreignId('propietario_id')->nullable()->constrained('propietarios')->onDelete('cascade');
            $table->foreignId('inmobiliaria_id')->nullable()->contrained('users')->onDelete('cascade');

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
        Schema::dropIfExists('solicituds');
    }
}
