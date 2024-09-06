<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeduccionsTable extends Migration
{
    public function up()
    {
        Schema::create('deducciones', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('monto', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deducciones');
    }
}
