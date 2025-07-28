<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\StoreDets;
use App\Models\Back\TasweaProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TasweaProductsController extends Controller
{
    public function index()
    {               
        if((userPermissions()->taswea_products_view)){
            $pageNameAr = 'تسوية كميات السلع والخدمات';
            $pageNameEn = 'taswea_products';
            $products = Product::all();
            $taswea_reasons = DB::table('taswea_reasons')->get();
    
            return view('back.taswea_products.index' , compact('pageNameAr' , 'pageNameEn', 'products', 'taswea_reasons'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        } 
    }

    public function store(Request $request)
    {
        if((userPermissions()->taswea_products_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'product_id' => 'required|integer|exists:products,id',
                    'reason_id' => 'required|integer|exists:taswea_reasons,id',
                    'quantity' => 'required|numeric|min:0',
                ],[
                    'required' => 'حقل :attribute إلزامي.',
                    'exists' => 'حقل :attribute غير موجود.',
                    'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'min' => 'حقل :attribute أقل قيمة له هي 0.',
                ],[
                    'product_id' => 'السلعة/الخدمة',                
                    'quantity' => 'الكمية',                
                    'reason_id' => 'سبب التسوية',                
                ]);
    
                $find = StoreDets::where('product_id', request('product_id'))->orderBy('id', 'desc')->first();
                $lastNumId = DB::table('store_dets')->where('type', 'تسوية سلعة/خدمة')->max('num_order');
                
                // start db::transaction
                DB::transaction(function() use($find, $lastNumId){
    
                    $insertGetId = TasweaProducts::create([
                        'product_id' => request('product_id'),
                        'old_quantity' => $find->quantity_small_unit,
                        'quantity' => request('quantity'),
                        'reason_id' => request('reason_id'),
                        'user_id' => auth()->user()->id,
                        'notes' => request('notes'),
                        'year_id' => $this->currentFinancialYear(),
                    ]);
    
                    DB::table('store_dets')->insert([
                        'num_order' => ($lastNumId+1), 
                        'type' => 'تسوية سلعة/خدمة',
                        'year_id' => $this->currentFinancialYear(),
                        'bill_id' => $insertGetId->id,
                        'product_id' => request('product_id'),
                        'sell_price_small_unit' => $find->sell_price_small_unit,
                        'last_cost_price_small_unit' => $find->last_cost_price_small_unit,
                        'avg_cost_price_small_unit' => $find->avg_cost_price_small_unit,
                        'tax' => $find->tax,
                        'discount' => $find->discount,
                        'product_bill_quantity' => $find->quantity_small_unit,
                        'quantity_small_unit' => request('quantity'),
                        'transfer_from' => null,
                        'transfer_to' => null,
                        'transfer_quantity' => 0,
                        'date' => request('custom_date'),
                        'created_at' => now()
                    ]);
                }); // end db::transaction 
    
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }

    public function getCurrentProductQuantity($id)
    {
        if(request()->ajax()){
            $find = DB::table('store_dets')->where('product_id', $id)->select('quantity_all')->orderBy('id', 'desc')->first();
            //dd($find->quantity_all);
            return response()->json($find);
        }
        return view('back.welcome');
    }
    
    public function datatable()
    {
        $all = TasweaProducts::leftJoin('store_dets', 'store_dets.bill_id', 'taswea_products.id')
                            ->where('store_dets.type', 'تسوية سلعة/خدمة')
                            ->leftJoin('products', 'products.id', 'taswea_products.product_id')
                            ->leftJoin('taswea_reasons', 'taswea_reasons.id', 'taswea_products.reason_id')
                            ->leftJoin('users', 'users.id', 'taswea_products.user_id')
                            ->leftJoin('financial_years', 'financial_years.id', 'taswea_products.year_id')
                            ->select(
                                'taswea_products.*',
                                'store_dets.id as storeDetsId',
                                'products.nameAr as productName',
                                'users.name as userName',                                
                                'taswea_reasons.name as reasonName',                                
                                'financial_years.name as financialName',
                            )
                            ->orderBy('taswea_products.id', 'desc')
                            ->get();

        return DataTables::of($all)
            ->addColumn('productName', function($res){
                return $res->productName;
            })
            ->addColumn('quantityBefore', function($res){
                return "<strong style='font-size: 12px !important;'>".$res->old_quantity."</strong>";
            })
            ->addColumn('quantityAfter', function($res){
                return "<strong style='font-size: 14px !important;color: red;'>".$res->quantity."</strong>";
            })
            ->addColumn('reasonName', function($res){
                return $res->reasonName;
            })
            ->addColumn('tasweaCreatedAt', function($res){
                return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <p style="margin: 0 7px;color: red;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</p>';
            })
            ->addColumn('status', function($res){
                if($res->quantity  > $res->old_quantity){
                    return '<span class="badge badge-success" style="font-size: 10px !important;width: 60px;">
                        <i class="fa fa-plus"></i> زيادة '.$res->quantity - $res->old_quantity.'
                    </span>';
                }else{
                    return '<span class="badge badge-danger" style="font-size: 10px !important;width: 60px;">
                        <i class="fa fa-minus"></i> عجز '.$res->old_quantity - $res->quantity.'
                    </span>';
                }
            })
            ->addColumn('tasweaNotes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->addColumn('financialName', function($res){
                return $res->financialName;
            })
            ->addColumn('userName', function($res){
                return $res->userName;
            })
            ->rawColumns(['productName', 'quantityBefore', 'quantityAfter', 'reasonName', 'status', 'tasweaCreatedAt', 'userName', 'tasweaNotes', 'financialName'])
            ->toJson();
    }
}