<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNominasTable extends Migration
{
    public function up()
    {
        Schema::table('nominas', function (Blueprint $table) {
            // Agrega solo las columnas que no existen todavía
            if (!Schema::hasColumn('nominas', 'puesto_id')) {
                $table->unsignedBigInteger('puesto_id')->nullable()->after('empleado_id');
            }
            
            if (!Schema::hasColumn('nominas', 'total_pago')) {
                $table->decimal('total_pago', 8, 2)->nullable()->after('horas_trabajadas');
            }
            
            if (!Schema::hasColumn('nominas', 'deducciones')) {
                $table->decimal('deducciones', 8, 2)->nullable()->after('total_pago');
            }
            
            if (!Schema::hasColumn('nominas', 'salario_neto')) {
                $table->decimal('salario_neto', 8, 2)->nullable()->after('deducciones');
            }
            
            if (!Schema::hasColumn('nominas', 'fecha_inicio')) {
                $table->date('fecha_inicio')->default(DB::raw('CURRENT_DATE'))->after('salario_neto');
            }
            
            if (!Schema::hasColumn('nominas', 'fecha_fin')) {
                $table->date('fecha_fin')->default(DB::raw('CURRENT_DATE'))->after('fecha_inicio');
            }
        
            // Define la clave foránea para `puesto_id` si no existe
            if (!Schema::hasColumn('nominas', 'puesto_id')) {
                $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('nominas', function (Blueprint $table) {
            // Si necesitas revertir las modificaciones
            $table->dropForeign(['puesto_id']);
            $table->dropColumn(['puesto_id', 'total_pago', 'deducciones', 'salario_neto', 'fecha_inicio', 'fecha_fin']);
        });
    }
}
