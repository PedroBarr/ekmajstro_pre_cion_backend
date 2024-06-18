<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Models\Seccion;

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
          $contenido = $request->json($datos);

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
        }

        return $seccion;
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
