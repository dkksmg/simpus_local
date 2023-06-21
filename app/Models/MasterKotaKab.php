<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKotaKab extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['kode_provinsi', 'kode_kotakab', 'nama'];

    public function nama_kecamatan()
    {
        return $this->hasMany(MasterKecamatan::class, 'id', 'kota_id');
    }
}
