<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamoVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamo_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reclamo_tercero_id')->constrained('reclamo_terceros');
            $table->string('dominio',7);
            $table->string('tipo');
            $table->year('anio');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('modelo_id')->nullable()->constrained('modelos');
            $table->string('otra_marca')->nullable();
            $table->string('otro_modelo')->nullable();
            $table->boolean('en_transferencia');
            $table->boolean('con_seguro');
            $table->string('compania_seguros')->nullable();
            $table->string('numero_poliza')->nullable();
            $table->string('tipo_cobertura')->nullable();
            $table->string('franquicia')->nullable();
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
        Schema::dropIfExists('reclamo_vehiculo_terceros');
    }
}
