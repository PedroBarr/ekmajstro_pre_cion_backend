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
        Schema::create('tipos_recurso', function (Blueprint $table) {
            $table->id('tp_rec_id');
            $table->string('tp_rec_nombre',100)->unique();
            $table->text('tp_rec_descripcion')->nullable();
            $table->string('tp_rec_diminutivo')->unique();
            $table->timestamps();
        });

        Schema::create('especificaciones_recurso', function (Blueprint $table) {
            $table->id('espc_id');
            $table->string('espc_descripcin',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_recurso');
        Schema::dropIfExists('especificaciones_recurso');
    }
};
