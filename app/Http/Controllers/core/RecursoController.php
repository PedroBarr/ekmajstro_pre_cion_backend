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
    public function index(Request $request)
    {
        if ($request->has('con_todo') && filter_var($request->query('con_todo'), FILTER_VALIDATE_BOOLEAN))
            return Recurso::with(['tipos', 'archivos', 'especificaciones'])
                ->get();
        return Recurso::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $datos = $request->all();
        $contenido = $datos;
      } catch (\Exception $e) {
        $contenido = [];
      }

      $espc_descripcin = (
          $contenido["especificacion"] ??
          $contenido["espc_descripcion"]
        ) ??
        $request->input('espc_descripcion')
      ;

      if ($request->has('tp_rec_diminutivo') || isset($contenido["tp_rec_diminutivo"])) {
        $tp_rec_diminutivo = $request->input('tp_rec_diminutivo');
      }

      if (isset($contenido["tp_rec_id"]) || $request->has('tipo_recurso')) {
        $tp_rec_id = $contenido["tipo_recurso"] ?? $contenido["tp_rec_id"];
      }

      $tp_perm_nombre = 'accesible';

      $rec_nombre = (
          $contenido["nombre"] ??
          $contenido["rec_nombre"]
        ) ??
        $request->input('rec_nombre')
      ;

      $rec_descripcion = (
          $contenido["descripcion"] ??
          $contenido["rec_descripcion"]
        ) ??
        $request->input('rec_descripcion')
      ;
      
      if ($request->has('rec_diminutivo') || isset($contenido["rec_diminutivo"])) {
        $rec_diminutivo = $request->input('rec_diminutivo');
      } else {
        $rec_diminutivo = strtolower(
          preg_replace('/[^a-z0-9]+/i', '_', $rec_nombre)
        );

        $rec_diminutivo .= '_' . time();
      }

      $archivo_controller = new ArchivoController();
      $response = $archivo_controller->store($request);

      if ($response->status() == 400) {
        return $response;
      }
      
      $archivo = $response->original;

      $especificacion_recurso = EspecificacionRecurso::create([
        "espc_descripcin" => $espc_descripcin,
      ]);

      if (isset($tp_rec_id)) {
        $tipo_recurso = TipoRecurso::findOrFail($tp_rec_id);
      } else if (isset($tp_rec_diminutivo)) {
        $tipo_recurso = TipoRecurso
          ::where('tp_rec_diminutivo', $tp_rec_diminutivo)
          ->first()
        ;
      } else {
        $tipo_recurso = TipoRecurso::first();
      }

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

      if (count($contenido) == 0) {
        $respuesta = Response::json([
            "rec_nombre" => $recurso->rec_nombre,
            "rec_diminutivo" => $recurso->rec_diminutivo,
            "espc_descripcion" => $especificacion_recurso->espc_descripcin,
            "tp_rec_nombre" => $tipo_recurso->tp_rec_nombre,
            "tp_perm_nombre" => $tipo_permiso->tp_perm_nombre,
            "arch_nombre" => $archivo["nombre"],
            "arch_uri" => $archivo["uri"],
        ]);

        return $respuesta;
      } else {
        return $recurso;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Recurso::findOrFail($id);
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
