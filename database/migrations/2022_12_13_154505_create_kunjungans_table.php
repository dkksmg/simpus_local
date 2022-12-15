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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('id_kunjungan')->nullable()->index();
            $table->string('id_encounter')->nullable();
            $table->string('kode_faskes')->nullable();
            $table->string('no_cm')->index();
            $table->string('no_ihs')->index()->nullable();
            $table->date('tgl_kunjungan');
            $table->string('poli');
            $table->string('dokter');
            $table->enum('status_pasien', ['planned', 'arrived', 'triaged', 'in-progress', 'onleave', 'finished', 'cancelled']);
            $table->enum('status_kunjungan', ['Baru', 'Lama']);
            $table->dateTime('start')->nullable();
            $table->string('cara_bayar')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kode_faskes')->references('kode_faskes')->on('faskes')->onUpdate('cascade');
            $table->foreign('no_cm')->references('no_cm')->on('pasiens')->onUpdate('cascade');
            $table->foreign('poli')->references('kode_poli')->on('polis')->onUpdate('cascade');
            $table->foreign('dokter')->references('kode_nakes')->on('nakes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunjungans');
    }
};