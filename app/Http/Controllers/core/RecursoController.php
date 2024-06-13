<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;
use Response;

use App\Models\Recurso;
use App\Models\TipoRecurso;
use App\Models\TipoPermiso;
use App\Models\EspecificacionRecurso;

use App\Http\Controllers\Controller;
use App\Http\Controllers\core\ArchivoController;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recursos = Recurso::with(['tipoRecurso:id,nombre'])->paginate(10);
        return $recursos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $espc_descripcin = $request->input('espc_descripcion');
      $tp_rec_diminutivo = $request->input('tp_rec_diminutivo');
      $tp_perm_nombre = 'accesible';

      $rec_nombre = $request->input('rec_nombre');
      $rec_descripcion = $request->input('rec_descripcion');
      $rec_diminutivo = $request->input('rec_diminutivo');

      $archivo_controller = new ArchivoController();
      $response = $archivo_controller->store($request);
      $archivo = $response->original->original;

      $especificacion_recurso = EspecificacionRecurso::create([
        "espc_descripcin" => $espc_descripcin,
      ]);

      $tipo_recurso = TipoRecurso
        ::where('tp_rec_diminutivo', $tp_rec_diminutivo)
        ->first()
      ;

      $tipo_permiso = TipoPermiso
        ::where('tp_perm_nombre', $tp_perm_nombre)
        ->first()
      ;

      $recurso = Recurso::create([
        "rec_nombre" => $rec_nombre,
        "rec_descripcion" => $rec_descripcion,
        "rec_diminutivo" => $rec_diminutivo,
        "tp_rec_id" => $tipo_recurso->tp_rec_id,
        "tp_perm_id" => $tipo_permiso->tp_perm_id,
        "espc_id" => $especificacion_recurso->espc_id,
        "arch_id" => $archivo["id"],
      ]);

      $respuesta = Response::make(Response::json([
          "rec_nombre" => $recurso->rec_nombre,
          "rec_diminutivo" => $recurso->rec_diminutivo,
          "espc_descripcion" => $especificacion_recurso->espc_descripcin,
          "tp_rec_nombre" => $tipo_recurso->tp_rec_nombre,
          "tp_perm_nombre" => $tipo_permiso->tp_perm_nombre,
          "arch_nombre" => $archivo["nombre"],
          "arch_uri" => $archivo["uri"],
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
        $recurso = Recurso::with(['tipoRecurso:id,nombre'])->find($id);
        return $recurso;
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
