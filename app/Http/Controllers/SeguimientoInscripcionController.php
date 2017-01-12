<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SeguimientoInscripcionRepo;
use Salesfly\Salesfly\Managers\SeguimientoInscripcionManager;
 
class SeguimientoInscripcionController extends Controller {

    protected $seguimientoInscripcionRepo;

    public function __construct(SeguimientoInscripcionRepo $seguimientoInscripcionRepo)
    {
        $this->seguimientoInscripcionRepo = $seguimientoInscripcionRepo;
    }

    public function index()
    {
        return View('seguimientoInscripciones.index');
    }

    public function all()
    {
        $seguimientoInscripciones = $this->seguimientoInscripcionRepo->paginate(15);
        return response()->json($seguimientoInscripciones);
    }

    public function seguimientos($id)
    {
        $seguimientoInscripciones = $this->seguimientoInscripcionRepo->seguimientos($id);
        return response()->json($seguimientoInscripciones);
    }

    public function paginatep(){
        $seguimientoInscripciones = $this->seguimientoInscripcionRepo->paginate(15);
        return response()->json($seguimientoInscripciones);
    }


    public function form_create()
    {
        return View('seguimientoInscripciones.form_create');
    }

    public function form_edit()
    {
        return View('seguimientoInscripciones.form_edit');
    }

    public function create(Request $request)
    {
        $seguimientoInscripciones = $this->seguimientoInscripcionRepo->getModel();
        $manager = new SeguimientoInscripcionManager($seguimientoInscripciones,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$seguimientoInscripciones->nombre]);
    }

    public function find($id)
    {
        $seguimientoInscripcion = $this->seguimientoInscripcionRepo->find($id);
        return response()->json($seguimientoInscripcion);
    }

    public function edit(Request $request)
    {
        $seguimientoInscripcion = $this->seguimientoInscripcionRepo->find($request->id);

        $manager = new SeguimientoInscripcionManager($seguimientoInscripcion,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$seguimientoInscripcion->nombre]);
    }

    public function destroy(Request $request)
    {
        $seguimientoInscripcion= $this->seguimientoInscripcionRepo->find($request->id);
        $seguimientoInscripcion->delete();
        return response()->json(['estado'=>true, 'nombre'=>$seguimientoInscripcion->nombre]);
    }

    public function search($q)
    {
        $seguimientoInscripciones = $this->seguimientoInscripcionRepo->search($q);

        return response()->json($seguimientoInscripciones);
    }
}