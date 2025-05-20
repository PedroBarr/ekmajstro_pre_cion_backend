<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware(['cors'])->group(function ( ) {
    Route::get(
        "/",
        function ( ) {
            /*$index = Response::json([
                "nombre" => "Bitacora Ekmajstro Pre Cion"
            ]);*/
            $index = Response::json(htmlspecialchars(
                "Bitacora Ekmajstro Pre &Ccirc;ion"
            ));

            $respuesta = Response::make($index, 200);
            $respuesta->header("Content-Type","application/json");

            //return $respuesta;
            return $index;
            //return redirect()->route('about');
        }
    );

    Route::get(
        "/acerca_de",
        [\App\Http\Controllers\TrazabilidadController::class, 'index']
    )->name('acerca_de');

    Route::get(
      "/trazabilidad/{especificador?}",
      [\App\Http\Controllers\TrazabilidadController::class, 'trazabilidad']
    )->name('obtener_trazabilidad');

    Route::get(
      "/emergentes/imagenes",
      [\App\Http\Controllers\EmergenteController::class, 'images']
    )->name('elementos_emergente_imagenes');

    Route::get(
      "/emergentes/previsualizacion",
      [\App\Http\Controllers\EmergenteController::class, 'preview']
    )->name('elementos_emergente_previsualizacion');

    Route::post(
        "/recurso",
        [\App\Http\Controllers\core\RecursoController::class, 'store']
    )->name('nuevo_recurso');

    Route::get(
        "/recursos",
        [\App\Http\Controllers\core\RecursoController::class, 'index']
    )->name('recursos');

    Route::get(
        "/recurso/{diminutivo}",
        [\App\Http\Controllers\core\RecursoController::class, 'show']
    )->name('recurso');

    Route::get(
      "/recursos/publicacion/{id}",
      [\App\Http\Controllers\core\PublicacionController::class, 'recursos']
    )->name('recursos_publicacion');

    Route::post(
        "/archivo",
        [\App\Http\Controllers\core\ArchivoController::class, 'store']
    )->name('nuevo_archivo');

    Route::get(
        "/archivos",
        [\App\Http\Controllers\core\ArchivoController::class, 'index']
    )->name('archivos');

    Route::get(
        "/archivo/{id}",
        [\App\Http\Controllers\core\ArchivoController::class, 'show']
    )->name('archivo');

    Route::get(
      "/tipo_recursos",
      [\App\Http\Controllers\core\TipoRecursoController::class, 'index']
    )->name('tipos_recurso');

    Route::post(
      "/publicacion",
      [\App\Http\Controllers\core\PublicacionController::class, 'store']
    )->name('nueva_publicacion');

    Route::get(
      "/publicaciones",
      [\App\Http\Controllers\core\PublicacionController::class, 'index']
    )->name('publicaciones');

    Route::get(
      "/publicacion/{id}",
      [\App\Http\Controllers\core\PublicacionController::class, 'show']
    )->name('publicacion');

    Route::post(
      "/publicacion/etiqueta",
      [\App\Http\Controllers\core\PublicacionController::class, 'etiquetar']
    )->name('etiquetar_publicacion');

    Route::put(
      "/publicacion/{id}",
      [\App\Http\Controllers\core\PublicacionController::class, 'update']
    )->name('editar_publicacion');

    Route::post(
      "/publicacion/actualizar",
      [\App\Http\Controllers\core\PublicacionController::class, 'upgrade']
    )->name('actualizar_publicacion');

    Route::get(
      "/publicacion/{id}/secciones",
      [\App\Http\Controllers\core\PublicacionController::class, 'secciones']
    )->name('publicacion_lista_secciones');
    
    Route::get(
      "/publicacion/{id}/recursos",
      [\App\Http\Controllers\core\PublicacionController::class, 'recursos']
    )->name('publicacion_lista_recursos');
    
    Route::get(
      "/publicacion/{id}/etiquetas",
      [\App\Http\Controllers\core\PublicacionController::class, 'etiquetas']
    )->name('publicacion_lista_etiquetas');
    
    Route::get(
      "/publicacion/{id}/previsualizacion",
      [\App\Http\Controllers\core\PublicacionController::class, 'previsualizacion']
    )->name('publicacion_previsualizacion');

    Route::post(
      "/previsualizacion",
      [\App\Http\Controllers\core\PrevisualizacionController::class, 'store']
    )->name('nueva_previsualizacion');

    Route::get(
      "/previsualizaciones",
      [\App\Http\Controllers\core\PrevisualizacionController::class, 'index']
    )->name('previsualizaciones');

    Route::get(
      "/previsualizacion/{id}",
      [\App\Http\Controllers\core\PrevisualizacionController::class, 'show']
    )->name('previsualizacion');

    Route::get(
      "/previsualizacion/publicacion/{id}",
      [\App\Http\Controllers\core\PublicacionController::class, 'previsualizacion']
    )->name('previsualizacion_publicacion');

    Route::post(
      "/etiqueta",
      [\App\Http\Controllers\core\EtiquetaController::class, 'store']
    )->name('nueva_etiqueta');

    Route::get(
      "/etiquetas",
      [\App\Http\Controllers\core\EtiquetaController::class, 'index']
    )->name('etiquetas');

    Route::get(
      "/etiqueta/{id}",
      [\App\Http\Controllers\core\EtiquetaController::class, 'show']
    )->name('etiqueta');

    Route::get(
      "/etiquetas/publicacion/{id}",
      [\App\Http\Controllers\core\PublicacionController::class, 'etiquetas']
    )->name('etiquetas_publicacion');

    Route::post(
      "/seccion",
      [\App\Http\Controllers\core\SeccionController::class, 'store']
    )->name('nueva_seccion');

    Route::get(
      "/secciones/publicacion/{id}",
      [\App\Http\Controllers\core\PublicacionController::class, 'secciones']
    )->name('secciones_publicacion');

    Route::post(
      "/segmento",
      [\App\Http\Controllers\core\SegmentoController::class, 'store']
    )->name('nuevo_segmento');

    Route::get(
      "/404",
      [\App\Http\Controllers\TrazabilidadController::class, 'ignota']
    )->name('ignota');

    /*Route::get(
        "/favicon.ico",
        function ( ) {
            $ruta = resource_path() . '/assets/img/icons/favicon.ico';

            $archivo = File::get($ruta);
            $tipo = File::mimeType($ruta);

            $respuesta = Response::make($archivo, 200);
            $respuesta->header("Content-Type",$tipo);

            return $respuesta;
            //return File::get(resource_path() . '/assets/img/icons/favicon.ico');
        }
    );*/

    Route::get(
      "/anuncios",
      [\App\Http\Controllers\core\AnuncioController::class, 'index']
    )->name('get_anuncio_list');

    Route::get(
      "/entradas",
      [\App\Http\Controllers\EntradaController::class, 'index']
    )->name('entradas');

    Route::get(
        "/entrada/acerca_de",
        [\App\Http\Controllers\TrazabilidadController::class, 'entrada_acerca_de']
    )->name('entrada_acerca_de');

    Route::get(
      "/entrada/{id}",
      [\App\Http\Controllers\EntradaController::class, 'show']
    )->name('entrada');

    Route::fallback(function () {
        return redirect('/api/404');
    });

});