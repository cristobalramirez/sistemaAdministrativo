<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EmpleadoRepo;
use Salesfly\Salesfly\Managers\EmpleadoManager;
 
class EmpleadosController extends Controller {

    protected $empleadoRepo; 

    public function __construct(EmpleadoRepo $empleadoRepo)
    {
        $this->empleadoRepo = $empleadoRepo;
    }

    public function index()
    {
        return View('empleados.index');
    }

    public function all()
    {
        $empleados = $this->empleadoRepo->paginaterepo(15);
        return response()->json($empleados);
    }

    public function paginatep(){
        $empleados = $this->empleadoRepo->paginaterepo(15);
        return response()->json($empleados);
    }


    public function form_create()
    {
        return View('empleados.form_create');
    }

    public function form_edit()
    {
        return View('empleados.form_edit');
    }

    public function create(Request $request)
    {
        $empleados = $this->empleadoRepo->getModel();
        $manager = new EmpleadoManager($empleados,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$empleados->nombre]);
    }

    public function find($id)
    {
        $docente = $this->empleadoRepo->find($id);
        return response()->json($docente);
    }

    public function edit(Request $request)
    {
        $empleado = $this->empleadoRepo->find($request->id);

        $manager = new EmpleadoManager($empleado,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$empleado->nombre]);
    }

    public function destroy(Request $request)
    {
        $empleado= $this->empleadoRepo->find($request->id);
        $empleado->delete();
        return response()->json(['estado'=>true, 'nombre'=>$empleado->nombre]);
    }

    public function search($q)
    {
        $empleados = $this->empleadoRepo->search($q);

        return response()->json($empleados);
    }
    public function validarDni($text){
        $empleados = $this->empleadoRepo->validarDni($text);
        return response()->json($empleados);
    }

    public function disablePersona($id){
        \DB::beginTransaction();
        $persona = $this->empleadoRepo->find($id);
        $estado = $persona->estado;
            if ($estado == 'Activo') {
                $persona->estado = 'Inactivo';
            } else {
                $persona->estado = 'Activo';
            }
        
        $persona->save();
        //die();
        \DB::commit();
        return response()->json(['estado'=>true]);
    }
    public function buscarEmpleado($q)
    {
        $empleados = $this->empleadoRepo->buscarEmpleado($q);
        return response()->json($empleados);
    } 
    public function cargarEmpleados()
    {
        $promociones = $this->empleadoRepo->cargarEmpleados();
        return response()->json($promociones); 
    }
}