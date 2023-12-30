<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'sale_price',
        'quantity',
        'sale_cost',
        'sale_date',
        'temperature',
        'weather',
    ];
}
