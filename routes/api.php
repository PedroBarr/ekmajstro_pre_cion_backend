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

Route::get(
    "/",
    function ( ) {
        $index = Response::json("Bitacora Ekmajstro Pre Cion");
        $respuesta = Response::make($index, 200);
        $respuesta->header("Content-Type","application/json");

        return $respuesta;
        //return redirect()->route('about');
    }
);

Route::get(
    "/about",
    [\App\Http\Controllers\TrazabilidadController::class, 'index']
)->name('about');

Route::get(
    "/recursos",
    [\App\Http\Controllers\RecursoController::class, 'index']
)->name('recursos');

Route::get(
    "/recurso/{diminutivo}",
    [\App\Http\Controllers\RecursoController::class, 'show']
)->name('recurso');

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