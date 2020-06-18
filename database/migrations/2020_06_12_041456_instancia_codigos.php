<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InstanciaCodigos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instancia_codigos', function (Blueprint $table) {
            $table->id('idInstanciaCodigos');
            $table->foreignId('idInstanciaSistema')->references('idInstanciaSistema')->on('instancia_sistema');
            $table->string('codigo', 15);
            $table->boolean('activo');
            $table->dateTime('created_at', 0)->nullable();
            $table->dateTime('updated_at', 0)->nullable();
            $table->dateTime('deleted_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instancia_codigos');
    }
}
