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
        Schema::create('etiqueta_publicacion', function (Blueprint $table) {
            $table->id('etq_pblc_id');
            $table->unsignedBigInteger('etq_id');
            $table->foreign('etq_id')
                ->references('etq_id')
                ->on('etiquetas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('pblc_id');
            $table->foreign('pblc_id')
                ->references('pblc_id')
                ->on('publicaciones')
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
        Schema::dropIfExists('etiqueta_publicacion');
    }
};
