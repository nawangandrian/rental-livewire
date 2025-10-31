<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // Primary key
    protected $primaryKey = 'rental_id';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'customer_id',
        'item_id',
        'rent_date',
        'return_date',
        'total_price',
        'status'
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi ke Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
