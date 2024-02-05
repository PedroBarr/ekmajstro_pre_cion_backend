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
        Schema::create('secciones_marcadas', function (Blueprint $table) {
            $table->id('secc_marc_id');
            $table->unsignedBigInteger('pblc_id');
            $table->foreign('pblc_id')
                ->references('pblc_id')
                ->on('publicaciones')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('secciones_marcadas');
    }
};
