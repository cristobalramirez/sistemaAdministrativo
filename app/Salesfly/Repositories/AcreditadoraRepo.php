<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Acreditadora;

class AcreditadoraRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Acreditadora;
    }

    public function search($q)
    {
        $Acreditadoras = Acreditadora::with('ubigeo')->paginate(15);
        $Acreditadoras = Acreditadora::with(array('ubigeo'=>function($query){
            $query->select('id','distrito','provincia','departamento');
        }))->where('nombre','like', $q.'%')
        ->paginate(15);
        return $Acreditadoras;
    }
    public function paginaterepo($c){
        $Acreditadoras = Acreditadora::with('ubigeo')->paginate($c);
        $Acreditadoras = Acreditadora::with(array('ubigeo'=>function($query){
            $query->select('id','distrito','provincia','departamento');
        }))->paginate($c);
        return $Acreditadoras;
    }
    public function all()
    {
        $Acreditadoras =Acreditadora::get();
        return $Acreditadoras;
    }
}  