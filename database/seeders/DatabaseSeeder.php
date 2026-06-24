<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Branch;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin kullanıcısı
        User::updateOrCreate(
            ['email' => 'admin@eserspor.com'],
            [
                'name'     => 'Eser Spor Admin',
                'password' => env('ADMIN_PASSWORD', 'admin123456'),
            ]
        );

        // Branşlar
        $branches = [
            ['name' => 'Futbol',   'slug' => 'futbol',   'icon' => '⚽', 'sort_order' => 1],
            ['name' => 'Voleybol', 'slug' => 'voleybol', 'icon' => '🏐', 'sort_order' => 2],
            ['name' => 'Halter',   'slug' => 'halter',   'icon' => '🏋️', 'sort_order' => 3],
        ];

        foreach ($branches as $branch) {
            Branch::firstOrCreate(
                ['slug' => $branch['slug']],
                [...$branch, 'is_active' => true]
            );
        }

        $this->command->info('✅ Seeder başarıyla tamamlandı!');
    }
}