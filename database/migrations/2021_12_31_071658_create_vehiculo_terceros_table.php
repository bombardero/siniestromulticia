<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo_terceros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_siniestro_id')->constrained('denuncia_siniestros');
            $table->string('propietario_nombre')->nullable();
            $table->string('propietario_telefono')->nullable();
            $table->foreignId('propietario_tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('propietario_documento_numero',8)->nullable();
            $table->string('propietario_codigo_postal',8)->nullable();
            $table->string('propietario_domicilio')->nullable();
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('modelo_id')->nullable()->constrained('modelos');
            $table->string('otra_marca')->nullable();
            $table->string('otro_modelo')->nullable();
            $table->string('tipo')->nullable();
            $table->year('anio')->nullable();
            $table->string('dominio',7)->nullable();
            $table->string('motor')->nullable();
            $table->string('chasis')->nullable();
            $table->boolean('uso_particular')->nullable();
            $table->boolean('uso_comercial')->nullable();
            $table->boolean('uso_taxi_remis')->nullable();
            $table->boolean('uso_tpp')->nullable();
            $table->boolean('uso_urgencia')->nullable();
            $table->boolean('uso_seguridad')->nullable();
            $table->string('detalles')->nullable();
            $table->string('conductor_nombre')->nullable();
            $table->string('conductor_telefono',15)->nullable();
            $table->foreignId('conductor_tipo_documento_id')->nullable()->constrained('tipo_documentos');
            $table->string('conductor_documento_numero',8)->nullable();
            $table->string('conductor_codigo_postal',8)->nullable();
            $table->string('conductor_domicilio')->nullable();
            $table->string('conductor_registro')->nullable();
            $table->foreignId('conductor_tipo_carnet_id')->nullable()->constrained('tipo_carnets');
            $table->string('conductor_categoria')->nullable();
            $table->string('conductor_vencimiento',5)->nullable();
            $table->boolean('conductor_alcoholemia')->nullable();
            $table->boolean('conductor_alcoholemia_se_nego')->nullable();
            $table->boolean('conductor_habitual')->nullable();
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
        Schema::dropIfExists('vehiculo_terceros');
    }
}
