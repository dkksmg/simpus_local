<?php

namespace App\Models;

use App\Models\Faskes\Poli;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemeriksaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_kunjungan', 'kode_faskes', 'id_condition', 'id_obs_nadi', 'id_obs_napas', 'id_obs_sistole', 'id_obs_diastole', 'id_obs_suhu', 'no_cm', 'tgl_kunjungan', 'poli', 'dokter', 'anamnesa', 'kesadaran', 'sistolik', 'diastolik', 'suhu', 'tb', 'bb', 'imt', 'respiratory_rate', 'heart_rate', 'lingkar_perut', 'pemeriksaan_fisik', 'pertemuan', 'diag1', 'diag2', 'diag3', 'diag4', 'tindakan1', 'tindakan2', 'tindakan3', 'tindakan', 'obat', 'edukasi', 'status_pasien', 'rujukan', 'imt'
    ];

    public function detail_kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan', 'id_kunjungan');
    }
    public function detail_faskes()
    {
        return $this->belongsTo(Faskes::class, 'kode_faskes', 'kode_faskes');
    }
    public function detail_poli()
    {
        return $this->belongsTo(Poli::class, 'poli', 'kode_poli');
    }
    public function detail_pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_cm', 'no_cm');
    }
}
