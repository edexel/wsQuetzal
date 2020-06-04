<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('descripcion', 500);
            $table->string('password', 15);
            $table->string('email', 30)->unique();
            $table->string('tokenRecover', 1000);
            $table->boolean('activo');
            $table->timestamp('created_at', 0);
            $table->timestamp('updated_at', 0);
            $table->timestamp('deleted_at', 0);
        });
    }
    // Joel Puto

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
