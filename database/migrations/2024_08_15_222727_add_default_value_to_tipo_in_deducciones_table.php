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
        Schema::table('deducciones', function (Blueprint $table) {
            $table->string('tipo')->default('fijo')->change(); // Asignando un valor por defecto
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('deducciones', function (Blueprint $table) {
        $table->string('tipo')->default(null)->change(); // Volviendo al estado anterior si se deshace la migración
    });
    }
};
