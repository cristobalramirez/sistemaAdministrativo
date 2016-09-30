<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PersonaRepo;
use Salesfly\Salesfly\Managers\PersonaManager;
 
class PersonasController extends Controller {

    protected $personaRepo; 

    public function __construct(PersonaRepo $personaRepo)
    {
        $this->personaRepo = $personaRepo;
    }

    public function index()
    {
        return View('personas.index');
    }

    public function all()
    {
        $personas = $this->personaRepo->paginaterepo(15);
        return response()->json($personas);
    }

    public function paginatep(){
        $personas = $this->personaRepo->paginaterepo(15);
        return response()->json($personas);
    }


    public function form_create()
    {
        return View('personas.form_create');
    }

    public function form_edit()
    {
        return View('personas.form_edit');
    }

    public function create(Request $request)
    {
        $personas = $this->personaRepo->getModel();
        $manager = new PersonaManager($personas,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$personas->nombre]);
    }

    public function find($id)
    {
        $station = $this->personaRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->personaRepo->find($request->id);

        $manager = new PersonaManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->personaRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $personas = $this->personaRepo->search($q);

        return response()->json($personas);
    }
    public function validarDni($text){
        $personas = $this->personaRepo->validarDni($text);
        return response()->json($personas);
    }

    public function disablePersona($id){
        \DB::beginTransaction();
        $persona = $this->personaRepo->find($id);
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
    public function buscarPersona($q)
    {
        $personas = $this->personaRepo->buscarPersona($q);
        return response()->json($personas);
    }
    public function buscarPersonaConDni($q)
    {
        $personas = $this->personaRepo->buscarPersonaConDni($q);
        return response()->json($personas);
    }
}