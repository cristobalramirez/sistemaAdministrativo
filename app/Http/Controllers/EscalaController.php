<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EscalaRepo;
use Salesfly\Salesfly\Managers\EscalaManager;
 
class EscalaController extends Controller {

    protected $escalaRepo;

    public function __construct(EscalaRepo $escalaRepo)
    {
        $this->escalaRepo = $escalaRepo;
    }

    public function index()
    {
        return View('escalas.index');
    }

    public function all()
    {
        $escalas = $this->escalaRepo->paginate(15);
        return response()->json($escalas);
    }

    public function paginatep(){
        $escalas = $this->escalaRepo->paginate(15);
        return response()->json($escalas);
    }


    public function form_create()
    {
        return View('escalas.form_create');
    }

    public function form_edit()
    {
        return View('escalas.form_edit');
    }

    public function create(Request $request)
    {
        $escalas = $this->escalaRepo->getModel();
        $manager = new EscalaManager($escalas,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$escalas->nombre]);
    }

    public function find($id)
    {
        $escala = $this->escalaRepo->find($id);
        return response()->json($escala);
    }

    public function edit(Request $request)
    {
        $escala = $this->escalaRepo->find($request->id);

        $manager = new EscalaManager($escala,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$escala->nombre]);
    }

    public function destroy(Request $request)
    {
        $escala= $this->escalaRepo->find($request->id);
        $escala->delete();
        return response()->json(['estado'=>true, 'nombre'=>$escala->nombre]);
    }

    public function search($q)
    {
        $escalas = $this->escalaRepo->search($q);

        return response()->json($escalas);
    }
    public function CargarEscala()
    {
        $escalas = $this->escalaRepo->CargarEscala();
        return response()->json($escalas); 
    } 
}