<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InventoriesController extends Controller
{
    public function index()
    {         
        //if((userPermissions()->inventories_view)){
            $pageNameAr = 'إدارة الجرد';
            $pageNameEn = 'inventories';
            $users = DB::table('users')->where('status', 1)->orderBy('name', 'asc')->get();

            return view('back.inventories.index' , compact('pageNameAr' , 'pageNameEn', 'users'));
        //}else{
        //    return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
                           
    }

    public function store(Request $request)
    {
        //if((userPermissions()->inventories_create)){
            if (request()->ajax()){
                $this->validate($request, [
                    'date' => 'nullable|date',
                    'supervisor_1' => 'required|integer|exists:users,id',
                    'supervisor_2' => 'nullable|integer|exists:users,id',
                    'supervisor_3' => 'nullable|integer|exists:users,id',
                    'notes' => 'nullable|string',
                ], [
                    'required' => 'حقل :attribute إلزامي.',
                    'integer' => 'حقل :attribute يجب أن يكون رقماً صحيحاً.',
                    'date' => 'حقل :attribute يجب أن يكون تاريخاً صالحاً.',
                    'in' => 'قيمة :attribute غير صالحة.',
                    'exists' => 'حقل :attribute غير موجود في قاعدة البيانات.',
                ], [
                    'date' => 'تاريخ الجرد',
                    'supervisor_1' => 'المشرف الأول',
                    'supervisor_2' => 'المشرف الثاني',
                    'supervisor_3' => 'المشرف الثالث',
                    'status' => 'الحالة',
                    'notes' => 'الملاحظات',
                ]);
            
                DB::table('inventories')->insert([
                    'date' => $request->date,
                    'supervisor_1' => $request->supervisor_1,
                    'supervisor_2' => $request->supervisor_2,
                    'supervisor_3' => $request->supervisor_3,
                    'status' => 'جاري الجرد',
                    'notes' => $request->notes,
                    'user_id' => auth()->id(),
                    'year_id' => $this->currentFinancialYear(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
    }

    public function edit($id)
    {
        //if((userPermissions()->inventories_update)){
            if(request()->ajax()){
                $find = Company::where('id', $id)->first();
                return response()->json($find);
            }
            return view('back.welcome');

        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Company::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:companies,name,'.$id,
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',

            ],[
                'name' => 'إسم الشركة',                
            ]);

            $find->update($request->all());
        }   
    }

     
    public function destroy($id){
        //if((userPermissions()->inventories_delete)){
            
            $unit = DB::table('products')->where('company', $id)->first();
    
            if ($unit) {
                return response()->json(['cannot_delete' => 'cannot_delete']);
            }
    
            if (!$unit) {
                DB::table('companies')->where('id', $id)->delete();
                return response()->json(['success_delete' => 'success_delete']);
            }

        //}else{
        //    return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        //}  
    }


    public function datatable()
    {
        $all = DB::table('inventories')
                    ->leftJoin('users as s1', 's1.id', '=', 'inventories.supervisor_1')
                    ->leftJoin('users as s2', 's2.id', '=', 'inventories.supervisor_2')
                    ->leftJoin('users as s3', 's3.id', '=', 'inventories.supervisor_3')
                    ->leftJoin('users as u', 'u.id', '=', 'inventories.user_id')
                    ->leftJoin('financial_years', 'financial_years.id', '=', 'inventories.year_id')
                    ->select(
                        'inventories.*',

                        's1.name as supervisor_1Name',
                        's2.name as supervisor_2Name',
                        's3.name as supervisor_3Name',

                        'u.name as userName',
                        'financial_years.name as financialName'
                    )
                    ->get();

        return DataTables::of($all)
            ->addColumn('supervisor_1Name', fn($res) => $res->supervisor_1Name)
            ->addColumn('supervisor_2Name', fn($res) => $res->supervisor_2Name)
            ->addColumn('supervisor_3Name', fn($res) => $res->supervisor_3Name)
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('created_at', function($res){
                return Carbon::parse($res->created_at)->format('d-m-Y')
                        .' <span class="badge badge-dark text-white" style="margin: 0 7px;font-size: 100% !important;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
            })
            ->addColumn('date', function($res){
                if($res->date){
                    return Carbon::parse($res->date)->format('d-m-Y');
                }else{
                    return '';
                }
            })
            ->addColumn('status', function($res){
                if($res->status == 'جاري الجرد'){
                    return '<span class="badge badge-primary text-white" style="font-size: 90%;">جاري الجرد</span>';

                }else if($res->status == 'تم الاعتماد'){
                    return '<span class="badge badge-success text-white" style="font-size: 90%;">تم الاعتماد</span>';
                    
                }else if($res->status == 'ملغي'){
                    return '<span class="badge badge-danger text-white" style="font-size: 90%;">ملغي</span>';
                }
            })
            ->addColumn('action', function($res){
                $checkButtons = '';
                if($res->status == 'جاري الجرد'){
                    $checkButtons .= '                                    
                                    <button class="btn btn-sm btn-danger delete" data-placement="top" data-toggle="tooltip" title="إلغاء الجرد" res_id="'.$res->id.'" >
                                        <i class="fas fa-ban"></i>
                                    </button>                                    
                                    
                                    <button type="button" class="btn btn-sm btn-success show take_money" data-effect="effect-scale" data-toggle="modal" href="#takeMoneyModal" data-placement="top" data-toggle="tooltip" title="اعتماد الجرد وإغلاقه" res_id="'.$res->id.'">
                                        <i class="fas fa-lock"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter"     data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                                        <i class="fas fa-marker"></i>
                                    </button>       
                                    ';
                }

                $checkButtons .= '
                                    <button type="button" class="btn btn-sm btn-secondary print" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="طباعة أصناف الجرد" res_id="'.$res->id.'">
                                        <i class="fas fa-print"></i>
                                    </button>';
                
                return $checkButtons;
            })
            ->rawColumns(['status', 'action', 'notes', 'created_at', 'date', 'supervisor_1Name', 'supervisor_2Name', 'supervisor_3Name'])
            ->toJson();
    }
}