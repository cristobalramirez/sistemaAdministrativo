<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Pago;

class PagoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Pago;
    }

    public function search($q)
    {
        $pagos =Pago::leftjoin('cuentaBancarias','pagos.cuentaBancaria_id','=','cuentaBancarias.id')
                    ->leftjoin('bancos','cuentaBancarias.banco_id','=','bancos.id')
                    ->select('pagos.*','cuentaBancarias.numeroCuenta as cuenta','bancos.nombre as banco')
                    ->where('inscripcion_id','=', $q)
                    ->get();
        return $pagos;
    }
} 