<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\category;
use App\Models\Product;
use App\Models\store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        admin::factory(3)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // store::factory(5)->create();
        // category::factory(10)->create();
        // Product::factory(100)->create();

        // $this->call(UserSeeder::class);

       
    }
}
