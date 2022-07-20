<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        // intervention image
        $nombreImagen = Str::uuid() .".". $imagen->extension(); // nombre único para la imagen
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000); // efecto de intervention image
        // guardar la imagen
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
