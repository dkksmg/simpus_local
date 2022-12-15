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
        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_faskes');
            $table->string('kode_poli')->index();
            $table->string('kode_location_poli')->nullable();
            $table->string('nama_poli');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kode_faskes')->references('kode_faskes')->on('faskes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polis');
    }
};