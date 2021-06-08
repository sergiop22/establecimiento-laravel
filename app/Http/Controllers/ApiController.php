<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Establecimiento;

class ApiController extends Controller
{
    //metodo para obtener todos los establecimientos
    public function index()
    {
        $establecimientos = Establecimiento::all();

        return response()->json($establecimientos);
    }

    public function categorias() 
    {
    	$categorias = Categoria::all();
    	return response()->json($categorias);
    }

    //muestra los establecimientos de la categoria en especifico
    public function categoria(Categoria $categoria)
    {
    	$establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();

    	return response()->json($establecimientos);
    }

    //muestra un establecimiento en especifico
    public function show(Establecimiento $establecimiento)
    {
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();
        $establecimiento->imagenes = $imagenes;

        return response()->json($establecimiento);
    }
}
