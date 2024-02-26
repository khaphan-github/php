<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rau Xanh',
                'icon' => 'https://example.com/icons/vegetables.png',
                'parent_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Củ',
                'icon' => 'https://example.com/icons/root_vegetables.png',
                'parent_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quả',
                'icon' => 'https://example.com/icons/fruits.png',
                'parent_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('category')->insert($categories);
    }
}
