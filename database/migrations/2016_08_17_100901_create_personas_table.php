<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('dni')->unique();
            $table->dateTime('fechaNac');
            $table->string('sexo');
            $table->string('institucionTrabajo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('email');
            $table->string('telefono');
            $table->string('estadoCivil');
            $table->string('descripcionProfesion');
            $table->string('estado');
            $table->integer('ubigeoTrabajo_id')->unsigned()->nullable();
            $table->integer('ubigeoDireccion_id')->unsigned()->nullable();
            $table->integer('profesion_id')->unsigned()->nullable();
            $table->integer('pais_id')->unsigned()->nullable();

            //-----------------------------
            $table->integer('escala_id')->unsigned()->nullable();
            $table->integer('especialidad_id')->unsigned()->nullable();

            $table->foreign('escala_id')->references('id')->on('escala');
            $table->foreign('especialidad_id')->references('id')->on('especialidad');
            //-----------------------------
            
            $table->foreign('ubigeoTrabajo_id')->references('id')->on('ubigeos');
            $table->foreign('ubigeoDireccion_id')->references('id')->on('ubigeos');
            $table->foreign('profesion_id')->references('id')->on('profesiones');
            $table->foreign('pais_id')->references('id')->on('paises');
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
        Schema::drop('personas');
    }
}
