<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'cost',
        'memo',
    ];

    // public function purchases()
    // {
    //     return $this->belongsToMany(Purchase::class)->withPivot('quantity');
    // }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
