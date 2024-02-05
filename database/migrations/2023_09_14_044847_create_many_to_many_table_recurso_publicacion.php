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
        Schema::create('recurso_publicacion', function (Blueprint $table) {
            $table->id('rec_pblc_id');
            $table->unsignedBigInteger('rec_id');
            $table->foreign('rec_id')
                ->references('rec_id')
                ->on('recursos')
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
        Schema::dropIfExists('recurso_publicacion');
    }
};
