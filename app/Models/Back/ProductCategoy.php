<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoy extends Model
{
    protected $table = 'product_categoys';
    protected $fillable = ['name'];
}
