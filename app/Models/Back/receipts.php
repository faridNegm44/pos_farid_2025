<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipts extends Model
{
    use HasFactory;
    protected $table = 'receipts';
    protected $fillable = ['payer_type', 'payer_id', 'amount', 'amount_in_words', 'payment_type', 'cheque_number', 'cheque_bank', 'cheque_date', 'receipt_date', 'status', 'notes', 'user_id'];
}
