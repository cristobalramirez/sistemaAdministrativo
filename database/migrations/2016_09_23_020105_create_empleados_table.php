<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('dni')->unique();
            $table->dateTime('fechaNac');
            $table->dateTime('fecIngreso');
            $table->dateTime('fecBaja');
            $table->string('sexo');
            $table->string('email');
            $table->string('telefono');
            $table->string('estado');
            $table->string('direccion');
            $table->integer('ubigeo_id')->unsigned()->nullable();
            
            $table->foreign('ubigeo_id')->references('id')->on('ubigeos');
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
        Schema::drop('empleados');
    }
}
