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
        Schema::create('nakes', function (Blueprint $table) {
            $table->id();
            $table->string('kode_faskes');
            $table->string('kode_nakes')->index();
            $table->string('kode_ihs_nakes')->nullable();
            $table->string('nama_nakes');
            $table->unsignedBigInteger('jabatan_nakes');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kode_faskes')->references('kode_faskes')->on('faskes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jabatan_nakes')->references('id')->on('jabatan_nakes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nakes');
    }
};