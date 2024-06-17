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
    public function store(Request $request)
    {
        $contenido = $request->json($request->all());

        $segmento = Segmento::create([
          "segm_medida" => $contenido["medida"],
          "segm_posicion" => $contenido["posicion"],
          "segm_contenido" => json_encode($contenido["contenido"]),
          "secc_id" => $contenido["seccion"],
        ]);

        return $segmento;
        //return $contenido["contenido"];
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