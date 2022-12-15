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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('kode_faskes');
            $table->string('no_cm')->index();
            $table->string('kode_ihs_pasien')->nullable();
            $table->unsignedBigInteger('nik');
            $table->string('asuransi');
            $table->string('nomor_asuransi')->nullable();
            $table->string('nama_pasien');
            $table->string('nama_kk');
            $table->string('no_hp_telp');
            $table->string('jenis_kelamin');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->unsignedBigInteger('provinsi');
            $table->unsignedBigInteger('kota_kab');
            $table->unsignedBigInteger('kecamatan');
            $table->unsignedBigInteger('kelurahan');
            $table->longText('alamat');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provinsi')->references('id')->on('master_provinsis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kota_kab')->references('id')->on('master_kota_kabs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kecamatan')->references('id')->on('master_kecamatans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelurahan')->references('id')->on('master_kelurahans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
};