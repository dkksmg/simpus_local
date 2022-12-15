<?php

namespace Database\Seeders;

use App\Models\StatusPulang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPulangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ["kode_status" => "planned", "nama_status" => "Sudah Direncanakan", "status" => "active"],
            ["kode_status" => "arrived", "nama_status" => "Sudah Datang", "status" => "active"],
            ["kode_status" => "triaged", "nama_status" => "Triase", "status" => "active"],
            ["kode_status" => "in-progress", "nama_status" => "Sedang Berlangsung", "status" => "active"],
            ["kode_status" => "onleave", "nama_status" => "Sedang Pergi", "status" => "active"],
            ["kode_status" => "finished", "nama_status" => "Sudah Selesai", "status" => "active"],
            ["kode_status" => "cancelled", "nama_status" => "Dibatalkan", "status" => "active"],
            ["kode_status" => "outpatient", "nama_status" => "Berobat Jalan", "status" => "active"],
            ["kode_status" => "next-reference", "nama_status" => "Rujuk Lanjut", "status" => "active"],
            ["kode_status" => "intern-reference", "nama_status" => "Rujuk Internal", "status" => "active"],
        ];
        foreach ($status as $kes) {
            StatusPulang::create($kes);
        }
    }
}