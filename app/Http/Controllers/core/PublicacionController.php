<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Models\Publicacion;

use App\Http\Controllers\core\SeccionController;

use Response;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Publicacion::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contenido = $request->json($request->all());
        $publicaciones_base_url = 'assets/img/core/publicaciones/';

        $pblc_titulo = $contenido["titulo"];
        $pblc_img_portada_uri = $contenido["portada_uri"];
        $pblc_fecha_publicacion = date("Y-m-d");

        $publicacion = Publicacion::create([
          "pblc_titulo" => $pblc_titulo,
          "pblc_img_portada_uri" => asset(
            'assets/img/core/publicaciones/'.
            $pblc_img_portada_uri
          ),
          "pblc_fecha_publicacion" => $pblc_fecha_publicacion,
        ]);

        if (
          isset($contenido["secciones"]) &&
          count($contenido["secciones"]) > 0
        ) {
          $marcado = -1;
          $secciones = Array();
          $seccion_controlador = new SeccionController();

          foreach ($contenido["secciones"] as $contenido_seccion) {
            $seccion = $seccion_controlador->store();
          }

          if ($marcado >= 0) {
          }
        }

        return $publicacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Publicacion::findOrFail($id);
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
