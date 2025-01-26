<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDets extends Model
{
    protected $table = 'store_dets';
    protected $fillable = ['type', 'year_id', 'bill_head_id', 'bill_body_id', 'product_id', 'product_num_unit', 'quantity', 'quantity_all', 'product_sellPrice', 'product_purchasePrice', 'product_avg', 'transfer_from', 'transfer_to', 'transfer_quantity', 'date'];
}