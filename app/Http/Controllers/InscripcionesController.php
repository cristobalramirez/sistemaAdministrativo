<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\InscripcionRepo;
use Salesfly\Salesfly\Managers\InscripcionManager;
use Salesfly\Salesfly\Repositories\PersonaRepo;
use Salesfly\Salesfly\Managers\PersonaManager;
 
class InscripcionesController extends Controller {

    protected $inscripcionRepo;

    public function __construct(InscripcionRepo $inscripcionRepo)
    {
        $this->inscripcionRepo = $inscripcionRepo;
    }

    public function index()
    {
        return View('inscripciones.index');
    }

    public function all()
    {
        $inscripciones = $this->inscripcionRepo->paginaterepo(15);
        return response()->json($inscripciones);
    }

    public function paginatep(){
        $inscripciones = $this->inscripcionRepo->paginaterepo(15);
        return response()->json($inscripciones);
    }


    public function form_create()
    {
        return View('inscripciones.form_create');
    }

    public function form_edit()
    {
        return View('inscripciones.form_edit');
    }

    public function create(Request $request)
    {
        $inscripciones = $this->inscripcionRepo->getModel();
        $manager = new InscripcionManager($inscripciones,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$inscripciones->nombre]);
    }
    public function createInscribir(Request $request)
    {
        \DB::beginTransaction();
        $persona = $request->persona;
        if($persona['id']==0){
            $personarepo;
            $personarepo = new PersonaRepo;
            $personaSave=$personarepo->getModel();
            
            $insertarpersona=new PersonaManager($personaSave,$persona);
            $insertarpersona->save();          
            $personaSave->save();
            $temporal=$personaSave->id;

            $request->merge(["persona_id"=>$temporal]);
        }else{
            $request->merge(["persona_id"=>$persona['id']]);
        }
        $inscripciones = $this->inscripcionRepo->getModel();
        $manager = new InscripcionManager($inscripciones,$request->all());
        $manager->save();
        $inscripciones->save();
        $temporal=$inscripciones->id;
        \DB::commit();
        return response()->json(['estado'=>true, 'nombre'=>$inscripciones->nombre]);
    }

    public function find($id)
    {
        $inscripcion = $this->inscripcionRepo->find($id);
        return response()->json($inscripcion);
    }

    public function edit(Request $request)
    {
        $inscripcion = $this->inscripcionRepo->find($request->id);

        $manager = new InscripcionManager($inscripcion,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$inscripcion->nombre]);
    }

    public function destroy(Request $request)
    {
        $inscripcion= $this->inscripcionRepo->find($request->id);
        $inscripcion->delete();
        return response()->json(['estado'=>true, 'nombre'=>$inscripcion->nombre]);
    }

    public function search($q)
    {
        $inscripciones = $this->inscripcionRepo->search($q);

        return response()->json($inscripciones);
    }
}