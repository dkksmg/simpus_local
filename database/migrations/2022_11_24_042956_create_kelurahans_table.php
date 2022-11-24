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
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kecamatan');
            $table->string('nama_kelurahan');
            $table->bigInteger('kode_kelurahan')->nullable();
            $table->string('kode_pos');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelurahans');
    }
};