<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('dni')->unique();
            $table->dateTime('fechaNac');
            $table->string('sexo');
            $table->string('curriculo');
            $table->string('gradoAcademico');
            $table->string('email');
            $table->string('telefono');
            $table->string('estado');
            $table->integer('ubigeo_id')->unsigned()->nullable();
            $table->integer('profesion_id')->unsigned()->nullable();
            $table->integer('pais_id')->unsigned()->nullable();
            
            $table->foreign('ubigeo_id')->references('id')->on('ubigeos');
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
        Schema::drop('docentes');
    }
}
