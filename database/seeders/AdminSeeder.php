<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'tubagusisnaeni@gmail.com',
        ], [
            'name' => 'Tubagus Mochamad Isnaeni',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'phone' => '085959880656',
        ]);

        User::updateOrCreate([
            'email' => 'isnan@gmail.com',
        ], [
            'name' => 'Isnan Setiadi',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'phone' => '085156460402',
        ]);

        User::updateOrCreate([
            'email' => 'admin2@example.com',
        ], [
            'name' => 'Admin Kedua',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Kasir Satu',
            'email' => 'kasir1@example.com',
            'password' => Hash::make('kasir1234'),
            'role' => 'kasir',
            'phone' => '081111111111',
        ]);

        User::create([
            'name' => 'Kasir Dua',
            'email' => 'kasir2@example.com',
            'password' => Hash::make('kasir1234'),
            'role' => 'kasir',
            'phone' => '082222222222',
        ]);

        User::create([
            'name' => 'Kasir Tiga',
            'email' => 'kasir3@example.com',
            'password' => Hash::make('kasir1234'),
            'role' => 'kasir',
            'phone' => '083333333333',
        ]);
    }
}
