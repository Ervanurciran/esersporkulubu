<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Branch;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin kullanıcısı
        User::create([
            'name'     => 'Eser Spor Admin',
            'email'    => 'admin@eserspor.com',
            'password' => Hash::make('admin123456'),
        ]);

        // Branşlar
        $branches = [
            ['name' => 'Futbol',   'slug' => 'futbol',   'icon' => '⚽', 'sort_order' => 1],
            ['name' => 'Voleybol', 'slug' => 'voleybol', 'icon' => '🏐', 'sort_order' => 2],
            ['name' => 'Halter',   'slug' => 'halter',   'icon' => '🏋️', 'sort_order' => 3],
        ];

        foreach ($branches as $branch) {
            Branch::create(array_merge($branch, ['is_active' => true]));
        }
    }
}