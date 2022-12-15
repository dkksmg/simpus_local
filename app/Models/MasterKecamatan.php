<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKecamatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['kota_id', 'kecamatan'];

    public function nama_kelurahan()
    {
        return $this->hasMany(MasterKelurahan::class, 'id', 'kecamatan_id');
    }
}