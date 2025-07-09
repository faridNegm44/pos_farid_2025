<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseBillDets extends Model
{
    use HasFactory;
    protected $table = 'purchase_bills';
    protected $fillable = ['receipt_number', 'client_id', 'amount', 'amount_in_words', 'payment_type', 'cheque_number', 'cheque_bank', 'cheque_date', 'receipt_date','status', 'notes', 'user_id'];
}
