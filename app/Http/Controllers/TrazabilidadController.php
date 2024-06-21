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
                    "por el autor de la bitacora, Pedro Barr.",
                "entrada" => $this->entrada_acerca_de(),
            ]);
        };
        if ($especificador == "Ekmajstro")
          return $trazabilidad_Ekmajstro();

        return Response::json([]);
    }

    public function social()
    {
        $base_url = 'assets/img/icons/core/trazabilidad/social/';
        $social = Response::json(Array(
            [
              "soc_nombre" => 'Redes personales',
              "soc_icon_url" => asset($base_url . 'personal_network' . '.svg'),
              "soc_anchor_href" => 'https://www.instagram.com/pedrobarr203',
            ],
            [
              "soc_nombre" => 'Redes del consumidor',
              "soc_icon_url" => asset($base_url . 'consumer_network' . '.svg'),
              "soc_anchor_href" => 'https://www.youtube.com/@pedrobarr_2037',
            ],
            [
              "soc_nombre" => 'Codigo fuente',
              "soc_icon_url" => asset($base_url . 'source_code' . '.svg'),
              "soc_anchor_href" => 'https://github.com/PedroBarr',
            ],
            [
              "soc_nombre" => 'Fuente de proposito',
              "soc_icon_url" => asset($base_url . 'source_purpose' . '.svg'),
              "soc_anchor_href" => 'https://pedrobarr.github.io/',
            ]
        ));
        return $social;
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

    public function entrada_acerca_de ( ) {
      // https://www.toptal.com/designers/htmlarrows/letters/
      $base_url = 'assets/img/';

      $segmn_acerca_de_desc_1 = [
        "segm_medida" => "1-col",
        "segm_posicion" => 0,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "Ekmajstro Pre &Ccirc;ion es una bitacora que puede usarse como " .
            "portafolio de microproyectos. A trav&eacute;s de diferentes " .
            "entradas, publicaciones, comisiones y hasta talleres de " .
            "ense&ntilde;anza se busca mostrar variedad de conocimientos " .
            "multidisciplicarios."
          ),
        ]),
      ];

      $segmn_acerca_de_desc_2 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 1,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "Actualmente, y posiblemente a perpetuidad esta p&aacute;gina " .
            "se encuentra en desarrollo. Cada entrada producida, si " .
            "contiene archivos, busca ser protegida bajo derechos de autor " .
            "con tal de proteger las ideas de su respectivo creador, sin " .
            "embargo, tambi&eacute;n se busca con cada entrada inspirar a " .
            "nuevos creadores, as&iacute; que el desarrollo de ideas " .
            "derivadas no es restrictivo. La menci&oacute; de " .
            "inspiraci&oacute;n es voluntaria y de buena fe.\n\n" .
            "\tForto en kuni&gcirc;o!"
          ),
        ]),
      ];

      $segmn_acerca_de_desc_3 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 2,
        "segm_contenido" => json_encode([
          "tipo" => "imagen",
          "contenido" => "https://www.polly.ai/hubfs/Blog%20Images/Illustrations%20(white,%20svg)/People%20Ops%20Fun%201.svg",
          "clase" => "med-medd",
          "alternativo" => "",
        ]),
      ];
      
      $segmn_acerca_de_dats_1 = [
        "segm_medida" => "1-col",
        "segm_posicion" => 0,
        "segm_contenido" => json_encode([
          "tipo" => "titulo",
          "contenido" => "Origen",
        ]),
      ];
      
      $segmn_acerca_de_dats_2 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 1,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "Ekmajstro Pre &Ccirc;ion nace de la necesidad de visibilizar " .
            "microproyectos. Peque&ntilde;as pildoras de conocimiento " .
            "aplicado que pretenden inspirar a otros.\n" .
            "La idea original fue realizada por Pedro Barr., un aficionado " .
            "a multitud de temas que cree firmemente en la difusi&oacute;n " .
            "del conocimiento como principio inmutable.\n".
            "As&iacute; mismo, el grupo Alta Lengua, como grupo " .
            "interdisciplinario, promueve el desarrollo de proyectos " .
            "relacionados a la pluralidad del conocimiento, tal como " .
            "Ekmajstro Pre &Ccirc;ion."
          ),
        ]),
      ];
      
      $segmn_acerca_de_dats_3 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 2,
        "segm_contenido" => json_encode([
          "tipo" => "imagen",
          "contenido" => asset($base_url.'icons/core/ekmajstro.svg'),
          "clase" => 'peq-medd',
          "alternativo" => "&Iacute;cono de Ekcio"
        ]),
      ];
      
      $segmn_acerca_de_dats_4 = [
        "segm_medida" => "1-col",
        "segm_posicion" => 3,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "La simbolog&iacute;a del proyecto surge como " .
            "representaci&oacute;n de lo central. Lo m&aacute;s destacable " .
            "es la imagen de una rosa, un s&iacute;mbolo importante en la" .
            "saga de ficci&oacute;n del estadoamericano Stephen King, " .
            "La Torre Oscura -una afici&oacute;n com&uacute;n entre los " .
            "miembros de Alta Lengua y Pedro Barr. En la saga se usa como " .
            "s&iacute;mbolo al rededor del cual convergen los eventos y el " .
            "universo en s&iacute;. En la realidad, la rosa es una flor " .
            "cuyos petalos se sobreponen, rodeando un centro com&uacute;n " .
            "y al abrirse no pierde este centro. Por estos dos sentidos se " .
            "eligi&oacute; como s&iacute;mbolo principal.\n" .
            "Junto con la rosa tambi&eacute;n se encuentran dos " .
            "s&iacute;mbolos: (1) la f&oacute;rmula de media " .
            "geom&eacute;trica y (2) dos segmentos " .
            "de la clave de do, que es la clave central en m&uacute;sica " .
            "tenor.\n" .
            "En conjunto, los s&iacute;mbolos transmiten la idea de centro, " .
            "cada uno en su respectiva disciplina."
          ),
        ]),
      ];
      
      $segmn_acerca_de_dats_5 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 4,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "El nombre del proyecto es tambi&eacute;n un s&iacute;mbolo en " .
            "s&iacute;, que sirve como promesa a su proposito. Pero para " .
            "hablar de ello primero se debe introducir el esperanto.\n" .
            "En 1887, el oftalm&oacute;go L. L. Zamenhof ide&oacute; un " .
            "idioma planificado para ser una lengua f&aacute;cil de " .
            "aprender. Lo public&oacute; bajo el seud&oacute;nimo de Dr. " .
            "Esperanto, que en este idioma significar&iacute;a 'El que " .
            "tiene esperanza'. Y as&iacute; se acogi&oacute; como nombre " .
            "a este nuevo idioma, el esperanto, Actulmente no se ha " .
            "popularizado su uso, pero es de esperar que eventualmente " .
            "sea la lengua de uso com&uacute;n, superando a la " .
            "masificaci&oacute;n del idioma yanqui.\n" .
            "Entonces &iquest;qu&eacute; significa 'ekmajstro pre " .
            "&ccirc;ion'? Bueno, lo correcto no ser&iacute;a saberlo, " .
            "sino comprenderlo; Y...\n\n" .
            "\t...kompreno postula la devontigon esplori."
          ),
        ]),
      ];
      
      $segmn_acerca_de_dats_6 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 5,
        "segm_contenido" => json_encode([
          "tipo" => "imagen",
          "contenido" => "https://elordenmundial.com/wp-content/uploads/2021/07/esperanto-idioma-mundo-historia-cultura-lengua-e1625650364539.jpg",
          "clase" => 'med-medd',
          "alternativo" => "Bandera y escudo ficticios del esperanto"
        ]),
      ];
      
      $segmn_acerca_de_dats_7 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 6,
        "segm_contenido" => json_encode([
          "tipo" => "titulo",
          "contenido" => "Misi&oacute;n",
        ]),
      ];
      
      $segmn_acerca_de_dats_8 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 7,
        "segm_contenido" => json_encode([
          "tipo" => "titulo",
          "contenido" => "Visi&oacute;n",
        ]),
      ];
      
      $segmn_acerca_de_dats_9 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 8,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "Servir de expocisi&oacute;n de microproyectos y de " .
            "inspiraci&oacute;n para multitud de yentes, para que la " .
            "pr&aacute;ctica del conocimiento no se pierda y m&aacute;s " .
            "gente se interese por &eacute;l."
          ),
        ]),
      ];
      
      $segmn_acerca_de_dats_10 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 9,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "Que los ideales del proyecto se formalicen, permitiendo a " .
            "m&aacute;s gente aprender. Adem&aacute; de visibilizar " .
            "conocimiento notablemente ignorado que merece ser mayormente " .
            "conocido."
          ),
        ]),
      ];
      
      $segmn_acerca_de_col_1 = [
        "segm_medida" => "1-col",
        "segm_posicion" => 0,
        "segm_contenido" => json_encode([
          "tipo" => "titulo",
          "contenido" => "Pedro Barr.",
        ]),
      ];
      
      $segmn_acerca_de_col_2 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 1,
        "segm_contenido" => json_encode([
          "tipo" => "imagen",
          "contenido" => "https://filebrowser-production-c5e2.up.railway.app/api/public/dl/4PGFwJWX?inline=true",
          "clase" => "circ_img peq-medd",
          "alternativo" => "Foto cortada de Pedro Barr.",
        ]),
      ];
      
      $segmn_acerca_de_col_3 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 2,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "Pedro Barr., un joven de " .
            (((new \DateTime())->diff(new \DateTime('2000-07-01')))->y) .
            " a&ntilde;os con inter&eacute;s en la m&uacute;sica, la " .
            "escritura, la programaci&oacute;n y la matem&aacute;tica " .
            "creci&oacute; con la fascinaci&oacute;n de difundir el " .
            "conocimiento, practicarlo, y sobre todo profundizarlo. " .
            "Decidi&oacute; elaborar Ekmajstro Pre &Ccirc;ion para dar " .
            "visibilidad a micropoyectos variados."
          ),
          "clase" => "vert-cent-texto horiz-cent-texto",
        ]),
      ];
      
      $segmn_acerca_de_col_4 = [
        "segm_medida" => "1-col",
        "segm_posicion" => 3,
        "segm_contenido" => json_encode([
          "tipo" => "titulo",
          "contenido" => "Alta Lengua",
        ]),
      ];
      
      $segmn_acerca_de_col_5 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 4,
        "segm_contenido" => json_encode([
          "tipo" => "texto",
          "contenido" => (
            "Alta Lengua es un grupo interdisciplinario de miembros con una " .
            "&uacute;nica empresa... El grupo promueve la integraci&oacute;n " .
            "de la tecnolog&iacute;a en la cotidianidad y da soporte a " .
            "proyectos que desean difundir el conocimiento profundizado."
          ),
          "clase" => "vert-cent-texto horiz-cent-texto",
        ]),
      ];
      
      $segmn_acerca_de_col_6 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 5,
        "segm_contenido" => json_encode([
          "tipo" => "imagen",
          "contenido" => asset($base_url.'icons/core/al.svg'),
          "clase" => "circ_img peq-medd",
          "alternativo" => "&Iacute; p&uacuteblico de Alta Lengua",
        ]),
      ];
      
      $segmn_acerca_de_prox_1 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 0,
        "segm_contenido" => json_encode([
          "tipo" => "titulo",
          "contenido" => "Mallonga limtempo",
        ]),
      ];
      
      $segmn_acerca_de_prox_2 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 1,
        "segm_contenido" => json_encode([
          "tipo" => "titulo",
          "contenido" => "Longtempa",
        ]),
      ];
      
      $segmn_acerca_de_prox_3 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 2,
        "segm_contenido" => json_encode([
          "tipo" => "lista",
          "contenido" => [
            "Agregar recursos compartidos",
            "Redactar publicaci&oacute;n de la saga de apocalipsis",
            "Agregar emergentes im&aacute;genes",
            "Redactar publicaci&oacute;n de Max Power",
            "Agregar emergentes previsualizaci&oacute;n",
            "Redactar publicaci&oacute;n de For the Damaged Coda",
            "Corregir estilos",
            "Redactar publicaci&oacute;n de La Rosa Blanca",
            "Agregar sobreescritura del consigna",
          ],
          "uri_separador" => asset($base_url.'icons/core/ekmajstro.svg'),
        ]),
      ];
      
      $segmn_acerca_de_prox_4 = [
        "segm_medida" => "2-col",
        "segm_posicion" => 3,
        "segm_contenido" => json_encode([
          "tipo" => "lista",
          "contenido" => [
            "Dise&ntilde;ar contenido y recursos",
            "Agregar anuncios",
            "Agregar filtros",
            "Agregar b&uacute;squeda",
            "Agregar p&aacute;gina ignota",
            "Agregar cajas de comentarios",
            "Agregar traducci&oacute;n a esperanto",
            "Agregar conexi&oacute;n aplicativo Qt y Flutter",
            "Agregar dise&ntilde;o responsivo",
            "Agregar dise&ntilde;o paginaci&oacute;n",
            "Agregar m&oacute;dulos de ense&ntilde;anza",
            "Corregir enrutamiento",
          ],
          "uri_separador" => asset($base_url.'icons/core/al.svg'),
        ]),
      ];

      $secciones = Array(
        [
          "secc_id" => "secc_acerca_de_descripcion",
          "secc_nombre" => "Descripcion",
          "secciones_marcadas_exists" => true,
          "segmentos" => [
            $segmn_acerca_de_desc_1,
            $segmn_acerca_de_desc_2,
            $segmn_acerca_de_desc_3,
          ],
        ],
        [
          "secc_id" => "secc_acerca_de_datos",
          "secc_nombre" => "Origen, mision, vision y detalles",
          "secciones_marcadas_exists" => false,
          "segmentos" => [
            $segmn_acerca_de_dats_1,
            $segmn_acerca_de_dats_2,
            $segmn_acerca_de_dats_3,
            $segmn_acerca_de_dats_4,
            $segmn_acerca_de_dats_5,
            $segmn_acerca_de_dats_6,
            $segmn_acerca_de_dats_7,
            $segmn_acerca_de_dats_8,
            $segmn_acerca_de_dats_9,
            $segmn_acerca_de_dats_10,
          ],
        ],
        [
          "secc_id" => "secc_acerca_de_colaboradores",
          "secc_nombre" => "Colaboradores",
          "secciones_marcadas_exists" => false,
          "segmentos" => [
            $segmn_acerca_de_col_1,
            $segmn_acerca_de_col_2,
            $segmn_acerca_de_col_3,
            $segmn_acerca_de_col_4,
            $segmn_acerca_de_col_5,
            $segmn_acerca_de_col_6,
          ],
        ],
        [
          "secc_id" => "secc_acerca_de_proximamente",
          "secc_nombre" => "Proximamente",
          "secciones_marcadas_exists" => false,
          "segmentos" => [
            $segmn_acerca_de_prox_1,
            $segmn_acerca_de_prox_2,
            $segmn_acerca_de_prox_3,
            $segmn_acerca_de_prox_4,
          ],
        ],
      );

      $entrada = [
        "id" => "acerca_de",
        "titulo" => "Acerca de",
        "fecha_publicacion" => date('Y-m-d'),
        //"portada" => asset($base_url.'core/unfound.png'),
        "secciones" => $secciones,
      ];

      return Response::json($entrada);
    }

}
