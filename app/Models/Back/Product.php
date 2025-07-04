<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'shortCode', 'natCode', 'nameAr', 'nameEn', 'store', 'company', 'category', 'stockAlert', 'divisible', 'sellPrice', 'purchasePrice', 'discountPercentage', 'tax', 'firstPeriodCount', 'bigUnit', 'smallUnit', 'smallUnitPrice', 'smallUnitNumbers', 'max_sale_quantity', 'status', 'image', 'desc', 'offerDiscountStatus', 'offerDiscountPercentage', 'offerStart', 'offerEnd', 'prod_tax', 'prod_discount'
    ];
}