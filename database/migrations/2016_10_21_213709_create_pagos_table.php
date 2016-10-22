<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vaucher');
            $table->integer('monto');
            $table->dateTime('fechaPago');
            $table->integer('cuentaBancaria_id')->unsigned()->nullable();
            $table->integer('inscripcion_id')->unsigned()->nullable();
            
            $table->foreign('cuentaBancaria_id')->references('id')->on('cuentaBancarias');
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos');
    }
}
