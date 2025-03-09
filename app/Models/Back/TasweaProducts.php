<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasweaProducts extends Model
{
    protected $table = 'taswea_products';
    protected $fillable = ['product_id', 'quantity', 'reason_id', 'user_id', 'notes'];
}