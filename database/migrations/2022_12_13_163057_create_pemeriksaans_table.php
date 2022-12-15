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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('id_kunjungan')->index();
            $table->string('kode_faskes')->index();
            $table->string('id_condition')->nullable();
            $table->string('id_obs_nadi')->nullable();
            $table->string('id_obs_napas')->nullable();
            $table->string('id_obs_sistole')->nullable();
            $table->string('id_obs_diastole')->nullable();
            $table->string('id_obs_suhu')->nullable();
            $table->string('no_cm')->index();
            $table->date('tgl_kunjungan');
            $table->string('poli')->index();
            $table->string('dokter')->index();
            $table->text('anamnesa')->nullable();
            $table->string('kesadaran');
            $table->string('sistolik');
            $table->string('diastolik');
            $table->string('suhu');
            $table->string('tb');
            $table->string('bb');
            $table->string('respiratory_rate');
            $table->string('heart_rate');
            $table->string('lingkar_perut');
            $table->text('pemeriksaan_fisik')->nullable();
            $table->string('pertemuan')->nullable();
            $table->string('diag1')->nullable();
            $table->string('diag2')->nullable();
            $table->string('diag3')->nullable();
            $table->json('diag4')->nullable();
            $table->string('tindakan1')->nullable();
            $table->string('tindakan2')->nullable();
            $table->string('tindakan3')->nullable();
            $table->json('tindakan4')->nullable();
            $table->string('obat')->nullable();
            $table->longText('edukasi')->nullable();
            $table->string('status_pasien')->nullable();
            $table->string('rujukan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('no_cm')->references('no_cm')->on('pasiens')->onUpdate('cascade');
            $table->foreign('id_kunjungan')->references('id_kunjungan')->on('kunjungans')->onUpdate('cascade');
            $table->foreign('poli')->references('kode_poli')->on('polis')->onUpdate('cascade');
            $table->foreign('diag1')->references('kode_icd')->on('icdrefs')->onUpdate('cascade');
            $table->foreign('diag2')->references('kode_icd')->on('icdrefs')->onUpdate('cascade');
            $table->foreign('diag3')->references('kode_icd')->on('icdrefs')->onUpdate('cascade');
            $table->foreign('tindakan1')->references('kode_tindakan')->on('tindakans')->onUpdate('cascade');
            $table->foreign('tindakan2')->references('kode_tindakan')->on('tindakans')->onUpdate('cascade');
            $table->foreign('tindakan3')->references('kode_tindakan')->on('tindakans')->onUpdate('cascade');
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
        Schema::dropIfExists('pemeriksaans');
    }
};