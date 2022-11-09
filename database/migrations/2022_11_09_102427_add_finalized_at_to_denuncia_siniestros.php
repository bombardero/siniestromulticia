<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinalizedAtToDenunciaSiniestros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            $table->timestamp('finalized_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            $table->dropColumn(['finalized_at']);
        });
    }
}
