<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_faskes', 'kode_obat', 'kode_obat_lama', 'nama_obat', 'jenis_obat', 'pabrik_obat', 'dosis_obat', 'tarif_obat'
    ];

    public function detail_faskes()
    {
        return $this->belongsTo(Faskes::class, 'kode_faskes', 'kode_faskes');
    }
}
