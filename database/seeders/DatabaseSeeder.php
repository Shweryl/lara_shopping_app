<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Veryl',
            'email' => 'veryl@gmail.com',
            'password' => Hash::make('veryl123')
        ]);

        $this->call([
            CategorySeeder::class,
        ]);

        Product::factory(10)->create();
    }
}
