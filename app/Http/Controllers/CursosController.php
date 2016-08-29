<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\CursoRepo;
use Salesfly\Salesfly\Managers\CursoManager;
 
class CursosController extends Controller {

    protected $cursoRepo;

    public function __construct(CursoRepo $cursoRepo)
    {
        $this->cursoRepo = $cursoRepo;
    }

    public function index()
    {
        return View('cursos.index');
    }

    public function all()
    {
        $cursos = $this->cursoRepo->paginate(15);
        return response()->json($cursos);
    }
    public function CargarProfeciones()
    {
        $cursos = $this->cursoRepo->CargarProfeciones();
        return response()->json($cursos); 
    }

    public function paginatep(){
        $cursos = $this->cursoRepo->paginate(15);
        return response()->json($cursos);
    }


    public function form_create()
    {
        return View('cursos.form_create');
    }

    public function form_edit()
    {
        return View('cursos.form_edit');
    }

    public function create(Request $request)
    {
        $cursos = $this->cursoRepo->getModel();
        $manager = new CursoManager($cursos,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$cursos->nombre]);
    }

    public function find($id)
    {
        $curso = $this->cursoRepo->find($id);
        return response()->json($curso);
    }

    public function edit(Request $request)
    {
        $curso = $this->cursoRepo->find($request->id);

        $manager = new CursoManager($curso,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$curso->nombre]);
    }

    public function destroy(Request $request)
    {
        $curso= $this->cursoRepo->find($request->id);
        $curso->delete();
        return response()->json(['estado'=>true, 'nombre'=>$curso->nombre]);
    }

    public function search($q)
    {
        $cursos = $this->cursoRepo->search($q);

        return response()->json($cursos);
    }
    public function todas()
    {
        $cursos = $this->cursoRepo->all();
        return response()->json($cursos);
    }
}