<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientoInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientoInscripciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado');
            $table->string('descripcion');
            $table->dateTime('fechaCompromiso');
            $table->string('horaCompromiso');

            $table->integer('empleado_id')->unsigned()->nullable();
            $table->integer('inscripcion_id')->unsigned()->nullable();
            
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::drop('seguimientoInscripciones');
    }
}
