<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EdicionRepo;
use Salesfly\Salesfly\Managers\EdicionManager;
 
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

    public function create(Request $request)
    {
        $ediciones = $this->edicionRepo->getModel();
        $manager = new EdicionManager($ediciones,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$ediciones->nombre]);
    }

    public function find($id)
    {
        $edicion = $this->edicionRepo->find($id);
        return response()->json($edicion);
    }

    public function edit(Request $request)
    {
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
        if($request->proyecto!=$docente->proyecto){
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

        $manager = new EdicionManager($edicion,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$edicion->nombre]);
    }

    public function destroy(Request $request)
    {
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
        $edicion->delete();
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
  
    
}