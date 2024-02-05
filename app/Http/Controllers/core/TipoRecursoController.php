<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;

use App\Models\TipoRecurso;
use App\Http\Controllers\Controller;

class TipoRecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $base_url = 'assets/img/icons/core/tipo_recurso/';
        $tipos_recurso_all = TipoRecurso::all();
        $tipos_recurso = collect($tipos_recurso_all)->map(function ($tipo_recurso) use ($base_url) {
          $tipo_recurso_mapped['tp_rec_id'] = $tipo_recurso['tp_rec_id'];
          $tipo_recurso_mapped['tp_rec_nombre'] = $tipo_recurso['tp_rec_nombre'];
          $tipo_recurso_mapped['tp_rec_icon_url'] = asset($base_url . $tipo_recurso['tp_rec_diminutivo'] . '.svg');
          $tipo_recurso_mapped['tp_rec_filter_key'] = $tipo_recurso['tp_rec_diminutivo'];

          // $svg = file_get_contents($tipo_recurso_mapped['tp_rec_icon_url']);

          return $tipo_recurso_mapped;
        });
        return $tipos_recurso;
        /*return $tipos_recurso_all;*/
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
