<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EdicionRepo;
use Salesfly\Salesfly\Managers\EdicionManager;

use Salesfly\Salesfly\Managers\DetalleDocenteEdicionManager;
use Salesfly\Salesfly\Repositories\DetalleDocenteEdicionRepo;
class EdicionesController extends Controller {

    protected $edicionRepo;

    public function __construct(EdicionRepo $edicionRepo)
    {
        $this->edicionRepo = $edicionRepo; 
    }

    public function index()
    {
        return View('ediciones.index');
    }

    public function all()
    {
        $ediciones = $this->edicionRepo->paginaterepo(15);
        return response()->json($ediciones);
    }

    public function paginatep(){
        $ediciones = $this->edicionRepo->paginaterepo(15);
        return response()->json($ediciones);
    }


    public function form_create()
    {
        return View('ediciones.form_create');
    }

    public function form_edit()
    {
        return View('ediciones.form_edit');
    }

    public function form_inscribir()
    {
        return View('ediciones.form_inscribir');
    }

    public function create(Request $request)
    {
        \DB::beginTransaction();
        $detDocenteEdicion = $request->detDocenteEdicion;

        $ediciones = $this->edicionRepo->getModel();
        $manager = new EdicionManager($ediciones,$request->all());
        $manager->save();
        $temporal=$ediciones->id;

        $detDocenteEdicionRepo;
        foreach($detDocenteEdicion as $objeto){
            $objeto['edicion_id'] = $temporal;
            $detDocenteEdicionRepo = new DetalleDocenteEdicionRepo;
            $insertar=new DetalleDocenteEdicionManager($detDocenteEdicionRepo->getModel(),$objeto);
            $insertar->save();
          
            $detDocenteEdicionRepo = null;
        }
        \DB::commit();
        return response()->json(['estado'=>true, 'nombre'=>$ediciones->nombre]);
    }

    public function find($id)
    {
        $edicion = $this->edicionRepo->find($id);
        return response()->json($edicion);
    }

    public function edit(Request $request)
    {
        \DB::beginTransaction();
        $edicion = $this->edicionRepo->find($request->id);

        if($request->brochure!=$edicion->brochure){
            if ($edicion->brochure!="") {
                $rest = substr(__DIR__, 0, -21);
                unlink($rest."/public".$edicion->brochure);
            }            
        }
        if($request->resolucion!=$edicion->resolucion){
            if ($edicion->resolucion!="") {
                $rest = substr(__DIR__, 0, -21);
                unlink($rest."/public".$edicion->resolucion);
            }            
        }
        if($request->proyecto!=$edicion->proyecto){
            if ($edicion->proyecto!="") {
                $rest = substr(__DIR__, 0, -21);
                unlink($rest."/public".$edicion->proyecto);
            }            
        }
        if($request->publicidadFace!=$edicion->publicidadFace){
            if ($edicion->publicidadFace!="") {
                $rest = substr(__DIR__, 0, -21);
                unlink($rest."/public".$edicion->publicidadFace);
            }            
        }
        if($request->publicidadImprimir!=$edicion->publicidadImprimir){
            if ($edicion->publicidadImprimir!="") {
                $rest = substr(__DIR__, 0, -21);
                unlink($rest."/public".$edicion->publicidadImprimir);
            }            
        }
        if($request->baner!=$edicion->baner){
            if ($edicion->baner!="") {
                $rest = substr(__DIR__, 0, -21);
                unlink($rest."/public".$edicion->baner);
            }            
        }

        $manager = new EdicionManager($edicion,$request->all());
        $manager->save();
        \DB::commit();
        return response()->json(['estado'=>true, 'nombre'=>$edicion->nombre]);
    }

    public function destroy(Request $request)
    {
        \DB::beginTransaction();
        $edicion= $this->edicionRepo->find($request->id);
        if($edicion->brochure!=""){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$edicion->brochure);
        }
        if($edicion->resolucion!=""){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$edicion->resolucion);
        }
        if($edicion->proyecto!=""){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$edicion->proyecto);
        }
        if($edicion->publicidadFace!=""){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$edicion->publicidadFace);
        }
        if($edicion->publicidadImprimir!=""){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$edicion->publicidadImprimir);
        }
        if($edicion->baner!=""){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$edicion->baner);
        }
        $edicion->delete();
        \DB::commit();
        return response()->json(['estado'=>true, 'nombre'=>$edicion->nombre]);
    }

    public function search($q)
    {
        $ediciones = $this->edicionRepo->search($q);

        return response()->json($ediciones);
    }
    public function uploadFile(){

        $file = $_FILES["file"]["name"];

        $time=time();
        if(!is_dir("files/"))
            mkdir("files/", 0777);
        if($file && move_uploaded_file($_FILES["file"]["tmp_name"], "files/".$time."_".$file))
        {
             
        }
        return "/files/".$time."_".$file;      
    }
    public function buscarEdicion($q)
    {
        $ediciones = $this->edicionRepo->buscarEdicion($q);
        return response()->json($ediciones);
    }
    
    public function disablePersona($id){
        \DB::beginTransaction();
        $edicion = $this->edicionRepo->find($id);
        $estado = $edicion->estado;
            if ($estado == 'Activo') {
                $edicion->estado = 'Inactivo';
            } else {
                $edicion->estado = 'Activo';
            }
        
        $edicion->save();
        //die();
        \DB::commit();
        return response()->json(['estado'=>true]);
    }
    public function edicionesCurso  ($curso)
    {
        $edicion = $this->edicionRepo->edicionesCurso($curso);
        return response()->json($edicion);
    }
    
}