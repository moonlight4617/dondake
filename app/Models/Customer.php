<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kana',
        'tel',
        'email',
        'postcode',
        'address',
        'birthday',
        'gender',
        'memo',
    ];

    /**
     * カナ、電話番号で絞り込み検索できる機能実装
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchCustomer($query, $input)
    {
        if (empty($input)) return;
        if (Customer::where('kana', 'like', $input . '%')
            ->orWhere('tel', 'like', $input . '%')->exists()
        ) {
            return $query
                ->where('kana', 'like', $input . '%')
                ->orWhere('tel', 'like', $input . '%');
        }
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
