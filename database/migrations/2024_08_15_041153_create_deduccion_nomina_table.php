<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDeduccionesTable extends Migration
{
    public function up()
    {
        Schema::table('deducciones', function (Blueprint $table) {
            // Asegúrate de que estos campos existen
            $table->string('descripcion')->nullable()->change();
            $table->decimal('monto', 8, 2)->nullable()->change();

            // Aquí puedes agregar cualquier otro campo que necesites
            // Por ejemplo, si quieres agregar un tipo de deducción (fijo, porcentaje, etc.)
            $table->enum('tipo', ['fijo', 'porcentaje'])->default('fijo');
        });
    }

    public function down()
    {
        Schema::table('deducciones', function (Blueprint $table) {
            // Para revertir los cambios
            $table->dropColumn('tipo');
        });
    }
}

