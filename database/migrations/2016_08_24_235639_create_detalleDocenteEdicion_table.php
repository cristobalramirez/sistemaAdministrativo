<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleDocenteEdicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleDocenteEdicion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('docente_id')->unsigned()->nullable();
            $table->integer('edicion_id')->unsigned();
            
            $table->foreign('docente_id')->references('id')->on('docentes');
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
        Schema::drop('detalleDocenteEdicion');
    }
}
