<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function currentFinancialYear(){
        return DB::table('financial_years')->where('status', 1)->first()->id;
    }
    
    function getNextId($table, $column = 'id'){
        $latestId = DB::table($table)->max($column);
        return $latestId ? $latestId+1 : 1;
    }
    function ifNullToZero($column){
        return request($column) ?? 0 ;
    }
    function ifFoundedRequestFile($column, $pathToSave){
        if(request($column) == ""){
            $name = "df_image.png";
        }else{
            $file = request($column);
            $name = time() . '.' .$file->getClientOriginalExtension();
            $path = public_path($pathToSave);
            $file->move($path , $name);
        }

        return $name;
    }
}