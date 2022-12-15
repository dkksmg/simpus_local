<?php

namespace App\Models\Faskes;

use App\Models\Faskes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_faskes', 'kode_poli', 'kode_location_poli', 'nama_poli', 'status'
    ];

    public function detail_faskes()
    {
        return $this->belongsTo(Faskes::class, 'kode_faskes', 'kode_faskes');
    }
}