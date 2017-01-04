<?php
namespace Salesfly\Salesfly\Entities;

class Curso extends \Eloquent {

	protected $table = 'cursos';
    
    protected $fillable = ['descripcion','categoria_id','abreviatura'];

    public function categoria()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Categoria');
    }
}