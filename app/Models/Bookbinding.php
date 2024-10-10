<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookbinding extends Model
{
    use HasFactory;

    const NO_BOOKBINDING = 0; // 製本なし

    const BOOKBINDING = 1; // 製本あり

    const UNDELIVERED = 0; // 未発送

    const DELIVERED = 1; // 発送済み

    const PRICE = 3800; // 製本の金額

    const PRICE_FLAG_FALSE = 0; // 製本金額のフラグ_なし

    const PRICE_FLAG_TRUE = 1; // 製本金額のフラグ_あり

    //Solar Return
    const PRICE_SOLAR = 3300;

    const SOLAR_FLAG_FALSE = 0;

    const SOLAR_FLAG_TRUE = 1;

    protected $guarded = [];

    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price);
    }
}
