<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Tạo các danh mục gốc
         $iphone = Category::create([
            'ten_dm' => 'Iphone',
            'slug' => 'iphone',
            'parent_id' => null,
        ]);

        $samsung = Category::create([
            'ten_dm' => 'Samsung',
            'slug' => 'samsung',
            'parent_id' => null,
        ]);

        $nokia = Category::create([
            'ten_dm' => 'Nokia',
            'slug' => 'nokia',
            'parent_id' => null,
        ]);

        $oppo = Category::create([
            'ten_dm' => 'Oppo',
            'slug' => 'oppo',
            'parent_id' => null,
        ]);

        $xiaomi = Category::create([
            'ten_dm' => 'Xiaomi',
            'slug' => 'xiaomi',
            'parent_id' => null,
        ]);

        // Tạo các danh mục con
        Category::create([
            'ten_dm' => 'Samsung Galaxy S',
            'slug' => 'samsung-galaxy-s',
            'parent_id' => $samsung->id,
        ]);

        Category::create([
            'ten_dm' => 'Samsung Galaxy Note',
            'slug' => 'samsung-galaxy-note',
            'parent_id' => $samsung->id,
        ]);

        Category::create([
            'ten_dm' => 'Samsung Galaxy A',
            'slug' => 'samsung-galaxy-a',
            'parent_id' => $samsung->id,
        ]);

        Category::create([
            'ten_dm' => 'Iphone X',
            'slug' => 'iphone-x',
            'parent_id' => $iphone->id,
        ]);

        Category::create([
            'ten_dm' => 'Iphone 13',
            'slug' => 'iphone-13',
            'parent_id' => $iphone->id,
        ]);

        Category::create([
            'ten_dm' => 'Iphone 14',
            'slug' => 'iphone-14',
            'parent_id' => $iphone->id,
        ]);

        Category::create([
            'ten_dm' => 'Iphone 15',
            'slug' => 'iphone-15',
            'parent_id' => $iphone->id,
        ]);
    }
}
