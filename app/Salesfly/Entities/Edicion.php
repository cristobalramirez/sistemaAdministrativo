<?php
namespace Salesfly\Salesfly\Entities;

class Edicion extends \Eloquent {

	protected $table = 'ediciones';
    
    protected $fillable = ['fechaInicio',
    						'fechaFin',
    						'costoCurso',
    						'modalidad',
    						'brochure',
    						'resolucion',
    						'proyecto',
    						'publicidadFace',
    						'publicidadImprimir',
    						'curso_id',
    						'acreditadora_id'];

    
    public function acreditadora()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Acreditadora');
    }
    public function curso()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Curso');
    }
}