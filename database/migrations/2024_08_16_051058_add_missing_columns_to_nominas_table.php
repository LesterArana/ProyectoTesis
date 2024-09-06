<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToNominasTable extends Migration
{
    public function up()
    {
        Schema::table('nominas', function (Blueprint $table) {
            // Solo agregar columnas si no existen
            if (!Schema::hasColumn('nominas', 'puesto_id')) {
                $table->unsignedBigInteger('puesto_id')->nullable();
                $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('set null');
            }

            if (!Schema::hasColumn('nominas', 'total_pago')) {
                $table->decimal('total_pago', 10, 2)->nullable();
            }

            if (!Schema::hasColumn('nominas', 'salario_neto')) {
                $table->decimal('salario_neto', 10, 2)->nullable();
            }

            if (!Schema::hasColumn('nominas', 'deducciones')) {
                $table->decimal('deducciones', 10, 2)->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('nominas', function (Blueprint $table) {
            $table->dropForeign(['puesto_id']);
            $table->dropColumn(['puesto_id', 'total_pago', 'salario_neto', 'deducciones']);
        });
    }
}

