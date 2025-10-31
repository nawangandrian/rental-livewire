<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::create([
            'item_name' => 'Proyektor',
            'category' => 'Elektronik',
            'stock' => 5,
            'price_per_day' => 50000,
            'description' => 'Proyektor untuk presentasi',
            'is_available' => true
        ]);

        Item::create([
            'item_name' => 'Kamera DSLR',
            'category' => 'Elektronik',
            'stock' => 3,
            'price_per_day' => 150000,
            'description' => 'Kamera DSLR profesional',
            'is_available' => true
        ]);
    }
}
