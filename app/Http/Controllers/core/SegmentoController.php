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
    public function store(Request $request, ?bool $from_inner = False)
    {
        $datos = $request->all();
        $contenido = null;

        if ($from_inner)
          $contenido = json_decode(key($datos), true);
        else {
          if (count($datos) == 1)
            $contenido = $datos;
          else {
            $contenido = json_decode(json_encode($datos), true);

            if (!is_array($contenido["contenido"])) {
              $contenido["contenido"] = json_decode(
                $contenido["contenido"], true
              );
            }
          }
        }

        $seccion = $contenido["seccion"] ?? $contenido["secc_id"];

        $posicion = (isset($contenido["posicion"]) || isset($contenido["segm_posicion"]))
          ? $contenido["posicion"] ?? $contenido["segm_posicion"]
          : null;

        if ($posicion == null) {
            $max_posicion = Segmento::where("secc_id", "=", $seccion)
              ->max("segm_posicion");

            if ($max_posicion == null) {
                $posicion = 0;
            } else {
                $posicion = $max_posicion + 1;
            }
        }

        $datos = [
          "segm_medida" => $contenido["medida"] ?? $contenido["segm_medida"],
          "segm_posicion" => $posicion,
          "segm_contenido" => json_encode($contenido["contenido"]) ?? json_encode($contenido["segm_contenido"]),
          "secc_id" => $seccion,
        ];

        if (!in_array($datos["segm_medida"], ["1-col", "2-col", "3-col"])) {
            return response()->json([
                "error" => "El valor de la medida no es correcto"
            ], 400);
        }

        if ($datos["segm_posicion"] < 0) {
            return response()->json([
                "error" => "El valor de la posición no es correcto"
            ], 400);
        }

        $segmento = Segmento::create($datos);

        if ($from_inner) {
          return $segmento;
        } else {
          $segmento->segm_contenido = $segmento->getContenido();
          return $segmento;
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
        $segmento = Segmento::findOrFail($id);

        $contenido = $segmento->getContenido();

        $segmento->segm_contenido = $contenido;
        return $segmento;
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

        $segmento = $this->show($id);

        if (isset($contenido["contenido"]) || isset($contenido["segm_contenido"])) {
            $contenido["contenido"] = $contenido["contenido"] ?? $contenido["segm_contenido"];

            if (!is_array($contenido["contenido"])) {
                $contenido["contenido"] = json_decode($contenido["contenido"], true);
            }

            if (!isset($contenido["contenido"]["tipo"])) {
                return response()->json([
                    "error" => "El contenido no tiene el tipo definido"
                ], 400);
            }

            if (!isset($contenido["contenido"]["contenido"])) {
                $contenido["contenido"]["contenido"] = "";
            }

            if (!isset($contenido["contenido"]["clase"])) {
                $contenido["contenido"]["clase"] = "";
            }

            $contenido["contenido"] = json_encode($contenido["contenido"]);

            $segmento->segm_contenido = $contenido["contenido"];
        }

        if (isset($contenido["medida"]) || isset($contenido["segm_medida"])) {
            $segmento->segm_medida = $contenido["medida"] ?? $contenido["segm_medida"];
        }

        if (isset($contenido["posicion"]) || isset($contenido["segm_posicion"])) {
            $segmento->segm_posicion = $contenido["posicion"] ?? $contenido["segm_posicion"];
        }

        if (isset($contenido["secc_id"]) || isset($contenido["seccion"])) {
            $segmento->secc_id = $contenido["secc_id"] ?? $contenido["seccion"];
        }

        if (!in_array($segmento->segm_medida, ["1-col", "2-col", "3-col"])) {
            return response()->json([
                "error" => "El valor de la medida no es correcto"
            ], 400);
        }

        if ($segmento->segm_posicion < 0) {
            return response()->json([
                "error" => "El valor de la posición no es correcto"
            ], 400);
        }

        $segmento->save();

        $segmento = $this->show($id);

        return $segmento;
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

    /**
     * Relocate a segment
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function relocate(Request $request, $id)
    {
        $segmento = $this->show($id);
        $segm_posicion = $segmento->segm_posicion;

        $datos = $request->all();
        $contenido = $datos;

        if (isset($contenido["reubicacion"])) {
            $reubicacion = $contenido["reubicacion"] ?? null;
            $desplazable = true;

            switch ($reubicacion) {
                case "up":
                    $prev_segmento = Segmento::where([
                        ["secc_id", "=", $segmento->secc_id],
                        ["segm_posicion", "<", $segm_posicion],
                        ["segm_posicion", ">", -1],
                    ])->orderBy("segm_posicion", "desc")->first();

                    if ($prev_segmento) {
                      $segmento->segm_posicion = $prev_segmento->segm_posicion;
                    } else {
                      $segmento->segm_posicion = 0;
                    }

                    $segmento->save();

                    $posicion_desplazo = $segmento->segm_posicion;
                    $comparador = ">=";
                    $segmento_id = $segmento->segm_id;
                    break;
                  break;
                case "down":
                    $next_segmento = Segmento::where([
                        ["secc_id", "=", $segmento->secc_id],
                        ["segm_posicion", ">", $segm_posicion],
                    ])->orderBy("segm_posicion", "asc")->first();

                    if ($next_segmento) {
                      $next_posicion = $next_segmento->segm_posicion;
                      $next_segmento->segm_posicion = $segm_posicion;
                      $next_segmento->save();

                      $segmento->segm_posicion = $next_posicion;
                      $segmento->save();

                      $posicion_desplazo = $next_posicion;
                      $comparador = ">";
                      $segmento_id = $segmento->segm_id;
                    } else {
                      $desplazable = false;
                    }

                    break;
                case "first":
                    $segmento->segm_posicion = 0;
                    $segmento->save();
                    $posicion_desplazo = 0;
                    $comparador = ">=";
                    $segmento_id = $segmento->segm_id;
                    break;
                case "last":
                    $max_posicion = Segmento::where("secc_id", "=", $segmento->secc_id)
                      ->max("segm_posicion");

                    $segmento->segm_posicion = $max_posicion + 1;
                    $segmento->save();

                    $posicion_desplazo = -1;
                    $comparador = ">";
                    $segmento_id = null;
                    break;
                default:
                    $desplazable = false;
                    break;
            }

            if ($desplazable) {
              $segmentos_desplazar = Segmento::where([
                  ["secc_id", "=", $segmento->secc_id],
                  ["segm_posicion", $comparador, $posicion_desplazo],
              ])->orderBy("segm_posicion", "asc")->get();
            }
        }
        
        if (isset($contenido["posicion"])) {
            $posicion = $contenido["posicion"] ?? null;

            if ($posicion != $segm_posicion) {
                $segmento->segm_posicion = $posicion;
                $segmento->save();

                $posicion_desplazo = -1;
                $segmentos_desplazar = Segmento::where([
                    ["secc_id", "=", $segmento->secc_id],
                    ["segm_posicion", ">", $posicion_desplazo],
                ])->orderBy("segm_posicion", "asc")->get();
                $segmento_id = null;
            }
        }

        if (isset($segmentos_desplazar)) {
            $posicion_actual = $posicion_desplazo + 1;

            foreach ($segmentos_desplazar as $segm) {
                if ($segm->segm_id != $segmento_id) {
                    $segm->segm_posicion = $posicion_actual;
                    $segm->save();
                    $posicion_actual++;
                }
            }
        }

        $segmento = $this->show($id);

        return $segmento;
    }
}
