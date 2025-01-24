<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TreasuryBillsController extends Controller
{
    public function index()
    {                   
        $pageNameAr = 'أجراء معاملة في الخزينة المالية';
        $pageNameEn = 'treasury_bills';
        
        return view('back.treasury_bills.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create()
    {                               
        $pageNameAr = 'أجراء معاملة في الخزينة المالية';
        $pageNameEn = 'treasury_bills';
        return view('back.treasury_bills.create' , compact('pageNameAr' , 'pageNameEn'));
    }


}
