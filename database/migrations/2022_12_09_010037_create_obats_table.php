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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_faskes');
            $table->string('kode_obat');
            $table->text('nama_obat');
            $table->string('jenis_obat');
            $table->text('pabrik_obat');
            $table->text('dosis_obat');
            $table->string('tarif_obat');
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
        Schema::dropIfExists('obats');
    }
};