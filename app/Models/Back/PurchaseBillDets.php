<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseBillDets extends Model
{
    use HasFactory;
    protected $table = 'purchase_bills';
    protected $fillable = ['type', 'num_order', 'custom_bill_num', 'supplier_id', 'treasury_id', 'custom_date', 'user_id', 'year_id', 'notes'];
}
