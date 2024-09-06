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
            $table->decimal('cantidad_iggs', 8, 2)->nullable();  // Añade esta línea
        });
    }
    
    public function down()
    {
        Schema::table('nominas', function (Blueprint $table) {
            $table->dropColumn('cantidad_iggs');  // Elimina esta línea si haces rollback
        });
    }
};
