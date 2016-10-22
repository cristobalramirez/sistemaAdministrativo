<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PagoRepo;
use Salesfly\Salesfly\Managers\PagoManager;
 
class PagosController extends Controller {

    protected $pagoRepo;

    public function __construct(PagoRepo $pagoRepo)
    {
        $this->pagoRepo = $pagoRepo;
    }

    
    public function search($q)
    {
        $pagos = $this->pagoRepo->search($q);

        return response()->json($pagos);
    }
    
}