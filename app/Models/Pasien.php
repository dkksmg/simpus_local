<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_faskes', 'kode_pasien', 'no_cm', 'kode_ihs_pasien', 'nik', 'asuransi', 'nomor_asuransi', 'nama_pasien', 'nama_kk', 'hp', 'jenis_kelamin', 'tmp_lahir', 'tgl_lahir', 'provinsi', 'kota_kab', 'kecamatan', 'kelurahan', 'alamat', 'status_pernikahan'
    ];

    public function detail_faskes()
    {
        return $this->belongsTo(Faskes::class, 'kode_faskes', 'kode_faskes');
    }
    public function detail_provinsi()
    {
        return $this->belongsTo(MasterProvinsi::class, 'provinsi', 'id');
    }
    public function detail_kotakab()
    {
        return $this->belongsTo(MasterKotaKab::class, 'kota_kab', 'id');
    }
    public function detail_kecamatan()
    {
        return $this->belongsTo(MasterKecamatan::class, 'kecamatan', 'id');
    }
    public function detail_kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan', 'id');
    }
    public function history()
    {
        return $this->hasMany(Pemeriksaan::class, 'no_cm', 'no_cm');
    }
    public function history_last()
    {
        return $this->hasOne(Pemeriksaan::class, 'no_cm', 'no_cm')->latest();
    }
}
