<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\CuentaBancariaRepo;
use Salesfly\Salesfly\Managers\CuentaBancariaManager;
 
class CuentaBancariasController extends Controller {

    protected $cuentaBancariaRepo;

    public function __construct(CuentaBancariaRepo $cuentaBancariaRepo)
    {
        $this->cuentaBancariaRepo = $cuentaBancariaRepo;
    }

    public function index()
    {
        return View('cuentaBancarias.index');
    }

    public function all()
    {
        $cuentaBancarias = $this->cuentaBancariaRepo->paginaterepo(15);
        return response()->json($cuentaBancarias);
    }
 
    public function paginatep(){
        $cuentaBancarias = $this->cuentaBancariaRepo->paginaterepo(15);
        return response()->json($cuentaBancarias);
    }


    public function form_create()
    {
        return View('cuentaBancarias.form_create');
    }

    public function form_edit()
    {
        return View('cuentaBancarias.form_edit');
    }

    public function create(Request $request)
    {
        $cuentaBancarias = $this->cuentaBancariaRepo->getModel();
        $manager = new CuentaBancariaManager($cuentaBancarias,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$cuentaBancarias->nombre]);
    }

    public function find($id)
    {
        $station = $this->cuentaBancariaRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->cuentaBancariaRepo->find($request->id);

        $manager = new CuentaBancariaManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->cuentaBancariaRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $cuentaBancarias = $this->cuentaBancariaRepo->search($q);

        return response()->json($cuentaBancarias);
    }
    public function todas()
    {
        $cuentaBancarias = $this->cuentaBancariaRepo->all();
        return response()->json($cuentaBancarias);
    }
}