<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\TipoComprobanteRepo;
use Salesfly\Salesfly\Managers\TipoComprobanteManager;
 
class TipoComprobanteController extends Controller {

    protected $tipoComprobanteRepo;

    public function __construct(TipoComprobanteRepo $tipoComprobanteRepo)
    {
        $this->tipoComprobanteRepo = $tipoComprobanteRepo;
    }

    public function index()
    {
        return View('tipocomprobantes.index');
    }

    public function all()
    {
        $tipocomprobantes = $this->tipoComprobanteRepo->paginate(15);
        return response()->json($tipocomprobantes);
    }

    public function paginatep(){
        $tipocomprobantes = $this->tipoComprobanteRepo->paginate(15);
        return response()->json($tipocomprobantes);
    }


    public function form_create()
    {
        return View('tipocomprobantes.form_create');
    }

    public function form_edit()
    {
        return View('tipocomprobantes.form_edit');
    }

    public function create(Request $request)
    {
        $tipocomprobantes = $this->tipoComprobanteRepo->getModel();
        $manager = new TipoComprobanteManager($tipocomprobantes,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$tipocomprobantes->nombre]);
    }

    public function find($id)
    {
        $tipocomprobante = $this->tipoComprobanteRepo->find($id);
        return response()->json($tipocomprobante);
    }

    public function edit(Request $request)
    {
        $tipocomprobante = $this->tipoComprobanteRepo->find($request->id);

        $manager = new TipoComprobanteManager($tipocomprobante,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$tipocomprobante->nombre]);
    }

    public function destroy(Request $request)
    {
        $tipocomprobante= $this->tipoComprobanteRepo->find($request->id);
        $tipocomprobante->delete();
        return response()->json(['estado'=>true, 'nombre'=>$tipocomprobante->nombre]);
    }

    public function search($q)
    {
        $tipocomprobantes = $this->tipoComprobanteRepo->search($q);

        return response()->json($tipocomprobantes);
    }
}