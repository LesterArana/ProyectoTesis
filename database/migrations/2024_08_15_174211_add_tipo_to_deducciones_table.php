<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoToDeduccionesTable extends Migration
{
    public function up()
    {
        Schema::table('deducciones', function (Blueprint $table) {
            $table->string('tipo')->after('monto'); // Agrega la columna 'tipo' después de la columna 'monto'
        });
    }

    public function down()
    {
        Schema::table('deducciones', function (Blueprint $table) {
            $table->dropColumn('tipo'); // Elimina la columna 'tipo' si se revierte la migración
        });
    }
}
