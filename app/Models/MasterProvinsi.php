<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterProvinsi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['provinsi'];

    public function nama_kotakab()
    {
        return $this->hasMany(MasterKotaKab::class, 'id', 'provinsi_id');
    }
}