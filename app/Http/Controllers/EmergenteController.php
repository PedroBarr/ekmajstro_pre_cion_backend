<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class EmergenteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
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
    public function show($id) {
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

    public function images () {
      $base_url = 'assets/img/core/emergentes/imagenes/';
      
      return [
        'marco_url' => asset($base_url.'frame'.'.png'),
        'nota_url' => asset($base_url.'note'.'.png'),
        'icono_derecho_url' => asset($base_url.'ekmajstro'.'.svg'),
        'icono_izquierdo_url' => asset($base_url.'fairy'.'.svg')
      ];
    }
    
    public function preview () {
      $base_url = 'assets/img/core/emergentes/previsualizacion/';
      
      return [
        'decoracion_url' => asset($base_url.'decoracion'.'.png'),
        'icono_url' => asset($base_url.'ekmajstro'.'.svg'),
        'color_marco' => '#fce55b',
      ];
    }
}
