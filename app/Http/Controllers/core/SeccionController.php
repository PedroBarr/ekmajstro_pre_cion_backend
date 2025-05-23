<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Models\Seccion;
use App\Models\Publicacion;

use App\Http\Controllers\core\SegmentoController;

use Illuminate\Http\Request;
use Response;

class SeccionController extends Controller
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
    public function store(Request $request, ?bool $from_inner = False)
    {
        $datos = $request->all();
        $contenido = null;

        if ($from_inner)
          $contenido = json_decode(key($datos), true);
        else
          $contenido = $datos;

        $seccion = Seccion::create([
          "secc_nombre" => $contenido["nombre"],
          "pblc_id" => $contenido["publicacion"],
        ]);

        if (
          isset($contenido["segmentos"]) &&
          count($contenido["segmentos"]) > 0
        ) {
          $segmentos = Array();
          $segmento_controlador = new SegmentoController();

          for ($i = 0; $i < count($contenido["segmentos"]); $i++) {
            $contenido_segmento = $contenido["segmentos"][strval($i)];
            $contenido_segmento["seccion"] = $seccion->secc_id;

            $solicitud = new Request();
            $solicitud->setMethod('POST');
            $solicitud->request->add([json_encode($contenido_segmento) => null]);

            $respuesta_segmento = $segmento_controlador->store($solicitud, true);
            array_push($segmentos, $respuesta_segmento);
          }

          $seccion["segmentos"] = $segmentos;
        }

        if (
          isset($contenido["es_defecto"]) ||
          isset($contenido["es_marcada"]) ||
          isset($contenido["marcada"]) ||
          isset($contenido["secc_marcada"]) ||
          isset($contenido["secciones_marcadas_exists"])
        ) {
          $param_es_marcada = $contenido["es_defecto"] ?? $contenido["es_marcada"] ?? $contenido["marcada"] ?? $contenido["secc_marcada"] ?? $contenido["secciones_marcadas_exists"];
          $es_marcada = filter_var($param_es_marcada, FILTER_VALIDATE_BOOLEAN);

          if ($es_marcada) {
            Publicacion::marcar_seccion(
              $contenido["publicacion"],
              $seccion->secc_id
            );
          } else {
            Publicacion::desmarcar_seccion(
              $contenido["publicacion"],
              $seccion->secc_id
            );
          }
        }

        return $seccion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
      if (
        $request->has('con_es_marcada') && (
          filter_var($request->query('con_es_marcada'), FILTER_VALIDATE_BOOLEAN) ||
          filter_var($request->get('con_es_marcada'), FILTER_VALIDATE_BOOLEAN)
        )
      )
        return Seccion::con_seccion_marcada($id);
    
      return Seccion::findOrFail($id);
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

    /**
     * Get segments of section
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function segmentos($id)
    {
        $seccion = Seccion::findOrFail($id);
        return $seccion->segmentos;
    }

}
