<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PaisRepo;
use Salesfly\Salesfly\Managers\PaisManager;
 
class PaisesController extends Controller {

    protected $paisRepo;

    public function __construct(PaisRepo $paisRepo)
    {
        $this->paisRepo = $paisRepo;
    }

    public function index()
    {
        return View('paises.index');
    }

    public function all()
    {
        $paises = $this->paisRepo->paginate(15);
        return response()->json($paises);
    }

    public function paginatep(){
        $paises = $this->paisRepo->paginate(15);
        return response()->json($paises);
    }


    public function form_create()
    {
        return View('paises.form_create');
    }

    public function form_edit()
    {
        return View('paises.form_edit');
    }

    public function create(Request $request)
    {
        $paises = $this->paisRepo->getModel();
        $manager = new PaisManager($paises,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$paises->nombre]);
    }

    public function find($id)
    {
        $pais = $this->paisRepo->find($id);
        return response()->json($pais);
    }

    public function edit(Request $request)
    {
        $pais = $this->paisRepo->find($request->id);

        $manager = new PaisManager($pais,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$pais->nombre]);
    }

    public function destroy(Request $request)
    {
        $pais= $this->paisRepo->find($request->id);
        $pais->delete();
        return response()->json(['estado'=>true, 'nombre'=>$pais->nombre]);
    }

    public function search($q)
    {
        $paises = $this->paisRepo->search($q);

        return response()->json($paises);
    }
    public function CargarPaises()
    {
        $paises = $this->paisRepo->CargarPaises();
        return response()->json($paises); 
    }
}