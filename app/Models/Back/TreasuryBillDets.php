<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryBillDets extends Model
{
    use HasFactory;
    protected $table = 'treasury_bill_dets';
    protected $fillable = ['num_order', 'date', 'treasury_id', 'treasury_type', 'bill_id', 'bill_type', 'client_supplier_id', 'money', 'value', 'transaction_from', 'transaction_to', 'notes', 'user_id', 'year_id'];
}
