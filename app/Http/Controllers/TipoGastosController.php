<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\TipoGastoRepo;
use Salesfly\Salesfly\Managers\TipoGastoManager;
 
class TipoGastosController extends Controller {

    protected $categoriaRepo;

    public function __construct(TipoGastoRepo $categoriaRepo)
    {
        $this->categoriaRepo = $categoriaRepo;
    }

    public function index()
    {
        return View('tipogastos.index');
    }

    public function all()
    {
        $tipogastos = $this->categoriaRepo->paginate(15);
        return response()->json($tipogastos);
    }

    public function paginatep(){
        $tipogastos = $this->categoriaRepo->paginate(15);
        return response()->json($tipogastos);
    }


    public function form_create()
    {
        return View('tipogastos.form_create');
    }

    public function form_edit()
    {
        return View('tipogastos.form_edit');
    }

    public function create(Request $request)
    {
        $tipogastos = $this->categoriaRepo->getModel();
        $manager = new TipoGastoManager($tipogastos,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$tipogastos->nombre]);
    }

    public function find($id)
    {
        $tipo_gasto = $this->categoriaRepo->find($id);
        return response()->json($tipo_gasto);
    }

    public function edit(Request $request)
    {
        $tipo_gasto = $this->categoriaRepo->find($request->id);

        $manager = new TipoGastoManager($tipo_gasto,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$tipo_gasto->nombre]);
    }

    public function destroy(Request $request)
    {
        $tipo_gasto= $this->categoriaRepo->find($request->id);
        $tipo_gasto->delete();
        return response()->json(['estado'=>true, 'nombre'=>$tipo_gasto->nombre]);
    }

    public function search($q)
    {
        $tipogastos = $this->categoriaRepo->search($q);

        return response()->json($tipogastos);
    }
}