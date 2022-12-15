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
        Schema::create('faskes', function (Blueprint $table) {
            $table->id();
            $table->string('kode_faskes')->index();
            $table->string('id_ihs_org')->index()->nullable();
            $table->string('id_faskes_respons')->index()->nullable();
            $table->string('nama_faskes');
            $table->string('email_faskes')->nullable();
            $table->string('phone_faskes')->nullable();
            $table->string('phone_pj')->nullable();
            $table->string('fax_faskes')->nullable();
            $table->string('url_faskes')->nullable();
            $table->string('use_data_faskes')->default('work');
            $table->string('nama_pimpinan');
            $table->string('code_faskes')->default('prov');
            $table->string('display_faskes')->default('Healthcare Provider');
            $table->text('alamat_faskes');
            $table->string('use_alamat')->default('work');
            $table->string('type_alamat')->default('both');
            $table->string('province')->default('Jawa Tengah');
            $table->string('city')->default('Semarang');
            $table->unsignedBigInteger('district')->index()->nullable();
            $table->unsignedBigInteger('village')->index()->nullable();
            $table->string('rt/rw')->nullable();
            $table->string('no_ijin')->nullable();
            $table->date('ijin_berakhir')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('postal_code')->nullable();
            $table->mediumText('koordinat')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('district')->references('id')->on('kecamatans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('village')->references('id')->on('kelurahans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_faskes')->references('kode_faskes')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faskes');
    }
};