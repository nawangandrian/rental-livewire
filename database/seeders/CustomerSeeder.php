<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create([
            'name' => 'John Doe',
            'phone' => '08123456789',
            'email' => 'john@example.com',
            'address' => 'Jl. Contoh 123'
        ]);

        Customer::create([
            'name' => 'Jane Smith',
            'phone' => '08987654321',
            'email' => 'jane@example.com',
            'address' => 'Jl. Contoh 456'
        ]);
    }
}
