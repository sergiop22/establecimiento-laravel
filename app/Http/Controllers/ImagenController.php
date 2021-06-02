<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\imagen;

class ImagenController extends Controller
{
    public function store(Request $request) {

    	//leer la imagen y almacenar en public
    	$ruta_imagen = $request->file('file')->store('establecimientos', 'public');

    	//resize a imagen
    	$imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 450);
    	$imagen->save();

    	//almacenar con modelo
    	$imagenDB = new Imagen;
    	$imagenDB->id_establecimiento = $request('uuid');
    	$imagenDB->ruta_imagen = $ruta_imagen;

    	$imagenDB->save();

    	//respuesta
    	$respuesta = [
    		'archivo' =>$ruta_imagen
    	];

    	return response()->json($respuesta);
    }

    public function destroy(Request $request) {

    	$imagen = $request->get('imagen');

    	if(File::exists('storage/' . $imagen)) {
    		File::delete('storage/' . $imagen);
    	}

    	$respuesta = [
    		'mensaje' => 'Imagen Eliminada'
    		'imagen' => $imagen
    	];

    	Imagen::where('ruta_imagen', '=', $imagen)->delete();

    	return response()->json($request);
    }
}
