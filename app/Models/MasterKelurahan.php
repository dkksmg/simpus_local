<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKelurahan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['kode_provinsi', 'kode_kotakab', 'kode_kecamatan', 'kode_kelurahan', 'nama'];

    public function nama_kecamatan()
    {
        return $this->belongsToMany(MasterKecamatan::class, 'kecamatan_id', 'id');
    }
}
