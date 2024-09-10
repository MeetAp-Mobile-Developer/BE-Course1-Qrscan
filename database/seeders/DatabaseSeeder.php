<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nama' => 'Panitia',
            'username' => 'panitia',
            'password' => Hash::make('panitia'),
        ]);

        User::factory()->create([
            'nama' => 'Vendor',
            'username' => 'vendor',
            'password' => Hash::make('vendor'),
        ]);

        $this->call(ScanSeeder::class);
    }
}
