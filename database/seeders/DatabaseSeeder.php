<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // Disable foreign key checks for faster inserts
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Seed categories and subcategories
        $categoryData =
            [
                [
                    'name' => 'Electronics',
                    'depth' => 1,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'name' => 'Laptops',
                    'parent_id' => 1,
                    'depth' => 2,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],

                [
                    'name' => 'Phones',
                    'parent_id' => 1,
                    'depth' => 2,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],

                [
                    'name' => 'Clothing',
                    'depth' => 1,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'name' => 'Shirts',
                    'parent_id' => 4,
                    'depth' => 2,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],

                [
                    'name' => 'Pants',
                    'parent_id' => 4,
                    'depth' => 2,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],
            ];

        foreach ($categoryData as $category) {
            Category::create($category);
        }

        // Seed items
        $itemData = [
            [
                'name' => 'Gaming Laptop',
                'description' => 'Powerful laptop for gamers',
                'price' => 1500.00,
                'category_id' => 1, // Electronics -> Laptops (assuming ID from previous inserts)
            ],
            [
                'name' => 'Smartphone',
                'description' => 'Latest smartphone with advanced features',
                'price' => 800.00,
                'category_id' => 3, // Electronics -> Phones
            ],
            [
                'name' => 'T-Shirt',
                'description' => 'Comfortable and stylish shirt',
                'price' => 20.00,
                'category_id' => 5, // Clothing -> Shirts
            ],
        ];

        foreach ($itemData as $item) {
            Item::create($item);
        }

       
        // Discount::create([
        //     'name' => 'All Menu Discount',
        //     'percentage' => 10, // 10% discount
        //     'type' => 'all_menu',
        //     'discountable_id' => null,
        //     'discountable_type' => null,
        // ]);

        // Category/Subcategory Discount
        Discount::create([
            'name' => 'Category/Subcategory Discount',
            'percentage' => 5, // 5% discount
            'type' => 'category',
            'discountable_id' => 1,
            'discountable_type' => 'App\Models\Category',
        ]);

        // Item Discount
        Discount::create([
            'name' => 'Item Discount',
            'percentage' => 15, // 15% discount
            'type' => 'item',
            'discountable_id' => 1,
            'discountable_type' => 'App\Models\Item',
        ]);
    
    }
}
