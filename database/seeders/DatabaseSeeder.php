<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use App\Models\Task;
use App\Models\User;
use Database\Factories\CategoryFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([AdminSeeder::class]);

        // User::factory(10)->create();
        // User::factory()->count(100)->create();
        // Product::factory()->count(100)->create();
        // Material::factory()->count(10)->create();
        // Task::factory()->count(100)->create();
        // Category::factory()->count(10)->create();
    }
}
