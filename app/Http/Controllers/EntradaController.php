<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Anuncio;
use App\Models\Publicacion;
use App\Models\Previsualizacion;
use App\Models\TipoRecurso;
use App\Http\Controllers\Controller;

class EntradaController extends Controller
{

    private function get_entrada_from_anuncio($anuncio, $base_url) {
      return [
        "prev_tipo" => "ANUNCIO",
        "anun_id" => $anuncio['anun_id'],
        "anun_img" => asset($base_url . $anuncio['anun_img_cuerpo_uri']),
        "anun_enlace" => $anuncio['anun_enlace_uri'],
        "anun_medida" => $anuncio['anun_medida'],
      ];
    }

    private function get_entrada_from_previsualizacion($previsualizacion) {
      $previsualizacion = [
        "prev_tipo" => "PREVISUALIZCION",
        "prev_id" => $previsualizacion['prev_id'],
        "prev_img" => $previsualizacion['prev_img_miniatura_uri'],
        "prev_resumen" => $previsualizacion['prev_resumen'],
        "prev_descripcion" => $previsualizacion['prev_descripcion'],
        "prev_enlace" => "/publicacion/".$previsualizacion['pblc_id'],
        "prev_medida" => "1x1",
        "pblc_id" => $previsualizacion['pblc_id'],
      ];

      $publicacion = Publicacion::find($previsualizacion['pblc_id']);

      $previsualizacion['pblc_titulo'] = $publicacion['pblc_titulo'];
      $previsualizacion['pblc_etiquetas'] = $publicacion->etiquetas;
      $recursos = $publicacion->recursos;
      $previsualizacion['pblc_tipos_recurso'] = Array();

      foreach ($recursos as $recurso) {
        array_push(
          $previsualizacion['pblc_tipos_recurso'],
          TipoRecurso::find($recurso["tp_rec_id"])
        );
      }

      return $previsualizacion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anuncios_base_url = 'assets/img/core/anuncios/';
        $previsualizaciones_base_url = 'assets/img/core/anuncios/';
        $entradas = Array();

        $previsualizaciones = Previsualizacion::get();

        $anuncio_acerca_de = Anuncio
          ::where("anun_enlace_uri", "/acerca_de")
          ->first()
        ;

        $anuncios_grandes = Anuncio
          ::where("anun_enlace_uri", '!=', "/acerca_de")
          ->where("anun_medida", "2x1")
          ->get()
        ;

        $anuncios_chicos = Anuncio::where("anun_medida", "1x1")->get();

        if (isset($previsualizaciones) && count($previsualizaciones) > 0) {
          for (
            $i = 0;
            $i < min([13, count($previsualizaciones)]);
            $i++
          ) {
            array_push(
              $entradas,
              $this->get_entrada_from_previsualizacion($previsualizaciones[$i])
            );
          }
        }

        if (
          isset($anuncios_grandes) &&
          count($anuncios_grandes) > 0 &&
          isset($previsualizaciones) &&
          count($previsualizaciones) >= 3
        ) {
          array_splice(
            $entradas,
            3,
            0,
            Array(
              $this->get_entrada_from_anuncio(
                $anuncio_acerca_de,
                $anuncios_base_url
              )
            )
          );
        }

        if (
          isset($anuncios_chicos) &&
          count($anuncios_chicos) > 0 &&
          isset($previsualizaciones) &&
          count($previsualizaciones) >= 8
        ) {
          array_splice(
            $entradas,
            9,
            0,
            Array(
              $this->get_entrada_from_anuncio(
                $anuncios_chicos[rand(0, count($anuncios_chicos) - 1)],
                $anuncios_base_url
              )
            )
          );
        }

        if (
          isset($anuncios_grandes) &&
          count($anuncios_grandes) > 1 &&
          isset($previsualizaciones) &&
          count($previsualizaciones) >= 13
        ) {
          array_splice(
            $entradas,
            15,
            0,
            Array(
              $this->get_entrada_from_anuncio(
                $anuncios_grandes[rand(0, count($anuncios_grandes) - 1)],
                $anuncios_base_url
              )
            )
          );
        }

        return $entradas;
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
