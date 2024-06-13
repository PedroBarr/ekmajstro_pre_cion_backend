<?php

namespace App\Http\Controllers\core;

use Illuminate\Support\Facades\Storage;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;

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

        $archivo = $request->file('archivo');
        $archivo_nombre = $archivo->getClientOriginalName();
        $archivo_contenido = file_get_contents($archivo);
        $archivo_extension = $archivo->getClientOriginalExtension();
        $archivo_mimetismo = $archivo->getMimeType();
        $archivo_medida = $archivo->getSize();
        // $archivo_ruta = 'static/';
        $archivo_ruta = 'archivos/';

        Storage::put($archivo_ruta . $archivo_nombre, $archivo_contenido);

        $archivo_uri = Storage::url($archivo_ruta . $archivo_nombre);

        if (str_contains($archivo_uri, "localhost")) {
          $archivo_uri = str_replace(
            "localhost",
            $request->getHttpHost(),
            $archivo_uri,
          );
        }

        $archivo_entidad = Archivo::create([
          "arch_uri" => $archivo_uri,
          "arch_mime" => $archivo_mimetismo,
          "arch_extension" => $archivo_extension,
          "arch_size" => $archivo_medida,
          "arch_name" => $archivo_nombre,
        ]);

        $respuesta = Response::make(Response::json([
            "nombre" => $archivo_nombre,
            "extension" => $archivo_extension,
            "mimetismo" => $archivo_mimetismo,
            "medida" => $archivo_medida,
            "uri" => $archivo_uri,
            "id" => $archivo_entidad->arch_id,
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
      return Archivo::findOrFail($id);
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
