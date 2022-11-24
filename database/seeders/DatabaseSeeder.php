<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        \App\Models\User::factory()->create([
            'name' => 'Ardian Firman',
            'email' => 'contact.ardianff@gmail.com',
            'email_verified_at' => 'now',
            'password' => bcrypt('ardian123@'),
        ]);
        $this->call(KecamatanSeeder::class);
        $this->call(KelurahanSeeder::class);
    }
}