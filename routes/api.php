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
                "Bitacora Ekmajstro Pre Cion"
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
        "/recursos",
        [\App\Http\Controllers\RecursoController::class, 'index']
    )->name('recursos');

    Route::get(
        "/recurso/{diminutivo}",
        [\App\Http\Controllers\RecursoController::class, 'show']
    )->name('recurso');

    Route::get(
        "/archivos",
        [\App\Http\Controllers\core\ArchivoController::class, 'index']
    )->name('archivos');

    Route::get(
        "/archivo/{id}",
        [\App\Http\Controllers\core\ArchivoController::class, 'show']
    )->name('archivo');

    Route::post(
        "/archivo",
        [\App\Http\Controllers\core\ArchivoController::class, 'store']
    )->name('nuevo_archivo');

    Route::get(
        "/archivo/{id}",
        [\App\Http\Controllers\core\ArchivoController::class, 'show']
    )->name('obtener_archivo');

    Route::get(
      "/tipo_recursos",
      [\App\Http\Controllers\core\TipoRecursoController::class, 'index']
    )->name('get_tipo_recurso_list');

    Route::post(
        "/recurso",
        [\App\Http\Controllers\core\RecursoController::class, 'store']
    )->name('nuevo_recurso');

    Route::get(
      "/trazabilidad/social",
      [\App\Http\Controllers\TrazabilidadController::class, 'social']
    )->name('get_social_data');

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
    )->name('get_entrada_list');
});