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
        Schema::create('recursos', function (Blueprint $table) {
            $table->id('rec_id');
            $table->string('rec_nombre',150)->unique();
            $table->text('rec_descripcion');
            $table->string('rec_diminutivo')->nullable();

            //relaciones
            $table->unsignedBigInteger('tp_rec_id');
            $table->foreign('tp_rec_id')
                ->references('tp_rec_id')
                ->on('tipos_recurso')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('tp_perm_id');
            $table->foreign('tp_perm_id')
                ->references('tp_perm_id')
                ->on('tipos_permiso')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('espc_id');
            $table->foreign('espc_id')
                ->references('espc_id')
                ->on('especificaciones_recurso')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recursos');
    }
};
