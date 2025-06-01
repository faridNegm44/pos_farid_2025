<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    public function index()
    {                               
        $pageNameAr = 'المخازن';
        $pageNameEn = 'stores';
        return view('back.stores.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string|unique:stores,name',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',

            ],[
                'name' => 'إسم المخزن',                
            ]);

            Store::create($request->all());
        }
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $find = Store::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Store::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:stores,name,'.$id,
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',

            ],[
                'name' => 'إسم المخزن',                
            ]);

            $find->update($request->all());
        }   
    }

    public function destroy($id){
        $store = DB::table('products')->where('store', $id)->first();

        if ($store) {
            return response()->json(['cannot_delete' => 'cannot_delete']);
        }

        if (!$store) {
            DB::table('stores')->where('id', $id)->delete();
            return response()->json(['success_delete' => 'success_delete']);
        }
    }
    
    public function datatable()
    {
        $all = Store::orderBy('id', 'DESC')->get();

        return DataTables::of($all)
            ->addColumn('name', function($res){
                return '<strong>'.$res->name.'</strong>';
            })
            ->addColumn('notes', function($res){
                return $res->notes;
            })
            ->addColumn('status', function($res){
                if($res->status == 1){
                    return '<span class="label text-success" style="position: relative;"><div class="dot-label bg-success ml-1" style="position: absolute;right: -17px;top: 7px;"></div>نشط</span>';
                }
                else{
                    return '<span class="label text-danger" style="position: relative;"><div class="dot-label bg-danger ml-1" style="position: absolute;right: -15px;top: 7px;"></div>معطل</span>';
                }
            })
            ->addColumn('action', function($res){
                if($res->id != 1){
                    return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>
                        
                        <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'" store_name="'.$res->name.'">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                }
            })
            ->rawColumns(['name', 'notes', 'status', 'action'])
            ->toJson();
    }
}