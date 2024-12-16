<?php

namespace Database\Seeders;

use App\Enums\UserStatusEnums;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'اويس صبري',
            'email' => 'owis@granadapride.com',
            'password' => Hash::make('123456789'),
            'status' => UserStatusEnums::Active,
        ]);

        User::query()->create([
            'name' => 'عمرو',
            'email' => 'amro@granadapride.com',
            'password' => Hash::make('123456789'),
            'status' => UserStatusEnums::Active,
        ]);

        User::query()->create([
            'name' => 'محمد',
            'email' => 'mohamed@granadapride.com',
            'password' => Hash::make('123456789'),
            'status' => UserStatusEnums::Active,
        ]);

        User::query()->create([
            'name' => 'احمد',
            'email' => 'ahmed@granadapride.com',
            'password' => Hash::make('123456789'),
            'status' => UserStatusEnums::Active,
        ]);
    }
}
