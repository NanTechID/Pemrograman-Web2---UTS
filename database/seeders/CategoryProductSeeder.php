<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $catalog = [
            'Minuman' => [
                ['name' => 'Air Mineral 600ml', 'price' => 4000, 'stock' => 120],
                ['name' => 'Teh Botol', 'price' => 5500, 'stock' => 90],
                ['name' => 'Jus Jeruk', 'price' => 9000, 'stock' => 70],
                ['name' => 'Kopi Susu', 'price' => 12000, 'stock' => 65],
                ['name' => 'Es Coklat', 'price' => 11000, 'stock' => 80],
            ],
            'Makanan' => [
                ['name' => 'Nasi Goreng Spesial', 'price' => 25000, 'stock' => 45],
                ['name' => 'Mie Goreng', 'price' => 18000, 'stock' => 50],
                ['name' => 'Ayam Geprek', 'price' => 22000, 'stock' => 40],
                ['name' => 'Sate Ayam', 'price' => 28000, 'stock' => 35],
                ['name' => 'Sop Ayam', 'price' => 20000, 'stock' => 30],
            ],
            'Snack' => [
                ['name' => 'Keripik Kentang', 'price' => 10000, 'stock' => 95],
                ['name' => 'Kacang Panggang', 'price' => 8000, 'stock' => 100],
                ['name' => 'Roti Coklat', 'price' => 7000, 'stock' => 85],
                ['name' => 'Biskuit Keju', 'price' => 9000, 'stock' => 75],
                ['name' => 'Donat Gula', 'price' => 6000, 'stock' => 70],
            ],
            'Sembako' => [
                ['name' => 'Beras 5kg', 'price' => 78000, 'stock' => 25],
                ['name' => 'Gula Pasir 1kg', 'price' => 18000, 'stock' => 60],
                ['name' => 'Minyak Goreng 1L', 'price' => 21000, 'stock' => 55],
                ['name' => 'Tepung Terigu 1kg', 'price' => 13000, 'stock' => 50],
                ['name' => 'Telur Ayam 1kg', 'price' => 29000, 'stock' => 40],
            ],
            'Kebersihan' => [
                ['name' => 'Sabun Mandi', 'price' => 6500, 'stock' => 110],
                ['name' => 'Shampo 170ml', 'price' => 17500, 'stock' => 75],
                ['name' => 'Pasta Gigi', 'price' => 12000, 'stock' => 85],
                ['name' => 'Deterjen 800gr', 'price' => 19000, 'stock' => 65],
                ['name' => 'Pembersih Lantai', 'price' => 14000, 'stock' => 70],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');

            if (!$categoryId) {
                $categoryId = DB::table('categories')->insertGetId([
                    'name' => $categoryName,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            foreach ($products as $product) {
                $existingId = DB::table('products')
                    ->where('category_id', $categoryId)
                    ->where('name', $product['name'])
                    ->value('id');

                if ($existingId) {
                    DB::table('products')->where('id', $existingId)->update([
                        'price' => $product['price'],
                        'stock' => $product['stock'],
                        'updated_at' => $now,
                    ]);
                } else {
                    DB::table('products')->insert([
                        'name' => $product['name'],
                        'category_id' => $categoryId,
                        'price' => $product['price'],
                        'stock' => $product['stock'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
