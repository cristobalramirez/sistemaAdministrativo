<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fechaCompromiso'); 
            $table->string('descripcion');
            $table->string('direccionAgencia')->nullable();
            $table->dateTime('fechaEnvio')->nullable(); 
            $table->string('numeroFactura')->nullable();
            $table->string('clave')->nullable();
            $table->integer('monto')->nullable();

            $table->integer('agencia_id')->unsigned()->nullable();
            $table->integer('inscripcion_id')->unsigned()->nullable();
            $table->integer('ubigeo_id')->unsigned()->nullable();
            
            $table->foreign('agencia_id')->references('id')->on('agencias')->nullable();
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones')->nullable();
            $table->foreign('ubigeo_id')->references('id')->on('ubigeos')->nullable();
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
        Schema::drop('envios');
    }
}
