<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\KontrakanSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User default
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 🔥 PANGGIL SEEDER KONTRAKAN
        $this->call([
            KontrakanSeeder::class,
        ]);
    }
}