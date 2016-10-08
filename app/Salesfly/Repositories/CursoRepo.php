<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Curso;

class CursoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Curso;
    }
    public function search($q)
    {
        $cuentaBancarias = Curso::with('categoria')->paginate(15);
        $cuentaBancarias = Curso::with(array('categoria'=>function($query){
            $query->select('id','nombre');
        }))->where('descripcion','like', $q.'%')
        ->paginate(15);
        return $cuentaBancarias;
    }
    public function paginaterepo($c){
        $cuentaBancarias = Curso::with('categoria')->paginate($c);
        $cuentaBancarias = Curso::with(array('categoria'=>function($query){
            $query->select('id','nombreCategoria');
        }))->paginate($c);
        return $cuentaBancarias;
    }
    public function all()
    {
        $curos =Curso::get();
        return $curos;
    }
}  