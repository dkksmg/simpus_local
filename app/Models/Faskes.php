<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faskes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_faskes', 'id_ihs_org',
        'id_faskes_respons', 'nama_faskes', 'email_faskes', 'phone_faskes', 'fax_faskes', 'url_faskes', 'nama_pimpinan', 'alamat_faskes', 'district', 'village', 'postal_code', 'koordinat', 'kecamatan', 'kelurahan', 'status', 'phone_pj', 'ijin_terbit', 'ijin_berakhir', 'no_ijin', 'jadwal', 'jenis', 'layanan'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'district', 'id');
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'village', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'kode_faskes', 'kode_faskes');
    }
    public function detail_jenis()
    {
        return $this->belongsTo(JenisKlinik::class, 'jenis', 'id');
    }
    public function detail_layanan()
    {
        return $this->belongsTo(PelayananKlinik::class, 'layanan', 'id');
    }
}
