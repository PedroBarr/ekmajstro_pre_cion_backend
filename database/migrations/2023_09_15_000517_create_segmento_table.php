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
        Schema::create('segmentos', function (Blueprint $table) {
            $table->id('segm_id');
            $table->string('segm_medida',100);
            $table->integer('segm_posicion');
            $table->json('segm_contenido')->nullable();
            $table->unsignedBigInteger('secc_id');
            $table->foreign('secc_id')
                ->references('secc_id')
                ->on('secciones')
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
        Schema::dropIfExists('segmentos');
    }
};
