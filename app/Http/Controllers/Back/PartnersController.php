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

class PartnersController extends Controller
{

    public function index()
    {    
        if((userPermissions()->partners_view)){
            $pageNameAr = 'الشركاء';
            $pageNameEn = 'partners';
            
            return view('back.partners.index' , compact('pageNameAr' , 'pageNameEn'));	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
        
    }


    public function store(Request $request)
    {
        if((userPermissions()->partners_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'name' => 'required|string|unique:partners,name|max:255',
                    'address' => 'nullable|string|max:255',
                    'phone' => 'nullable|numeric',
                    'first_money' => 'nullable|numeric',
                    'commission_percentage' => 'required|numeric|min:0',
                    'notes' => 'nullable|string|max:255',
                ],[
                    'required' => 'حقل :attribute إلزامي.',
                    'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                    'unique' => 'حقل :attribute مستخدم من قبل.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'min' => 'حقل :attribute يجب أن يكون أكبر من :min.',
                    'in' => 'القيمة المختارة في :attribute غير مسموح بها. يُرجى اختيار قيمة من الخيارات المتاحة فقط.',
    
                ],[
                    'name' => 'إسم الشريك',                
                    'address' => 'عنوان الشريك',                
                    'phone' => 'تلفون الشريك',                
                    'first_money' => 'الرصيد الإفتتاحي للشريك',   
                    'commission_percentage' => 'نسبة الشريك',             
                    'notes' => 'ملاحظات',                
                    'image' => 'الصورة',                
                ]);
    
    
                DB::transaction(function () {
                    $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'رصيد اول شريك')->max('num_order');
    
                    $getId = DB::table('partners')->insertGetId([
                        'name' => request('name'),
                        'email' => request('email'),
                        'phone' => request('phone'),
                        'address' => request('address'),
                        'status' => request('status'),
                        'first_money' => request('first_money') ?? 0,
                        'notes' => request('notes'),
                        'created_at' => now()
                    ]);
                    
                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => 0, 
                        'treasury_type' => 'رصيد اول شريك',
                        'bill_id' => 0,
                        'bill_type' => 'رصيد اول شريك', 
                        'partner_id' => $getId, 
                        'remaining_money' => request('first_money') ?? 0,
                        'commission_percentage' => request('commission_percentage'),
                        'notes' => request('notes'), 
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);
    
                });
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
        
    }

    public function edit($id)
    {
        if((userPermissions()->partners_update)){
            if(request()->ajax()){
                $find = DB::table('partners')->where('partners.id', $id)
                                            ->leftJoin('treasury_bill_dets', 'treasury_bill_dets.partner_id', 'partners.id')
                                            ->orderBy('treasury_bill_dets.id', 'desc')
                                            ->select(
                                                'partners.*', 
                                                'treasury_bill_dets.commission_percentage'
                                            )
                                            ->first();
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
            $this->validate($request , [
                'name' => 'required|string|max:255|unique:partners,name,'.$id,
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|numeric',
                'first_money' => 'nullable|numeric',
                'commission_percentage' => 'required|numeric|min:0',
                'notes' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'min' => 'حقل :attribute يجب أن يكون أكبر من :min.',
                'in' => 'القيمة المختارة في :attribute غير مسموح بها. يُرجى اختيار قيمة من الخيارات المتاحة فقط.',

            ],[
                'name' => 'إسم الشريك',                
                'address' => 'عنوان الشريك',                
                'phone' => 'تلفون الشريك',                
                'first_money' => 'الرصيد الإفتتاحي للشريك',                
                'commission_percentage' => 'نسبة الشريك',                
                'notes' => 'ملاحظات',                
                'image' => 'الصورة',                
            ]);

            DB::transaction(function() use($id){
                DB::table('partners')->where('id', $id)->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'phone' => request('phone'),
                    'address' => request('address'),
                    'status' => request('status'),
                    'notes' => request('notes'),
                    'updated_at' => now()
                ]);
                
                $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'تعديل نسبة شريك')->max('num_order');
                $lastRow = DB::table('treasury_bill_dets')->where('partner_id', $id)->orderBy('id', 'DESC')->first();

                if($lastRow->commission_percentage != request('commission_percentage')){
                    DB::table('treasury_bill_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'date' => Carbon::now(),
                        'treasury_id' => 0, 
                        'treasury_type' => 'تعديل نسبة شريك',
                        'bill_id' => 0,
                        'bill_type' => 'تعديل نسبة شريك', 
                        'partner_id' => $id, 
                        'remaining_money' => $lastRow->remaining_money,
                        'commission_percentage' => request('commission_percentage'),
                        'notes' => request('notes'), 
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'updated_at' => now()                            
                    ]);
                }
            });
        } 
    }

    public function destroy($id)
    {
        if((userPermissions()->partners_delete)){
            $find = DB::table('partners')->where('id', $id)->first();
            $partnerTreasuryBillDets = DB::table('treasury_bill_dets')->where('partner_id', $id)->get();
    
            if(count($partnerTreasuryBillDets) > 1){
                return response()->json(['cannot_delete' => $find->name]);
    
            }elseif(count($partnerTreasuryBillDets) == 1){
                DB::table('partners')->where('id', $id)->delete();
                DB::table('treasury_bill_dets')->where('partner_id', $id)->delete();
                return response()->json(['success_delete' => $find->name]);
            }

        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
        
    }


    public function datatable()
    {
        $all = DB::table('partners')
                    ->leftJoin('treasury_bill_dets', function ($join) {
                        $join->on('treasury_bill_dets.partner_id', '=', 'partners.id')
                            ->whereRaw('treasury_bill_dets.id = (
                                SELECT MAX(id) FROM treasury_bill_dets 
                                WHERE partner_id = partners.id
                            )');
                    })
                    ->select(
                        'partners.*',
                        'treasury_bill_dets.remaining_money', 
                        'treasury_bill_dets.commission_percentage', 
                    )
                    ->get();


        return DataTables::of($all)
            ->addColumn('id', function($res){
                return  "<strong>#".$res->id."</strong>";
            })
            ->addColumn('name', function($res){
                return  "<strong class='text-primary'>".$res->name."</strong>";
            })
            ->addColumn('address', function($res){
                return '<span class="" data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->address.'">
                            '.Str::limit($res->address, 20).'
                        </span>';
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('first_money', function($res){
                if($res->first_money > 0){
                    return '<span style="font-size: 15px;">'.display_number($res->first_money).'</span>';
                    
                }elseif($res->first_money < 0){
                    return '<span style="font-size: 15px;">'.display_number($res->first_money).'</span>';
                }else{
                    return 0;
                }
            })
            ->addColumn('commission_percentage', function($res){
                return  "<strong class='badge badge-primary' style='font-size: 15px;'>".display_number($res->commission_percentage)." %</strong>";
            })
            ->addColumn('remaining_money', function($res){
                if($res->remaining_money > 0){
                    return '<span class="text-success" style="font-size: 15px;">'.display_number($res->remaining_money).'</span>';
                    
                }elseif($res->remaining_money < 0){
                    return '<span class="text-danger" style="font-size: 15px;">'.display_number($res->remaining_money).'</span>';
                }else{
                    return 0;
                }
            })
            ->addColumn('created_at', function($res){
                if($res->created_at){
                    return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <span style="font-weight: bold;margin: 0 7px;color: red;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
                }
            })
            ->addColumn('status', function($res){
                if($res->status == 1){
                    return '<span class="badge badge-success" style="width: 40px;">نشط</span>';
                }
                else{
                    return '<span class="badge badge-danger" style="width: 40px;">معطل</span>';
                }
            })
            ->addColumn('action', function($res){
                // if (auth()->user()->role_relation->users_update == 1 ){
                // }
                return '
                            <button class="btn btn-sm btn-rounded btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                                <i class="fas fa-marker"></i>
                            </button>
                            
                            <button class="btn btn-sm btn-rounded btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'" res_title="'.$res->name.'">
                                <i class="fa fa-trash"></i>
                            </button>
                        ';
            })
            ->rawColumns(['id', 'name', 'phone', 'address', 'status', 'first_money', 'commission_percentage', 'remaining_money', 'notes', 'created_at', 'action'])
            ->toJson();
    }
}