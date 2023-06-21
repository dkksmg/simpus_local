<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nakes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_faskes', 'kode_nakes', 'kode_nakes_lama', 'nama_nakes', 'jabatan_nakes', 'status'
    ];

    public function detail_faskes()
    {
        return $this->belongsTo(Faskes::class, 'kode_faskes', 'kode_faskes');
    }
    public function detail_jabatan()
    {
        return $this->belongsTo(JabatanNakes::class, 'jabatan_nakes', 'id');
    }
}
