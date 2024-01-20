<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Temperature;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'temperature_id',
        'sale_price',
        'quantity',
        'sale_cost',
    ];

    public function temperature()
    {
        return $this->belongsTo(Temperature::class);
    }
}
