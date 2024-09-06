<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveHoraDiaFromPuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puestos', function (Blueprint $table) {
            if (Schema::hasColumn('puestos', 'salario_hora')) {
                $table->dropColumn('salario_hora');
            }
            if (Schema::hasColumn('puestos', 'salario_dia')) {
                $table->dropColumn('salario_dia');
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
        Schema::table('puestos', function (Blueprint $table) {
            $table->decimal('salario_hora', 8, 2)->nullable();
            $table->decimal('salario_dia', 8, 2)->nullable();
        });
    }
}

