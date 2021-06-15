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

        $uuid = $request->get('uuid');
        $establecimiento = Establecimiento::where('uuid', $uuid)->first();
        $this->authorize('delete', $establecimiento);

    	$imagen = $request->get('imagen');

    	if(File::exists('storage/' . $imagen)) {
            //elimina imagen del servidor
    		File::delete('storage/' . $imagen);

            //elimina imagen de la BD
            Imagen::where('ruta_imagen', $imagen)->delete();
    	}

    	$respuesta = [
    		'mensaje' => 'Imagen Eliminada',
    		'imagen' => $imagen
    	];

    	return response()->json($request);
    }
}
