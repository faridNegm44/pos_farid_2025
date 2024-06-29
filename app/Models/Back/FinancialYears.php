<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialYears extends Model
{
    protected $table = 'financial_years';
    protected $fillable = ['name', 'start', 'end', 'status', 'notes'];
}
