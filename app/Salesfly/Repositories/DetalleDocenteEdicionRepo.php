<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetalleDocenteEdicion;

class DetalleDocenteEdicionRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new DetalleDocenteEdicion;
    }

  
} 