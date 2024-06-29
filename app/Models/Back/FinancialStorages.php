<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialStorages extends Model
{
    protected $table = 'financial_storages';
    protected $fillable = ['name', 'userOne', 'userTwo', 'userThree', 'moneyFirstDuration', 'status', 'notes'];
}
