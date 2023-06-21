<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKecamatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['kode_provinsi', 'kode_kotakab', 'kode_kecamatan', 'nama'];

    public function nama_kelurahan()
    {
        return $this->hasMany(MasterKelurahan::class, 'id', 'kecamatan_id');
    }
}
