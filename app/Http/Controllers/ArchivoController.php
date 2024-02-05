<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Response;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $almacenamiento = 'local';

        $archivo = $request->file('archivo');
        $archivo_nombre = $archivo->getClientOriginalName();
        $archivo_contenido = file_get_contents($archivo);
        $archivo_extension = $archivo->getClientOriginalExtension();
        $archivo_mimetismo = $archivo->getMimeType();
        $archivo_medida = $archivo->getSize();
        $archivo_ruta = 'static/';

        Storage::disk($almacenamiento)
            ->put($archivo_ruta . $archivo_nombre, $archivo_contenido);

        $archivo_uri = Storage::disk($almacenamiento)
            ->url($archivo_ruta . $archivo_nombre);

        $respuesta = Response::make(Response::json([
            "nombre" => $archivo_nombre,
            "contenido" => $archivo_contenido,
            "extension" => $archivo_extension,
            "mimetismo" => $archivo_mimetismo,
            "medida" => $archivo_medida,
            "uri" => $archivo_uri
        ]), 200);
        $respuesta->header("Content-Type","application/json");
        return $respuesta;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
