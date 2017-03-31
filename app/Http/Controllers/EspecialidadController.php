<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EspecialidadRepo;
use Salesfly\Salesfly\Managers\EspecialidadManager;
 
class EspecialidadController extends Controller {

    protected $especialidadRepo;

    public function __construct(EspecialidadRepo $especialidadRepo)
    {
        $this->especialidadRepo = $especialidadRepo;
    }

    public function index()
    {
        return View('especialidades.index');
    }

    public function all()
    {
        $especialidades = $this->especialidadRepo->paginate(15);
        return response()->json($especialidades);
    }

    public function paginatep(){
        $especialidades = $this->especialidadRepo->paginate(15);
        return response()->json($especialidades);
    }


    public function form_create()
    {
        return View('especialidades.form_create');
    }

    public function form_edit()
    {
        return View('especialidades.form_edit');
    }

    public function create(Request $request)
    {
        $especialidades = $this->especialidadRepo->getModel();
        $manager = new EspecialidadManager($especialidades,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$especialidades->nombre]);
    }

    public function find($id)
    {
        $especialidad = $this->especialidadRepo->find($id);
        return response()->json($especialidad);
    }
 
    public function edit(Request $request)
    {
        $especialidad = $this->especialidadRepo->find($request->id);

        $manager = new EspecialidadManager($especialidad,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$especialidad->nombre]);
    }

    public function destroy(Request $request)
    {
        $especialidad= $this->especialidadRepo->find($request->id);
        $especialidad->delete();
        return response()->json(['estado'=>true, 'nombre'=>$especialidad->nombre]);
    }

    public function search($q)
    {
        $especialidades = $this->especialidadRepo->search($q);

        return response()->json($especialidades);
    }
    public function CargarEspecialidad()
    {
        $especialidades = $this->especialidadRepo->CargarEspecialidad();
        return response()->json($especialidades); 
    } 
}