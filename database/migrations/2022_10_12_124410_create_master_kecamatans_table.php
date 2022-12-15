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
        Schema::create('master_kecamatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kota_id');
            $table->string('kecamatan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kota_id')->references('id')->on('master_kota_kabs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kecamatans');
    }
};