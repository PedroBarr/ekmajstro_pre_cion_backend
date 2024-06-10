<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Anuncio;
use App\Http\Controllers\Controller;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anuncios_base_url = 'assets/img/core/anuncios/';
        $anuncio_acerca_de = Anuncio::find(1);

        $previsualizaciones = Array(
          [
            "prev_tipo" => "ANUNCIO",
            "anun_id" => $anuncio_acerca_de['anun_id'],
            "anun_img" => asset($anuncios_base_url . $anuncio_acerca_de['anun_img_cuerpo_uri']),
            "anun_enlace" => $anuncio_acerca_de['anun_enlace_uri'],
            "anun_medida" => $anuncio_acerca_de['anun_medida'],
          ]
        );

        return $previsualizaciones;
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
