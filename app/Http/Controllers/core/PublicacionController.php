<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Http\Controllers\core\SeccionController;

use App\Models\Publicacion;
use App\Models\SeccionMarcada;
use App\Models\EtiquetaPublicacion;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Publicacion::all();
    }

    public function etiquetar(Request $request, ?bool $from_inner = False)
    {
        $datos = $request->all();
        $contenido = null;

        if ($from_inner)
          $contenido = json_decode(key($datos), true);
        else
          $contenido = $request->json($datos);

        $pblc_id = $contenido["publicacion"];
        $etq_id = $contenido["etiqueta"];

        $resultado = DB::table('etiqueta_publicacion')->insert([
          "pblc_id" => $pblc_id,
          "etq_id" => $etq_id,
        ]);

        return Response::json(htmlspecialchars("¡Éxito!"));
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

        if ($from_inner)
          $contenido = json_decode(key($datos), true);
        else {
          $contenido = $datos;
        }

        $publicaciones_base_url = 'assets/img/core/publicaciones/';

        $pblc_titulo = $contenido["titulo"];
        $pblc_img_portada_uri = $contenido["portada_uri"] | $contenido["imagen"];
        $pblc_fecha_publicacion = date("Y-m-d");

        $publicacion = Publicacion::create([
          "pblc_titulo" => $pblc_titulo,
          "pblc_img_portada_uri" => asset(
            'assets/img/core/publicaciones/'.
            $pblc_img_portada_uri
          ),
          "pblc_fecha_publicacion" => $pblc_fecha_publicacion,
        ]);

        if (
          isset($contenido["secciones"]) &&
          count($contenido["secciones"]) > 0
        ) {
          $marcada = -1;
          $secciones = Array();
          $seccion_controlador = new SeccionController();

          for ($i = 0; $i < count($contenido["secciones"]); $i++) {
            $contenido_seccion = $contenido["secciones"][strval($i)];
            $contenido_seccion["publicacion"] = $publicacion->pblc_id;

            $solicitud = new Request();
            $solicitud->setMethod('POST');
            $solicitud->request->add([json_encode($contenido_seccion) => null]);

            $respuesta_seccion = $seccion_controlador->store($solicitud, true);
            array_push($secciones, $respuesta_seccion);

            if (
              isset($contenido_seccion["es_defecto"]) &&
              $contenido_seccion["es_defecto"]
            )
              $marcada = $i;
          }

          if ($marcada >= 0) {
            SeccionMarcada::create([
              "pblc_id" => $publicacion->pblc_id,
              "secc_id" => $secciones[$marcada]->secc_id,
            ]);
          }

          $publicacion["secciones"] = $secciones;
        }

        return $publicacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Publicacion::findOrFail($id);
    }

    /**
     * Upgrade a resource in storage
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upgrade(Request $request) {
      $datos = $request->all();
      $contenido = $request->json($datos);

      $id = $contenido["id"];

      return $this->update($request, $id);
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
        $datos = $request->all();
        $contenido = $datos;

        $publicacion = $this->show($id);

        $diccionario = $this->getDictAttributes();

        foreach ($diccionario as $clave => $propiedad) {
          if (isset($contenido[$clave]))
            $this->editValue($publicacion, $propiedad, $contenido[$clave]);
        }

        return $this->show($id);
    }

    private function getDictAttributes() {
      return [
        'pblc_titulo' => 'pblc_titulo',
        'titulo' => 'pblc_titulo',
        'pblc_img_portada_uri' => 'pblc_img_portada_uri',
        'imagen' => 'pblc_img_portada_uri',
        'portada' => 'pblc_img_portada_uri',
        'portada_uri' => 'pblc_img_portada_uri',
      ];
    }

    private function editValue(Publicacion $publicacion, String $clave, Mixed $valor) {
      switch ($clave) {
        default:
          Publicacion::findOrFail($publicacion->pblc_id)
            ->update([$clave => $valor]);
          break;
      }
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
