<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {                               
        $pageNameAr = 'نقطة بيع';
        $pageNameEn = 'pos';
        return view('back.pos.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create()
    {                               
        $pageNameAr = 'نقطة بيع';
        $pageNameEn = 'pos_create';
        return view('back.pos.create' , compact('pageNameAr' , 'pageNameEn'));
    }
}
