<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nominas', function (Blueprint $table) {
            $table->unsignedBigInteger('puesto_id');
    
            $table->foreign('puesto_id')->references('id')->on('puestos')
                  ->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('nominas', function (Blueprint $table) {
        $table->dropForeign(['puesto_id']);
        $table->dropColumn('puesto_id');
    });
}

    
};
