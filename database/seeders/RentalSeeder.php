<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rental;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $customer = Customer::first();
        $item = Item::first();

        Rental::create([
            'customer_id' => $customer->customer_id,
            'item_id' => $item->item_id,
            'rent_date' => now(),
            'return_date' => now()->addDays(3),
            'total_price' => $item->price_per_day * 3,
            'status' => 'rented'
        ]);
    }
}
