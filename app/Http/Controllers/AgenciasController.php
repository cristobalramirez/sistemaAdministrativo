<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\AgenciaRepo;
use Salesfly\Salesfly\Managers\AgenciaManager;
 
class AgenciasController extends Controller {

    protected $agenciaRepo;

    public function __construct(AgenciaRepo $agenciaRepo)
    {
        $this->agenciaRepo = $agenciaRepo;
    }

    public function index()
    {
        return View('agencias.index');
    }

    public function all()
    {
        $agencias = $this->agenciaRepo->paginate(15);
        return response()->json($agencias);
    }

    public function paginatep(){
        $agencias = $this->agenciaRepo->paginate(15);
        return response()->json($agencias);
    }


    public function form_create()
    {
        return View('agencias.form_create');
    }

    public function form_edit()
    {
        return View('agencias.form_edit');
    }

    public function create(Request $request)
    {
        $agencias = $this->agenciaRepo->getModel();
        $manager = new AgenciaManager($agencias,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$agencias->nombre]);
    }

    public function find($id)
    {
        $agencia = $this->agenciaRepo->find($id);
        return response()->json($agencia);
    }

    public function edit(Request $request)
    {
        $agencia = $this->agenciaRepo->find($request->id);

        $manager = new AgenciaManager($agencia,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$agencia->nombre]);
    }

    public function destroy(Request $request)
    {
        $agencia= $this->agenciaRepo->find($request->id);
        $agencia->delete();
        return response()->json(['estado'=>true, 'nombre'=>$agencia->nombre]);
    }

    public function search($q)
    {
        $agencias = $this->agenciaRepo->search($q);

        return response()->json($agencias);
    }
    public function cargarAgencias()
    {
        $agencias = $this->agenciaRepo->cargarAgencias();
        return response()->json($agencias); 
    }
}