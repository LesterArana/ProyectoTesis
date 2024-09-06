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
        $table->decimal('valor_hora_extra', 8, 2)->nullable()->after('horas_extras');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('nominas', function (Blueprint $table) {
        $table->dropColumn('valor_hora_extra');
    });
}
};
