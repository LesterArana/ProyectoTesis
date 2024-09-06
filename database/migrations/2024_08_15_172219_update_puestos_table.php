<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePuestosTable extends Migration
{
    public function up()
    {
        Schema::table('puestos', function (Blueprint $table) {
            $table->decimal('salario_quincena', 8, 2)->nullable()->after('salario_dia');
        });
    }

    public function down()
    {
        Schema::table('puestos', function (Blueprint $table) {
            $table->dropColumn('salario_quincena');
        });
    }
}

