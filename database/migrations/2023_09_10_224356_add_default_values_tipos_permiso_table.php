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
        $data= array(
            'tp_perm_nombre' => 'lector',
            'tp_perm_descripcion' => (
                'Tipo de permiso genérico para la bitácora.'
            ),
        );

        DB::table('tipos_permiso')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tipos_permiso')
            ->where('tp_perm_nombre', 'lector')
            ->delete();

    }
};
