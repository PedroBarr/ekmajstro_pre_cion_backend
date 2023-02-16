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
            $table->id();
            $table->string('nombre',150)->unique();
            $table->text('descripcion');
            $table->string('diminutivo')->unique();
            $table->string('enlace')->unique()->nullable();

            //relaciones
            $table->unsignedBigInteger('tipo_recurso_id');
            $table->foreign('tipo_recurso_id')
                ->references('id')
                ->on('tipos_recurso')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('tipo_permiso_id');
            $table->foreign('tipo_permiso_id')
                ->references('id')
                ->on('tipos_permiso')
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
