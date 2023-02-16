<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class TrazabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trazabilidad = $this->trazabilidad("Ekmajstro");
        $respuesta = Response::make($trazabilidad, 200);
        $respuesta->header("Content-Type","application/json");

        return $respuesta;
    }

    private function trazabilidad ($especificador) {
        $trazabilidad_Ekmajstro = function() {
            return Response::json([
                "nombre" => "Ekmajstro Pre Cion",
                "rol" => "Proyecto",
                "diminutivo" => "Ekmajstro",
                "enlace" => "https://ekmajstro.up.railway.app/",
                "descripcion" => "Ekmajstro Pre Cion es una bitacora ".
                    "personal que expone diferetes materiales producidos ".
                    "por el autor de la bitacora, Pedro Barr."
            ]);
        };
        if ($especificador == "Ekmajstro") { return $trazabilidad_Ekmajstro(); }
        return Response::json([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
