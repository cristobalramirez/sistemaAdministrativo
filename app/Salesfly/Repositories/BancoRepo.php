<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Banco;

class BancoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Banco;
    }

    public function search($q)
    {
        $bancos =Banco::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $bancos;
    }
    public function CargarBancos(){
        $bancos = Banco::orderBy('nombre', 'asc')
                    ->get();
        return $bancos;
    }
} 