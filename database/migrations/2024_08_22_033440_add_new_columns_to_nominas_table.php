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
        $table->decimal('bonificacion_incentivo', 10, 2)->nullable();
        $table->decimal('bonificacion_rendimiento', 10, 2)->nullable();
        $table->decimal('cantidad_igss', 10, 2)->nullable();
        $table->decimal('pasajes_viaticos', 10, 2)->nullable();
        $table->decimal('total_descuentos', 10, 2)->nullable();
        $table->decimal('salario_liquido', 10, 2)->nullable();
    });
}

public function down()
{
    Schema::table('nominas', function (Blueprint $table) {
        $table->dropColumn('bonificacion_incentivo');
        $table->dropColumn('bonificacion_rendimiento');
        $table->dropColumn('cantidad_igss');
        $table->dropColumn('pasajes_viaticos');
        $table->dropColumn('total_descuentos');
        $table->dropColumn('salario_liquido');
    });
}

};
