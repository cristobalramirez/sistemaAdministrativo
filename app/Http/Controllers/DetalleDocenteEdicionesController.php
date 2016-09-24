<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetalleDocenteEdicionRepo;
use Salesfly\Salesfly\Managers\DetalleDocenteEdicionManager;
 
class DetalleDocenteEdicionesController extends Controller {

    protected $detalleDocenteEdicionRepo;

    public function __construct(DetalleDocenteEdicionRepo $detalleDocenteEdicionRepo)
    {
        $this->detalleDocenteEdicionRepo = $detalleDocenteEdicionRepo;
    }

    public function create(Request $request)
    {
        $detalleDocenteEdiciones = $this->detalleDocenteEdicionRepo->getModel();
        $manager = new DetalleDocenteEdicionManager($detalleDocenteEdiciones,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$detalleDocenteEdiciones->nombre]);
    }

    public function edit(Request $request)
    {
        $station = $this->detalleDocenteEdicionRepo->find($request->id);

        $manager = new DetalleDocenteEdicionManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->detalleDocenteEdicionRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $detalleDocenteEdiciones = $this->detalleDocenteEdicionRepo->search($q);

        return response()->json($detalleDocenteEdiciones);
    }

}