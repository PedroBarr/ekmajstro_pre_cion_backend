<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Models\Segmento;

use Illuminate\Http\Request;
use Response;

class SegmentoController extends Controller
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

        //return $datos;
        if ($from_inner)
          $contenido = json_decode(key($datos), true);
        else {
          if (count($datos) == 1)
            $contenido = $request->json($datos);
          else {
            $contenido = json_decode(json_encode($datos), true);
            $contenido["contenido"] = json_decode(
              $contenido["contenido"], true
            );
          }
        }

        $segmento = Segmento::create([
          "segm_medida" => $contenido["medida"],
          "segm_posicion" => $contenido["posicion"],
          "segm_contenido" => json_encode($contenido["contenido"]),
          "secc_id" => $contenido["seccion"],
        ]);

        return $segmento;
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
