<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('direccion')->nullable()->change();
            $table->string('codigo_postal')->nullable()->change();
            $table->string('cuit')->nullable()->change();
            $table->string('telefono')->nullable()->change();                        
            $table->foreignId('city_id')->nullable()->change();
                                    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('direccion');
        });        //
    }
}
