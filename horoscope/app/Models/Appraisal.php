<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use HasFactory;

    const PRICE = 8800; // 鑑定の金額
    const PRICE_SOLAR = 7700; // 鑑定の金額
    const PRICE_FLAG_FALSE = 0; // 鑑定金額のフラグ_なし

    const PRICE_FLAG_TRUE = 1; // 鑑定金額のフラグ_あり
    const SOLAR_FLAG_FLASE = 0;  //Solar
    const SOLAR_FLAG_TRUE = 1; //Solar
    protected $guarded = [];

    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price);
    }
}
