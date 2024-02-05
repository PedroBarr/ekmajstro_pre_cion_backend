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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('comn_id');
            $table->json('comn_contenido');
            $table->unsignedBigInteger('usur_id');
            $table->foreign('usur_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('caja_comn_madre_id');
            $table->foreign('caja_comn_madre_id')
                ->references('caja_comn_id')
                ->on('cajas_comentarios')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('caja_comn_hija_id')->nullable();
            $table->foreign('caja_comn_hija_id')
                ->references('caja_comn_id')
                ->on('cajas_comentarios')
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
        Schema::dropIfExists('comentarios');
    }
};
