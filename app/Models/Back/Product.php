<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'shortCode', 'natCode', 'nameAr', 'nameEn', 'store', 'company', 'category', 'stockAlert', 'divisible', 'sellPrice', 'purchasePrice', 'discountPercentage', 'tax', 'quantity', 'firstPeriodCount', 'bigUnit', 'smallUnit', 'smallUnitPrice', 'smallUnitNumbers', 'status', 'image', 'desc', 'offerDiscountStatus', 'offerDiscountPercentage', 'offerStart', 'offerEnd'
    ];
}
