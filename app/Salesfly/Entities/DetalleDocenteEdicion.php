<?php
namespace Salesfly\Salesfly\Entities;

class DetalleDocenteEdicion extends \Eloquent {

	protected $table = 'detalleDocenteEdicion';
    
    protected $fillable = ['docente_id','edicion_id'];

}