<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EnvioRepo;
use Salesfly\Salesfly\Managers\EnvioManager;
 
class EnviosController extends Controller {

    protected $envioRepo;

    public function __construct(EnvioRepo $envioRepo)
    {
        $this->envioRepo = $envioRepo;
    }

    public function index()
    {
        return View('envios.index');
    }

    public function all()
    {
        $envios = $this->envioRepo->paginate(15);
        return response()->json($envios);
    }

    public function paginatep(){
        $envios = $this->envioRepo->paginate(15);
        return response()->json($envios);
    }


    public function form_create()
    {
        return View('envios.form_create');
    }

    public function form_edit()
    {
        return View('envios.form_edit');
    }

    public function create(Request $request)
    {
        $envios = $this->envioRepo->getModel();
        $manager = new EnvioManager($envios,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$envios->nombre]);
    }

    public function find($id)
    {
        $envio = $this->envioRepo->find($id);
        return response()->json($envio);
    }

    public function edit(Request $request)
    {
        $envio = $this->envioRepo->find($request->id);

        $manager = new EnvioManager($envio,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$envio->nombre]);
    }

    public function destroy(Request $request)
    {
        $envio= $this->envioRepo->find($request->id);
        $envio->delete();
        return response()->json(['estado'=>true, 'nombre'=>$envio->nombre]);
    }

    public function search($q)
    {
        $envios = $this->envioRepo->search($q);

        return response()->json($envios);
    }
    public function envioInscripcion($id)
    {
        $envio = $this->envioRepo->envioInscripcion($id);
        return response()->json($envio);
    }
}