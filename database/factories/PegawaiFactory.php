<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $kemampuan = ['HTML', 'CSS', 'JavaScript', 'PHP', 'Python'];
        $file1 = 'public/files/file1.jpg';
        $file2 = 'public/files/file2.pdf';

        return [
            'name' => fake()->name(),
            'tanggal_aktif' => fake()->date(),
            'kemampuan' => $kemampuan[array_rand($kemampuan)],
            'files' => json_encode([$file1, $file2])

        ];
    }
}
