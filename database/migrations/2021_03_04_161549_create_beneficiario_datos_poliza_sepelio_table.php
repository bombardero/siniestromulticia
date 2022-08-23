<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiarioDatosPolizaSepelioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiario_datos_poliza_sepelio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datos_poliza_sepelio_id');
            $table->foreignId('beneficiario_id');            
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
        Schema::dropIfExists('beneficiario_datos_poliza_sepelio');
    }
}
