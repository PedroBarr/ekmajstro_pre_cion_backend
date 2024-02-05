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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id('arch_id');// autogenerado
            $table->string('arch_uri',150)->unique();//Storage::disk('local')->put('path/to/store/'.$filename, file_get_contents($file)); Storage::disk('public')->url($file->path);
            $table->string('arch_mime');//$file->getClientMimeType()
            $table->string('arch_extension');//$file->getClientOriginalExtension();
            $table->integer('arch_size');//$file->getSize();
            $table->string('arch_name');//$file->getClientOriginalName();
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
        Schema::dropIfExists('archivos');
    }
};
