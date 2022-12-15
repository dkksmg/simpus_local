<?php

namespace App\Models;

use App\Models\Faskes\Poli;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kunjungan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_kunjungan', 'kode_faskes', 'no_cm', 'id_encounter', 'no_ihs', 'tgl_kunjungan', 'poli', 'dokter', 'status_pasien', 'status_kunjungan', 'start', 'cara_bayar'
    ];

    public function detail_faskes()
    {
        return $this->belongsTo(Faskes::class, 'kode_faskes', 'kode_faskes');
    }
    public function detail_pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_cm', 'no_cm');
    }
    public function detail_poli()
    {
        return $this->belongsTo(Poli::class, 'poli', 'kode_poli');
    }
    public function detail_pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class, 'id_kunjungan', 'kode_kunjungan');
    }
}