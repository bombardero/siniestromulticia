<?php

use App\Models\DenunciaSiniestro;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkEnviadoModoToDenunciaSiniestros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncia_siniestros', function (Blueprint $table) {
            $table->string('link_enviado_modo')->nullable()->after('link_enviado');
        });

        DB::table('denuncia_siniestros')->eachById(function (object $denuncia_siniestros): void {
            if($denuncia_siniestros->link_enviado)
            {
                DB::table('denuncia_siniestros')->where('id', '=', $denuncia_siniestros->id)->update(['link_enviado_modo' => 'manual']);
            }
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
            $table->dropColumn('link_enviado_modo');
        });
    }
}
