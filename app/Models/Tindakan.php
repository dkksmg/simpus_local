<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tindakan extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'kode_faskes', 'kode_tindakan', 'detail_tindakan', 'tarif_tindakan'
    ];

    public function detail_faskes()
    {
        return $this->belongsTo(Faskes::class, 'kode_faskes', 'kode_faskes');
    }
}