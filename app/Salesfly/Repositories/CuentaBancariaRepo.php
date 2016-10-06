<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\CuentaBancaria;

class CuentaBancariaRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new CuentaBancaria;
    }

    public function search($q)
    {
        $cuentaBancarias = CuentaBancaria::with('banco')->paginate(15);
        $cuentaBancarias = CuentaBancaria::with(array('banco'=>function($query){
            $query->select('id','nombre');
        }))->where('numeroCuenta','like', $q.'%')
        ->paginate(15);
        return $cuentaBancarias;
    }
    public function paginaterepo($c){
        $cuentaBancarias = CuentaBancaria::with('banco')->paginate($c);
        $cuentaBancarias = CuentaBancaria::with(array('banco'=>function($query){
            $query->select('id','nombre');
        }))->paginate($c);
        return $cuentaBancarias;
    }
} 