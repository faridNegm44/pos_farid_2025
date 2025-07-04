<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraExpense extends Model
{
    protected $table = 'extra_expenses';
    protected $fillable = [
        'expense_type', 'amount', 'notes'
    ];
}
