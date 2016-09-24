<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fechaInscripcion');
            $table->integer('estado');
            $table->integer('montoCurso');
            $table->integer('montoPagado');
            $table->integer('saldo');
            $table->integer('medioPublicitario_id')->unsigned()->nullable();
            $table->integer('persona_id')->unsigned();
            $table->integer('edicion_id')->unsigned();

            $table->string('nombres');
            $table->string('apellidos');
            $table->string('dni');
            $table->string('email');
            $table->string('telefono');
            
            $table->foreign('medioPublicitario_id')->references('id')->on('medioPublicitarios');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('edicion_id')->references('id')->on('ediciones');
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
        Schema::drop('inscripciones');
    }
}
