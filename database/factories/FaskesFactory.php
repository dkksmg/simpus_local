<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faskes>
 */
class FaskesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_faskes' => fake()->name(),
            'nama_faskes' => fake()->unique()->safeEmail(),
            'nama_pimpinan' => now(),
            'no_ijin' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'alamat_faskes' => Str::random(10),
            'district' => Str::random(10),
            'village' => Str::random(10),
            'rt/rw' => Str::random(10),
            'postal_code' => Str::random(10),
        ];
    }
}