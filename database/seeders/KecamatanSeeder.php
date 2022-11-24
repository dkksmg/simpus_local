<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatan = [
            ['nama_kecamatan' => "Banyumanik", "kode_kecamatan" => "337411"],
            ['nama_kecamatan' => "Candisari", "kode_kecamatan" => "337408"],
            ['nama_kecamatan' => "Gajah Mungkur", "kode_kecamatan" => "337409"],
            ['nama_kecamatan' => "Gayamsari", "kode_kecamatan" => "337404"],
            ['nama_kecamatan' => "Genuk", "kode_kecamatan" => "337405"],
            ['nama_kecamatan' => "Gunungpati", "kode_kecamatan" => "337412"],
            ['nama_kecamatan' => "Mijen", "kode_kecamatan" => "337414"],
            ['nama_kecamatan' => "Ngaliyan", "kode_kecamatan" => "337415"],
            ['nama_kecamatan' => "Pedurungan", "kode_kecamatan" => "337406"],
            ['nama_kecamatan' => "Semarang Barat", "kode_kecamatan" => "337413"],
            ['nama_kecamatan' => "Semarang Selatan", "kode_kecamatan" => "337407"],
            ['nama_kecamatan' => "Semarang Tengah", "kode_kecamatan" => "337401"],
            ['nama_kecamatan' => "Semarang Timur", "kode_kecamatan" => "337403"],
            ['nama_kecamatan' => "Semarang Utara", "kode_kecamatan" => "337402"],
            ['nama_kecamatan' => "Tembalang", "kode_kecamatan" => "337410"],
            ['nama_kecamatan' => "Tugu", "kode_kecamatan" => "337416"],
        ];
        foreach ($kecamatan as $kec) {
            Kecamatan::create($kec);
        }
    }
}