<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id'; // <-- tambahkan ini

    protected $fillable = ['item_name', 'category', 'stock', 'price_per_day', 'description', 'is_available'];
}
