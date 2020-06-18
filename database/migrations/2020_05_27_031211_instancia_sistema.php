<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InstanciaSistema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instancia_sistema', function (Blueprint $table) {
            $table->id('idInstanciaSistema');
            $table->foreignId('idCliente')->references('idCliente')->on('cliente');
            $table->string('nombre', 50);
            $table->string('descripcion', 100);
            $table->string('subDominio', 100);
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
        Schema::dropIfExists('instancia_sistema');
    }
}
