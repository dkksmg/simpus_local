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
        Schema::create('tindakans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_faskes');
            $table->string('kode_tindakan')->index();
            $table->text('detail_tindakan');
            $table->string('tarif_tindakan');
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
        Schema::dropIfExists('tindakans');
    }
};