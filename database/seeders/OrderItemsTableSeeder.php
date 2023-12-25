<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderItem::factory(100)->create();
    }
}
