<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEsPorcentajeToDeduccionesTable extends Migration
{
    public function up()
    {
        Schema::table('deducciones', function (Blueprint $table) {
            $table->boolean('es_porcentaje')->default(false); // Campo para indicar si es porcentaje
        });
    }

    public function down()
    {
        Schema::table('deducciones', function (Blueprint $table) {
            $table->dropColumn('es_porcentaje');
        });
    }
}

