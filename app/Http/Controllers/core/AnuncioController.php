<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;

use App\Models\Anuncio;
use App\Http\Controllers\Controller;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $base_url = 'assets/img/core/anuncios/';
        $anuncios_all = Anuncio::all();
        $anuncios = collect($anuncios_all)->map(function ($anuncio) use ($base_url) {
          $anuncio_mapped['anun_id'] = $anuncio['anun_id'];
          $anuncio_mapped['anun_img'] = asset($base_url . $anuncio['anun_img_cuerpo_uri']);
          $anuncio_mapped['anun_enlace'] = $anuncio['anun_enlace_uri'];
          $anuncio_mapped['anun_medida'] = $anuncio['anun_medida'];

          return $anuncio_mapped;
        });
        return $anuncios;
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
