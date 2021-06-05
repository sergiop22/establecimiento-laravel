<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //leer rutas por slug, no por id
    public function getRouteKeyName()
    {
    	return 'slug';
    }

    //relacion 1:n para categoria y establecimientos
    public function establecimientos()
    {
    	return $this->hasMany(Establecimiento::class);
    }
}
