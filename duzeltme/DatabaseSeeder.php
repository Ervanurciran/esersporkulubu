<?php

// BU DOSYAYI: database/seeders/DatabaseSeeder.php ile REPLACE ET

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Branch;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // HATA 1 DÜZELTME: create() -> firstOrCreate() (duplicate entry önlemek için)
        // HATA 2 DÜZELTME: Hash::make() YOK — User modelinde 'hashed' cast var, otomatik hash'liyor.
        //                   Hash::make() yazarsan çift hash olur, login çalışmaz.
        User::updateOrCreate(
            ['email' => 'admin@eserspor.com'],
            [
                'name'     => 'Eser Spor Admin',
                'password' => env('ADMIN_PASSWORD', 'admin123456'),
            ]
        );

        // HATA 1 DÜZELTME: create() -> firstOrCreate()
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
