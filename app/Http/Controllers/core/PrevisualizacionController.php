<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;
use Response;

use App\Models\Recurso;
use App\Models\Publicacion;
use App\Models\Previsualizacion;
use App\Http\Controllers\Controller;

class PrevisualizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Previsualizacion::all();
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
        $previsualizaciones_base_url = 'assets/img/core/publicaciones/';

        $prev_img_miniatura_uri = $contenido["miniatura_uri"];
        $prev_resumen = $contenido["resumen"];
        $prev_descripcion = $contenido["descripcion"];
        $rec_diminutivo = $contenido["rec_diminutivo"];
        $pblc_id = $contenido["pblc_id"];

        $recurso = Recurso::where("rec_diminutivo", $rec_diminutivo)->first();
        $publicacion = Publicacion::where("pblc_id", $pblc_id)->first();

        $previsualizacion = Previsualizacion::create([
          "prev_img_miniatura_uri" => asset(
            $previsualizaciones_base_url.
            $prev_img_miniatura_uri
          ),
          "prev_resumen" => $prev_resumen,
          "prev_descripcion" => $prev_descripcion,
          "rec_id" => $recurso->rec_id,
          "pblc_id" => $publicacion->pblc_id,
        ]);

        return $previsualizacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Previsualizacion::findOrFail($id);
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
