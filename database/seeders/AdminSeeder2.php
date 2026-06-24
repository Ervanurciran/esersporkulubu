<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder2 extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('admin.secondary.email')],
            [
                'name' => config('admin.secondary.name'),
                'password' => config('admin.secondary.password'),
            ]
        );
    }
}
