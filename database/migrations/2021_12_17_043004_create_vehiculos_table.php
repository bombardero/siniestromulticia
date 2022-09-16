<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');
            $table->string('dominio',7);
            $table->string('tipo');
            $table->year('anio');
            $table->string('motor');
            $table->string('chasis');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('modelo_id')->nullable()->constrained('modelos');
            $table->string('otra_marca')->nullable();
            $table->string('otro_modelo')->nullable();
            $table->boolean('uso_particular')->nullable();
            $table->boolean('uso_comercial')->nullable();
            $table->boolean('uso_taxi_remis')->nullable();
            $table->boolean('uso_tpp')->nullable();
            $table->boolean('uso_urgencia')->nullable();
            $table->boolean('uso_seguridad')->nullable();
            $table->boolean('siniestro_danio')->nullable();
            $table->boolean('siniestro_robo')->nullable();
            $table->boolean('siniestro_incendio')->nullable();
            $table->text('detalles')->nullable();
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
        Schema::dropIfExists('vehiculos');
    }
}
