<?php

namespace App\Models;

use App\Models\Kelurahan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_kecamatan'
    ];
    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class, 'id_kecamatan', 'id');
    }
}