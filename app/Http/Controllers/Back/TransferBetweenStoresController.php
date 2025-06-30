<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\FinancialTreasury;
use App\Models\Back\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransferBetweenStoresController extends Controller
{
    public function index()
    {                
        if((userPermissions()->transfer_between_stores_view)){
            $pageNameAr = 'تحويلات السلع والخدمات بين المخازن';
            $pageNameEn = 'transfer_between_stores';
            $stores = DB::table('stores')->where('status', 1)->get();
                                            
            return view('back.transfer_between_stores.index' , compact('pageNameAr' , 'pageNameEn', 'stores'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }        
    }

    public function get_products($transfer_from)
    {
        if(request()->ajax()){
            $products = DB::table('products')
                                    ->where('store', $transfer_from)
                                    ->leftJoin('store_dets', function($join) {
                                        $join->on('store_dets.product_id', '=', 'products.id')
                                             ->whereRaw('store_dets.id = (
                                                 SELECT MAX(id) FROM store_dets WHERE store_dets.product_id = products.id
                                             )');
                                    })
                                    ->leftJoin('units', 'units.id', 'products.smallUnit')
                                    ->orderBy('products.nameAr', 'asc')
                                    //->orderBy('store_dets.quantity_small_unit', 'desc')
                                    ->select('products.*', 'store_dets.quantity_small_unit', 'units.name as unitName')
                                    ->get();

                                    //dd($products);
            return response()->json($products);            
        }
        return view('back.welcome');
    }
    
    
    public function get_product_stores($product)
    {
        if(request()->ajax()){
            $products = DB::table('products')
                                    ->where('store', $product)
                                    ->leftJoin('store_dets', function($join) {
                                        $join->on('store_dets.product_id', '=', 'products.id')
                                             ->whereRaw('store_dets.id = (
                                                 SELECT MAX(id) FROM store_dets WHERE store_dets.product_id = products.id
                                             )');
                                    })
                                    ->leftJoin('units', 'units.id', 'products.smallUnit')
                                    ->orderBy('products.nameAr', 'asc')
                                    //->orderBy('store_dets.quantity_small_unit', 'desc')
                                    ->select('products.*', 'store_dets.quantity_small_unit', 'units.name as unitName')
                                    ->get();

                                    //dd($products);
            return response()->json($products);            
        }
        return view('back.welcome');
    }
    
    public function store(Request $request)
    {
        if((userPermissions()->transfer_between_stores_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'transfer_from' => 'required|integer|exists:financial_treasuries,id',
                    'transfer_to' => 'required|integer|exists:financial_treasuries,id',
                    'value' => 'required|numeric|min:1',
                    'notes' => 'nullable|string|max:255',
                ],[
                    'exists' => 'حقل :attribute غير موجود.',
                    'required' => 'حقل :attribute إلزامي.',
                    'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                    'min' => 'حقل :attribute أقل قيمة له هي رقم 1.',
                    'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                ],[
                    'transfer_from' => 'المخزن المحول منة',                
                    'transfer_to' => 'المخزن المحول الية',                
                    'value' => 'العدد المحول',                
                    'notes' => 'ملاحظات',                
                ]);
    
                $transfer_from_last_money = DB::table('store_dets')
                                        ->whereRaw('id = (select max(id) from store_dets where treasury_id = '.request('transfer_from').')')                              
                                        ->value('quantity_small_unit');
    
    
                $transfer_to_last_money = DB::table('store_dets')
                                        ->whereRaw('id = (select max(id) from store_dets where treasury_id = '.request('transfer_to').')')                              
                                        ->value('quantity_small_unit');
    
                $value = request('value');
                $req_from = request('transfer_from');
                $req_to = request('transfer_to');
    
                $lastNumId = DB::table('store_dets')->where('treasury_type', 'تحويل')->max('num_order');
    
                
                if($value > $transfer_from_last_money){
                    return response()->json(['error' => 'مبلغ التحويل اكبر من المبلغ الموجود بالخزينة']);
                }else{
    
                    DB::transaction(function() use($transfer_from_last_money, $transfer_to_last_money, $lastNumId, $value, $req_from, $req_to){
    
                        // start transaction from الخزنه المحول منها
                        DB::table('store_dets')->insert([
                            'num_order' => ($lastNumId+1), 
                            'date' => Carbon::now(),
                            'treasury_id' => $req_from, 
                            'treasury_type' => 'تحويل', 
                            'bill_id' => 0, 
                            'bill_type' => 0, 
                            'client_supplier_id' => 0, 
                            'money' => ($transfer_from_last_money - $value), 
                            'value' => $value, 
                            'transfer_from' => $req_from, 
                            'transfer_to' => $req_to, 
                            'notes' => request('notes'), 
                            'user_id' => auth()->user()->id, 
                            'year_id' => $this->currentFinancialYear(),
                            'created_at' => now()
                        ]);
    
                        // start transaction to الخزنه المحول اليها
                        DB::table('store_dets')->insert([
                            'num_order' => ($lastNumId+1), 
                            'date' => Carbon::now(),
                            'treasury_id' => $req_to, 
                            'treasury_type' => 'تحويل', 
                            'bill_id' => 0, 
                            'bill_type' => 0, 
                            'client_supplier_id' => 0, 
                            'money' => ($transfer_to_last_money + $value), 
                            'value' => $value, 
                            'transfer_from' => $req_from, 
                            'transfer_to' => $req_to, 
                            'notes' => request('notes'), 
                            'user_id' => auth()->user()->id, 
                            'year_id' => $this->currentFinancialYear(),
                            'created_at' => now()
                        ]);
                    });
    
    
                }
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }
    }   
    
    
    public function edit($id)
    {
        if(request()->ajax()){
            $find = Expense::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }
    
    
    public function show($id)
    {
        if(request()->ajax()){
            $find = DB::table('store_dets')
                        ->where('num_order', $id)
                        ->where('treasury_type', 'تحويل')
                        ->leftJoin('financial_treasuries as transfer_from_name', 'transfer_from_name.id', 'store_dets.treasury_id')
                        ->leftJoin('financial_treasuries as transfer_to_name', 'transfer_to_name.id', 'store_dets.treasury_id')
                        ->select(
                            'store_dets.*', 
                            'transfer_from_name.name as transfer_from_name',
                            'transfer_to_name.name as transfer_to_name',
                        )
                        ->get();

            $created_at = Carbon::parse($find[0]->created_at)->format('d-m-Y h:i:s a');

            //dd($created_at);

            return response()->json([
                'find' => $find,
                'created_at' => $created_at
            ]);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Expense::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|unique:financial_treasuries,name,'.$id,
                //'moneyFirstDuration' => 'min:0|numeric',
                'notes' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'min' => 'حقل :attribute أقل قيمة له هي 0 حرف.',
                'max' => 'حقل :attribute أقصي قيمة له هي 255 حرف.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
            ],[
                'name' => 'إسم الخزنة',                
                'moneyFirstDuration' => 'رصيد أول المدة',                
                'notes' => 'ملاحظات',                
            ]);

            $data = $request->all();
            unset($data['moneyFirstDuration']);

            $find->update($data);
        }   
    }

     
    //public function destroy($id)
    //{
    //    $find = Expense::where('id', $id)->get();
    //    $find_relation = DB::table('treasury_bills_head')->where('expenses_id', $id)->get();

    //    if(count($find_relation) > 0){
    //        return response()->json('');
    //    }else{
    //        DB::transaction(function($find, $find_relation){
    //            $find->delete();
    //            $find_relation->delete();
    //        });
    //    }
    //}


    public function datatable()
    {
        $all = DB::table('store_dets')->orderBy('num_order', 'asc')
                        ->leftJoin('financial_treasuries as transfer_from_name', 'transfer_from_name.id', 'store_dets.treasury_id')
                        ->leftJoin('financial_treasuries as transfer_to_name', 'transfer_to_name.id', 'store_dets.treasury_id')
                        ->select(
                            'store_dets.*', 
                            'transfer_from_name.name as transfer_from_name',
                            'transfer_to_name.name as transfer_to_name',
                        )
                        ->orderBy('store_dets.bill_id', 'ASC')
                        ->groupBy('store_dets.num_order')
                        ->where('treasury_type', 'تحويل')
                        ->get();


        return DataTables::of($all)
            ->addColumn('num_order', function($res){
                return $res->num_order;
            })
            ->addColumn('created_at', function($res){
                if($res->created_at){
                    return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <span style="font-weight: bold;margin: 0 7px;color: red;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span>';
                }
            })
            ->addColumn('user', function($res){
                return $res->user_id;
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('action', function($res){
                return '
                        <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->num_order.'">
                            <i class="fas fa-marker"></i>
                        </button>
                        
                        <button type="button" class="btn btn-sm btn-outline-success show" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenterShow" data-placement="top" data-toggle="tooltip" title="عرض التحويل" res_id="'.$res->num_order.'">
                            <i class="fas fa-eye"></i>
                        </button>
                    ';
            })
            ->rawColumns(['num_order', 'created_at', 'user', 'transfer_from', 'transfer_to', 'value', 'notes', 'action'])
            ->toJson();
    }
}