<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\CategoriaRepo;
use Salesfly\Salesfly\Managers\CategoriaManager;
 
class CategoriasController extends Controller {

    protected $categoriaRepo;

    public function __construct(CategoriaRepo $categoriaRepo)
    {
        $this->categoriaRepo = $categoriaRepo;
    }

    public function index()
    {
        return View('categorias.index');
    }

    public function all()
    {
        $categorias = $this->categoriaRepo->paginate(15);
        return response()->json($categorias);
    }

    public function paginatep(){
        $categorias = $this->categoriaRepo->paginate(15);
        return response()->json($categorias);
    }


    public function form_create()
    {
        return View('categorias.form_create');
    }

    public function form_edit()
    {
        return View('categorias.form_edit');
    }

    public function create(Request $request)
    {
        $categorias = $this->categoriaRepo->getModel();
        $manager = new CategoriaManager($categorias,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$categorias->nombre]);
    }

    public function find($id)
    {
        $categoria = $this->categoriaRepo->find($id);
        return response()->json($categoria);
    }

    public function edit(Request $request)
    {
        $categoria = $this->categoriaRepo->find($request->id);

        $manager = new CategoriaManager($categoria,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$categoria->nombre]);
    }

    public function destroy(Request $request)
    {
        $categoria= $this->categoriaRepo->find($request->id);
        $categoria->delete();
        return response()->json(['estado'=>true, 'nombre'=>$categoria->nombre]);
    }

    public function search($q)
    {
        $categorias = $this->categoriaRepo->search($q);

        return response()->json($categorias);
    }
    public function cargarCategorias()
    {
        $categorias = $this->categoriaRepo->cargarCategorias();
        return response()->json($categorias); 
    }
}