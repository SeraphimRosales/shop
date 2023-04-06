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
        Product::create(
            [
            'user_id' => 1,
            'product_name' => "Classic Denim",
            'price' => 499.57,
            'img' => 'fab.png'
            ]
            );
    }
}
