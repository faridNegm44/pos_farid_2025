<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTreasury extends Model
{
    use HasFactory;
    protected $table = 'financial_treasuries';
    protected $fillable = ['name', 'userOne', 'moneyFirstDuration', 'status', 'notes'];
}
