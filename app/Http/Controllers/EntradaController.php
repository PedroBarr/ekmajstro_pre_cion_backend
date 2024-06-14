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
        $previsualizaciones = Array();

        $anuncios_grandes = Anuncio::where("anun_medida", "2x1")->get();
        $anuncios_chicos = Anuncio::where("anun_medida", "1x1")->first();

        if (isset($anuncios_grandes) && count($anuncios_grandes) > 0) {
          $anuncio = $anuncios_grandes[0];

          array_push(
            $previsualizaciones,
            [
              "prev_tipo" => "ANUNCIO",
              "anun_id" => $anuncio['anun_id'],
              "anun_img" => asset($anuncios_base_url . $anuncio['anun_img_cuerpo_uri']),
              "anun_enlace" => $anuncio['anun_enlace_uri'],
              "anun_medida" => $anuncio['anun_medida'],
            ]
          );
        }

        if (isset($anuncios_grandes) && count($anuncios_grandes) > 1) {
          $anuncio = $anuncios_grandes[1];

          array_push(
            $previsualizaciones,
            [
              "prev_tipo" => "ANUNCIO",
              "anun_id" => $anuncio['anun_id'],
              "anun_img" => asset($anuncios_base_url . $anuncio['anun_img_cuerpo_uri']),
              "anun_enlace" => $anuncio['anun_enlace_uri'],
              "anun_medida" => $anuncio['anun_medida'],
            ]
          );
        }

        if (isset($anuncios_chicos) && count($anuncios_chicos) > 0) {
          $anuncio = $anuncios_chicos[0];

          array_push(
            $previsualizaciones,
            [
              "prev_tipo" => "ANUNCIO",
              "anun_id" => $anuncio['anun_id'],
              "anun_img" => asset($anuncios_base_url . $anuncio['anun_img_cuerpo_uri']),
              "anun_enlace" => $anuncio['anun_enlace_uri'],
              "anun_medida" => $anuncio['anun_medida'],
            ]
          );
        }

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
