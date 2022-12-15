<?php

namespace Database\Seeders;

use App\Models\Kesadaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KesadaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kesadaran = [
            ["kode_kesadaran" => "A01", "nama_kesadaran" => "Compos Mentis", "status" => "active"],
            ["kode_kesadaran" => "A02", "nama_kesadaran" => "Somnolence", "status" => "active"],
            ["kode_kesadaran" => "A03", "nama_kesadaran" => "Sopor", "status" => "active"],
            ["kode_kesadaran" => "A04", "nama_kesadaran" => "Coma", "status" => "active"],
            ["kode_kesadaran" => "A05", "nama_kesadaran" => "Sadar", "status" => "active"],
        ];
        foreach ($kesadaran as $kes) {
            Kesadaran::create($kes);
        }
    }
}