<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                 'name' => 'Pelanggan Umum',
                 'phone' => '0811111111',
                 'email' => null,
                 'address' => null,
                 'created_at' => now(),
                 'updated_at' => now(),
                 'customer_type' => 'Umum',
            ],
            [
                 'name' => 'Pelanggan Member',
                 'phone' => '0822222222',
                 'email' => null,
                 'address' => null,
                 'created_at' => now(),
                 'updated_at' => now(),
                 'customer_type' => 'Member',
            ],
            [
                 'name' => 'Pelanggan Reseller',
                 'phone' => '0833333333',
                 'email' => null,
                 'address' => null,
                 'created_at' => now(),
                 'updated_at' => now(),
                 'customer_type' => 'Reseller',
            ],
        ]);
    }
}
