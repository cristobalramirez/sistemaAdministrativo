<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\MedioPublicitarioRepo;
use Salesfly\Salesfly\Managers\MedioPublicitarioManager;
 
class MedioPublicitariosController extends Controller {

    protected $medioPublicitarioRepo;

    public function __construct(MedioPublicitarioRepo $medioPublicitarioRepo)
    {
        $this->medioPublicitarioRepo = $medioPublicitarioRepo;
    }

    public function index()
    {
        return View('medioPublicitarios.index');
    }

    public function all()
    {
        $medioPublicitarios = $this->medioPublicitarioRepo->paginate(15);
        return response()->json($medioPublicitarios);
    }

    public function paginatep(){
        $medioPublicitarios = $this->medioPublicitarioRepo->paginate(15);
        return response()->json($medioPublicitarios);
    }


    public function form_create()
    {
        return View('medioPublicitarios.form_create');
    }

    public function form_edit()
    {
        return View('medioPublicitarios.form_edit');
    }

    public function create(Request $request)
    {
        $medioPublicitarios = $this->medioPublicitarioRepo->getModel();
        $manager = new MedioPublicitarioManager($medioPublicitarios,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$medioPublicitarios->nombre]);
    }

    public function find($id)
    {
        $station = $this->medioPublicitarioRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->medioPublicitarioRepo->find($request->id);

        $manager = new MedioPublicitarioManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->medioPublicitarioRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $medioPublicitarios = $this->medioPublicitarioRepo->search($q);

        return response()->json($medioPublicitarios);
    }
    public function CargarMedioPublicitarios()
    {
        $medioPublicitarios = $this->medioPublicitarioRepo->CargarMedioPublicitarios();
        return response()->json($medioPublicitarios); 
    }
}