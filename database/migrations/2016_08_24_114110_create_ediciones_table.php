<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ediciones', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fechaInicio');
            $table->dateTime('fechaFin');
            $table->integer('costoCurso');
            $table->string('modalidad');
            $table->string('brochure');
            $table->string('resolucion');
            $table->string('proyecto');
            $table->string('publicidadFace');
            $table->string('publicidadImprimir');
            $table->string('baner');
            $table->string('estado');
            $table->string('descripcionEdicion');
            
            $table->integer('curso_id')->unsigned()->nullable();
            $table->integer('acreditadora_id')->unsigned();
            
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('acreditadora_id')->references('id')->on('acreditadoras');
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
        Schema::drop('ediciones');
    }
}
