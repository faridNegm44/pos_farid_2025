<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UnitsController extends Controller
{
    public function index()
    {               
        if((userPermissions()->units_view)){
            $pageNameAr = 'وحدات السلع والخدمات';
            $pageNameEn = 'units';

            return view('back.units.index' , compact('pageNameAr' , 'pageNameEn'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }                  
    }

    public function store(Request $request)
    {
        if((userPermissions()->units_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'name' => 'required|string|unique:units,name',
                ],[
                    'name.required' => 'إسم الوحدة مطلوب',
                    'name.string' => 'حقل إسم الوحدة يجب ان يكون من نوع نص',
                    'name.unique' => 'إسم الوحدة مستخدم من قبل',                
                ]);
    
                Units::create($request->all());
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        } 
    }

    public function edit($id)
    {
        if((userPermissions()->units_update)){
            if(request()->ajax()){
                $find = Units::where('id', $id)->first();
                return response()->json($find);
            }
            return view('back.welcome');

        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        } 
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Units::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:units,name,'.$id,
            ],[
                'name.required' => 'إسم الوحدة مطلوب',
                'name.string' => 'حقل إسم الوحدة يجب ان يكون من نوع نص',
                'name.unique' => 'إسم الوحدة مستخدم من قبل',                
            ]);

            $find->update($request->all());
        }   
    }

     
    public function destroy($id){
        if((userPermissions()->units_delete)){
            $unit = DB::table('products')->where('bigUnit', $id)->orWhere('smallUnit', $id)->first();
    
            if ($unit) {
                return response()->json(['cannot_delete' => 'cannot_delete']);
            }
    
            if (!$unit) {
                DB::table('units')->where('id', $id)->delete();
                return response()->json(['success_delete' => 'success_delete']);
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        } 
    }


    public function datatable()
    {
        $all = Units::all();

        return DataTables::of($all)
            ->addColumn('name', function($res){
                return '<strong>'.$res->name.'</strong>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'" unit_name="'.$res->name.'">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
    
            })
            ->rawColumns(['name', 'action'])
            ->toJson();
    }
}