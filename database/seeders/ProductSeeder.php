<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
           [
               'code' => 'R01',
               'title' => 'Red Widget',
               'price' => '32.95',
           ],
            [
                'code' => 'G01',
                'title' => 'Green Widget',
                'price' => '24.95',
            ],
            [
                'code' => 'B01',
                'title' => 'Blue Widget',
                'price' => '7.95',
            ]
        ];

        foreach ($products AS $product){
            Product::insertOrIgnore([
                'code' => $product['code'],
                'title' => $product['title'],
                'price' => $product['price'],
            ]);
        }
    }
}
