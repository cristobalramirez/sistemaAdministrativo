<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\AcreditadoraRepo;
use Salesfly\Salesfly\Managers\AcreditadoraManager;
 
class AcreditadorasController extends Controller {

    protected $acreditadoraRepo;

    public function __construct(AcreditadoraRepo $acreditadoraRepo)
    {
        $this->acreditadoraRepo = $acreditadoraRepo;
    }

    public function index()
    {
        return View('acreditadoras.index');
    }

    public function all()
    {
        $acreditadoras = $this->acreditadoraRepo->paginaterepo();
        return response()->json($acreditadoras);
    }
    public function todas()
    {
        $acreditadoras = $this->acreditadoraRepo->all();
        return response()->json($acreditadoras);
    }

    public function paginatep(){
        $acreditadoras = $this->acreditadoraRepo->paginaterepo(15);
        return response()->json($acreditadoras);
    }


    public function form_create()
    {
        return View('acreditadoras.form_create');
    }

    public function form_edit()
    {
        return View('acreditadoras.form_edit');
    }

    public function create(Request $request)
    {
        $acreditadoras = $this->acreditadoraRepo->getModel();
        $manager = new AcreditadoraManager($acreditadoras,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$acreditadoras->nombre]);
    }

    public function find($id)
    {
        $station = $this->acreditadoraRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->acreditadoraRepo->find($request->id);

        $manager = new AcreditadoraManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->acreditadoraRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $acreditadoras = $this->acreditadoraRepo->search($q);

        return response()->json($acreditadoras);
    }
}