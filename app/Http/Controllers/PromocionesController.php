<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PromocionRepo;
use Salesfly\Salesfly\Managers\PromocionManager;
 
class PromocionesController extends Controller {

    protected $promocionRepo;

    public function __construct(PromocionRepo $promocionRepo)
    {
        $this->promocionRepo = $promocionRepo;
    }

    public function index()
    {
        return View('promociones.index');
    }

    public function all()
    {
        $promociones = $this->promocionRepo->paginate(15);
        return response()->json($promociones);
    }

    public function paginatep(){
        $promociones = $this->promocionRepo->paginate(15);
        return response()->json($promociones);
    }


    public function form_create()
    {
        return View('promociones.form_create');
    }

    public function form_edit()
    {
        return View('promociones.form_edit');
    }

    public function create(Request $request)
    {
        $promociones = $this->promocionRepo->getModel();
        $manager = new PromocionManager($promociones,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$promociones->nombre]);
    }

    public function find($id)
    {
        $promocion = $this->promocionRepo->find($id);
        return response()->json($promocion);
    }

    public function edit(Request $request)
    {
        $promocion = $this->promocionRepo->find($request->id);

        $manager = new PromocionManager($promocion,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$promocion->nombre]);
    }

    public function destroy(Request $request)
    {
        $promocion= $this->promocionRepo->find($request->id);
        $promocion->delete();
        return response()->json(['estado'=>true, 'nombre'=>$promocion->nombre]);
    }

    public function search($q)
    {
        $promociones = $this->promocionRepo->search($q);

        return response()->json($promociones);
    }
    public function cargarPromociones()
    {
        $promociones = $this->promocionRepo->cargarPromociones();
        return response()->json($promociones); 
    }
}