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
        Schema::create('master_kelurahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id');
            $table->string('kelurahan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kecamatan_id')->references('id')->on('master_kecamatans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kelurahans');
    }
};