<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\BancoRepo;
use Salesfly\Salesfly\Managers\BancoManager;
 
class InscribirController extends Controller {

    protected $bancoRepo;

    public function __construct(BancoRepo $bancoRepo)
    {
        $this->bancoRepo = $bancoRepo;
        $this->middleware('guest');
        //$this->middleware('auth');
    }

    //public function __construct()
    //{
      //  $this->middleware('guest');
    //}

    public function index()
    {
        //return "Hola";
       return View('inscribir.index');
    }

    public function all()
    {
        $inscribir = $this->bancoRepo->paginate(15);
        return response()->json($inscribir);
    }

    public function paginatep(){
        $inscribir = $this->bancoRepo->paginate(15);
        return response()->json($inscribir);
    }


    public function form_inscribir()
    {
        return View('inscribir.form_inscribir');
    }

    public function form_edit()
    {
        return View('inscribir.form_edit');
    }

    public function create(Request $request)
    {
        $inscribir = $this->bancoRepo->getModel();
        $manager = new BancoManager($inscribir,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$inscribir->nombre]);
    }

    
    

    public function find($id)
    {
        $station = $this->bancoRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->bancoRepo->find($request->id);

        $manager = new BancoManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->bancoRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $inscribir = $this->bancoRepo->search($q);

        return response()->json($inscribir);
    }
}