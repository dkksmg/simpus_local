<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_kecamatan',
        'nama_kelurahan',
        'kode_pos',
    ];
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id', 'id_kecamatan');
    }
}