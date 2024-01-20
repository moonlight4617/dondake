<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class Temperature extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_date',
        'temperature',
        'weather',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
