<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pestisida Serangga'],
            ['name' => 'Pestisida Wereng'],
            ['name' => 'Pestisida Belalang'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $products = [
            [
                'product_name' => 'DESTAN 400 EC',
                'price' => 10000,
                'stock' => 10,
                'weight' => 500,
                'image_path' => 'products/1733713723.jpg',
                'description' => 'Description for product 1',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 1,
            ],
            [
                'product_name' => 'DURSBAN 480 EC',
                'price' => 20000,
                'stock' => 20,
                'weight' => 1000,
                'image_path' => 'products/1733715757.jpg',
                'description' => 'Description for product 2',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 1,
            ],
            [
                'product_name' => 'KOZIMA 500 SC',
                'price' => 15000,
                'stock' => 15,
                'weight' => 750,
                'image_path' => 'products/1733883031.jpg',
                'description' => 'Description for product 3',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 2,
            ],
            [
                'product_name' => 'OXAR 500 SC',
                'price' => 25000,
                'stock' => 25,
                'weight' => 1250,
                'image_path' => 'products/1733897494.jpg',
                'description' => 'Description for product 4',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 2,
            ],
            [
                'product_name' => 'NEEM OIL 1000 EC',
                'price' => 30000,
                'stock' => 30,
                'weight' => 1500,
                'image_path' => 'products/1734059564.jpg',
                'description' => 'Description for product 5',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 1,
            ],
            [
                'product_name' => 'BIOCRON 1000 EC',
                'price' => 35000,
                'stock' => 35,
                'weight' => 1750,
                'image_path' => 'products/1734059718.jpg',
                'description' => 'Description for product 6',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 3,
            ],
            [
                'product_name' => 'SIDATAN 410 SL',
                'price' => 40000,
                'stock' => 40,
                'weight' => 2000,
                'image_path' => 'products/1734078230.jpg',
                'description' => 'Description for product 7',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 3,
            ],
            [
                'product_name' => 'PESTONA 500 SC',
                'price' => 45000,
                'stock' => 45,
                'weight' => 2250,
                'image_path' => 'products/1734175984.jpg',
                'description' => 'Description for product 8',
                'created_by' => '6219796d-c5c7-4956-9fa2-373ecac15df8',
                'discontinued' => 0,
                'category_id' => 3,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}