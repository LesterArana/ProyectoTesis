<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominasTable extends Migration
{
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id'); // Asegúrate de que esta columna ya exista
            $table->unsignedBigInteger('puesto_id'); // Asegúrate de que esta columna ya exista
            $table->integer('horas_trabajadas')->nullable();
            $table->decimal('total_pago', 8, 2)->nullable();
            $table->decimal('deducciones', 8, 2)->nullable();
            $table->decimal('salario_neto', 8, 2)->nullable();
            $table->date('fecha_inicio')->default(DB::raw('CURRENT_DATE'));
            $table->date('fecha_fin')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();

            // Relaciones
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nominas');
    }
}
