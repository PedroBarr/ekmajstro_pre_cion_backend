<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = array(
            [
                'tp_rec_nombre' => 'Arreglista Musical',
                'tp_rec_descripcion' => (
                    'Recursos que involucran conocimiento musical, ' .
                    'sin necesidad de generar material multimedia.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'arr_mus',
            ],
            [
                'tp_rec_nombre' => 'Bellas Artes',
                'tp_rec_descripcion' => (
                    'Recursos de bellas artes (entendiendo la adaptación '.
                    'del término al contexto contemporaneo). Estos ' .
                    'recursos contrastan con la categoría Edición ' .
                    'Multimedia por focalizarse en un sentido, ignorando ' .
                    'la poli-sensorialidad.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'bll_art',
            ],
            [
                'tp_rec_nombre' => 'Ciencias de la Computacion',
                'tp_rec_descripcion' => (
                    'Recursos que involucran conocimiento en ciencias ' .
                    'de la computación, sin necesidad de enfocarse en la ' .
                    'difusión de conocimientos.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'ci_comp',
            ],
            [
                'tp_rec_nombre' => 'Difusion del Conocimiento',
                'tp_rec_descripcion' => (
                    'Recursos que se enfocan en la difusión de multiples ' .
                    'saberes sin objetivizar el conocimiento.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'dif_con',
            ],
            [
                'tp_rec_nombre' => 'Edicion Multimedia',
                'tp_rec_descripcion' => (
                    'Recursos que requieren el uso de multiples recursos ' .
                    'preexistentes con un objetivo especifico para ' .
                    'generar una experiencia poli-sensorial.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'ed_mult',
            ],
            [
                'tp_rec_nombre' => 'Escritura Creativa',
                'tp_rec_descripcion' => (
                    'Recursos que comunican una experiencia poli-' .
                    'sensorial, derogando la generación de los recursos ' .
                    'al espectador, comunicandole las especificaciones ' .
                    'esperadas de los recursos a través de un lenguaje común.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'esc_crea',
            ],
            [
                'tp_rec_nombre' => 'Ideas y Artesanias',
                'tp_rec_descripcion' => (
                    'Recursos sin terminar y con muy pocas posibilidades ' .
                    'de continuar en desarrollo.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'id_y_art',
            ],
            [
                'tp_rec_nombre' => 'Ludica y Entretenimiento',
                'tp_rec_descripcion' => (
                    'Recursos enfocados en presentar experiencias poli-' .
                    'sensoriales e interacciones para que el espectador ' .
                    '(o participante, para el caso) se comunique los ' .
                    'demás elementos del recurso.'
                ),
                'tp_rec_diminutivo' => 'tp_rec_' . 'lud_y_entr',
            ],
        );

        DB::table('tipos_recurso')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tipos_recurso')->delete();
    }
};
