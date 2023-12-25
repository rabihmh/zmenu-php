<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Appetizers 🍟',
            'Breakfast',
            'Salad 🥗',
            'Pizza 🍕',
            'Pasta 🍝',
            'Regular Meals 🍴',
            'Platters 🍽',
            'وجبات مقطعة 🍱',
            'Sandwiches 🥪',
            'Diet Meals',
            'Kids Meals',
            'Shawarma',
            'Burgers 🍔',
            'Special Burgers 🍔',
            'Cake 🍰',
            'Ice Cream 🍦',
            'Crepe 🧇',
            'Shake & Frappe & Smoothies 🍹',
            'Cold Drinks 🍷',
            'Hot Drinks ☕',
            'SHISHA',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
        }
    }

}
