<?php

namespace Database\Seeders;

use App\Models\JabatanNakes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            ["nama_jabatan" => "Dokter", "status" => "active"],
            ["nama_jabatan" => "Perawat", "status" => "active"],
            ["nama_jabatan" => "Bidan", "status" => "active"],
            ["nama_jabatan" => "Admin", "status" => "active"],
        ];
        foreach ($jabatan as $jab) {
            JabatanNakes::create($jab);
        }
    }
}