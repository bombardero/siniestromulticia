<?php

use App\Models\DenunciaSiniestro;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observaciones', function (Blueprint $table): void {
            $table->after('id', function (Blueprint $table) {
                $table->nullableMorphs('observacionable');
            });
        });

        DB::table('observaciones')->eachById(function (object $observacion): void {
            DB::table('observaciones')
                ->where('id', '=', $observacion->id)
                ->update([
                    'observacionable_id' => $observacion->denuncia_siniestro_id,
                    'observacionable_type' => DenunciaSiniestro::class,
                ]);
        });

        Schema::table('observaciones', function (Blueprint $table): void {

            $table->dropForeign('observaciones_denuncia_siniestro_id_foreign');
            $table->dropColumn('denuncia_siniestro_id');

            $table->string('observacionable_type')->nullable(false)->after('id')->change();
            $table->unsignedBigInteger('observacionable_id')->nullable(false)->after('observacionable_type')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
