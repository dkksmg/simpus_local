<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Helpers\Helpers;
use App\Models\Faskes;
use App\Models\JabatanNakes;
use Illuminate\Database\Seeder;
use Database\Seeders\KecamatanSeeder;
use Database\Seeders\KelurahanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(JabatanSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(KelurahanSeeder::class);
        $kode = Helpers::KodeFaskes(1);
        User::factory()->create([
            'name' => 'Ardian Firman',
            'email' => 'contact.ardianff@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('ardian123@'),
            'role' => 'ADMIN',
            'kode_faskes' => '12345'
        ]);
        User::factory()->create([
            'name' => 'Klinik Materdei',
            'email' => 'klinik.materdei@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('33742211012'),
            'role' => 'KLINIK',
            'kode_faskes' => 33742211012
        ]);
        Faskes::factory()->create([
            'kode_faskes' => 33742211012,
            'nama_faskes' => 'Klinik Materdei',
            'nama_pimpinan' => 'drg. Kresentia Yusticia Hati Jelita',
            'no_ijin' => '076/445/K.Pratama/BPPT/XII/2016',
            'alamat_faskes' => 'Dinar Elok',
            'district' => 1,
            'village' => 1,
            'rt/rw' => '05/22',
            'postal_code' => 50261
        ]);
        Faskes::factory()->create([
            'kode_faskes' => '12345',
            'nama_faskes' => 'Klinik Admin',
            'nama_pimpinan' => 'Ardian',
            'no_ijin' => 'A12121',
            'alamat_faskes' => 'Dinar Elok',
            'district' => 1,
            'village' => 1,
            'rt/rw' => '05/22',
            'postal_code' => 50261
        ]);
    }
}