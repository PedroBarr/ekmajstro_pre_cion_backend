<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;

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
        $datos = $request->all();
        $contenido = $datos;

        $previsualizaciones_base_url = 'assets/img/core/publicaciones/';

        $prev_img_miniatura_uri = $contenido["miniatura_uri"];
        $prev_resumen = $contenido["resumen"];
        $prev_descripcion = $contenido["descripcion"];
        $rec_diminutivo = $contenido["rec_diminutivo"] ?? null;
        $pblc_id = $contenido["publicacion"] ?? $contenido["pblc_id"];

        
        $publicacion = Publicacion::where("pblc_id", $pblc_id)->first();
        
        if ($rec_diminutivo != null) {
            $recurso = Recurso::where("rec_diminutivo", $rec_diminutivo)->first();
        } else if ($publicacion != null) {
            $recurso = DB::table('recurso_publicacion')
                ->where('pblc_id', $publicacion->pblc_id)
                ->join('recursos', 'recursos.rec_id', '=', 'recurso_publicacion.rec_id')
                ->select('recursos.*')
                ->first();
        }

        if (!$recurso) {
            $recurso = Recurso::first();
        }

        $prev_img_miniatura_uri = $prev_img_miniatura_uri ?? '';

        if (strpos($prev_img_miniatura_uri, 'http') === false) {
            $prev_img_miniatura_uri = asset(
                $previsualizaciones_base_url.
                $prev_img_miniatura_uri
            );
        }

        $datos = [
          "prev_img_miniatura_uri" => $prev_img_miniatura_uri,
          "prev_resumen" => $prev_resumen,
          "prev_descripcion" => $prev_descripcion,
          "pblc_id" => $publicacion->pblc_id,
          "rec_id" => $recurso->rec_id,
        ];

        $previsualizacion = Previsualizacion::create($datos);

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
        $datos = $request->all();
        $contenido = $datos;
        
        $previsualizacion = Previsualizacion::findOrFail($id);

        $prev_img_miniatura_uri = $contenido["miniatura_uri"] ?? $previsualizacion->prev_img_miniatura_uri;
        $prev_resumen = $contenido["resumen"] ?? $previsualizacion->prev_resumen;
        $prev_descripcion = $contenido["descripcion"] ?? $previsualizacion->prev_descripcion;

        $previsualizacion->prev_img_miniatura_uri = $prev_img_miniatura_uri;
        $previsualizacion->prev_resumen = $prev_resumen;
        $previsualizacion->prev_descripcion = $prev_descripcion;

        $previsualizacion->save();

        $previsualizacion = $this->show($id);

        return $previsualizacion;
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
