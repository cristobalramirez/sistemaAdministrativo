<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Empleado;

class EmpleadoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Empleado;
    }

    public function search($q)
    {
        $empleados =Empleado::where('nombres','like', $q.'%')
                    ->orwhere('apellidos','like', $q.'%')
                    ->orwhere('dni','like', $q.'%')
                    ->orwhere('email','like', $q.'%')
                    ->orwhere('telefono','like', $q.'%')
                    ->paginate(15);
        return $empleados;
    }
    public function paginaterepo($c){
        $empleados = Empleado::leftjoin('ubigeos','empleados.ubigeo_id','=','ubigeos.id')
                    ->select('empleados.*','ubigeos.departamento as departamento')
                    ->paginate($c);
        return $empleados;
    }
    public function validarDni($text){
        $empleado =Empleado::where('dni','=', $text)
                    ->first();
        return $empleado;
    }
    public function buscarEmpleado($q){
      $empleado = Empleado::where('nombres','like',$q.'%')
                        ->orwhere('apellidos','like',$q.'%') 
                        ->orwhere('dni','like',$q.'%')                
                            ->get();
            return $empleado;
    } 
    public function cargarEmpleados(){
        $empleados = Empleado::get();
        return $empleados;
    }
} 