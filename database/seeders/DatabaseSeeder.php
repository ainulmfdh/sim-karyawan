<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat User untuk Login
        User::factory()->create([
            'name' => 'Ainul',
            'email' => 'ainul@gmail.com',
            'password' => Hash::make('ainul123'),
        ]);

        // Jalankan Seeder Karyawan
        $this->call([
            EmployeeSeeder::class,
        ]);
    }
}
