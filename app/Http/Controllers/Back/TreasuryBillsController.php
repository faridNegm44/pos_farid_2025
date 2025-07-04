<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use App\Models\Back\FinancialTreasury;
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
        if((userPermissions()->treasury_bills_view)){
            $pageNameAr = 'معاملات الخزينة المالية';
            $pageNameEn = 'treasury_bills';
            
            return view('back.treasury_bills.index' , compact('pageNameAr' , 'pageNameEn'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }             
    }

    public function create()
    {             
        if((userPermissions()->treasury_bills_create)){
            $pageNameAr = 'أجراء معاملة في الخزينة المالية';
            $pageNameEn = 'treasury_bills';
            $treasuries = FinancialTreasury::where('status', 1)
                                            ->leftJoin('treasury_bill_dets', function ($join) {
                                                $join->on('treasury_bill_dets.treasury_id', '=', 'financial_treasuries.id')
                                                    ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.treasury_id = financial_treasuries.id)');
                                            })
                                            ->select('financial_treasuries.*', 'treasury_bill_dets.treasury_money_after')
                                            ->get();
    
            $clients = DB::table('clients_and_suppliers')
                            ->where('client_supplier_type', 3)
                            ->orWhere('client_supplier_type', 4)
                            ->where('status', 1)
                            ->orderBy('name', 'asc')
                            ->get();
    
            $suppliers = DB::table('clients_and_suppliers')
                            ->where('client_supplier_type', 1)
                            ->orWhere('client_supplier_type', 2)
                            ->where('status', 1)
                            ->orderBy('name', 'asc')
                            ->get();
    
            $partners = DB::table('partners')->where('status', 1)->orderBy('name', 'asc')->get();
    
    
            return view('back.treasury_bills.create' , compact('pageNameAr' , 'pageNameEn', 'treasuries', 'clients', 'suppliers', 'partners'));
	
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }                    
    }


    public function store(request $request)
    {
        if (request()->ajax()){
            //dd(request('supplier'));
            $valid = $this->validate($request, [
                'treasury_type' => 'required|string|in:اذن توريد نقدية,اذن صرف نقدية,اذن ارتجاع نقدية',
                'treasury_id' => 'required|integer|exists:financial_treasuries,id',
                'client' => 'nullable|integer|exists:clients_and_suppliers,id',
                'supplier' => 'nullable|integer|exists:clients_and_suppliers,id',
                'partner'  => 'nullable|integer|exists:partners,id',
                'value' => 'required|numeric|min:1',
                'notes' => 'nullable|string',
                'date' => 'nullable|date',
            ], [
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب أن يكون نصاً.',
                'numeric' => 'حقل :attribute يجب أن يكون رقماً.',
                'date' => 'حقل :attribute يجب أن يكون تاريخ.',
                'integer' => 'حقل :attribute يجب أن يكون رقماً صحيحاً.',
                'min' => 'حقل :attribute يجب أن يكون أكبر من :min.',
                'exists' => 'حقل :attribute غير موجود.',
                'in' => 'حقل :attribute غير صالح.',
                'required_without' => 'يجب تحديد :attribute إذا لم يتم تحديد :values.',
            ], [
                'treasury_type' => 'نوع المعاملة',
                'treasury_id' => 'الخزينة المالية',
                'value' => 'مبلغ المعاملة',
                'client' => 'العميل',
                'supplier' => 'المورد',
                'partner' => 'الشريك',
                'date' => 'تاريخ المعاملة',
            ]);

            if (!$request->client && !$request->supplier && !$request->partner){
                return response()->json(['checkAnyUser' => 'يجب اختيار إما العميل أو المورد أو الشريك.'])->withInput();

            }else{
                DB::transaction(function(){
                    $lastNumId = DB::table('treasury_bill_dets')
                                    ->where('treasury_type', request('treasury_type'))
                                    ->max('num_order');
    
                    $lastRecordTreasury = DB::table('treasury_bill_dets')
                                            ->where('treasury_id', request('treasury_id'))
                                            ->orderBy('id', 'desc')
                                            ->select('treasury_money_after')
                                            ->first();
                    
                    if(request('client') && !request('supplier') && !request('partner')) {
                        $lastRecordClientSupplier = DB::table('treasury_bill_dets')
                                                        ->where('client_supplier_id', request('client'))
                                                        ->orderBy('id', 'desc')
                                                        ->first();
    
                    }elseif(request('supplier') && !request('client') && !request('partner')){
                        $lastRecordClientSupplier = DB::table('treasury_bill_dets')
                                                        ->where('client_supplier_id', request('supplier'))
                                                        ->orderBy('id', 'desc')
                                                        ->first();
    
                    }elseif(request('partner') && !request('client') && !request('supplier')){
                        $lastRecordClientSupplier = DB::table('treasury_bill_dets')
                                                        ->where('partner_id', request('partner'))
                                                        ->orderBy('id', 'desc')
                                                        ->first();
                    }
    
    
                    // start if treasury_type == اذن توريد نقدية
                    if(request('treasury_type') === 'اذن توريد نقدية'){
                        $userValue = ( $lastRecordClientSupplier->remaining_money - request('value') );
                        $treasuryValue = ( request('value') + $lastRecordTreasury->treasury_money_after );
    
    
                    // else if treasury_type == اذن صرف نقدية
                    }else if(request('treasury_type') === 'اذن صرف نقدية'){
                        $userValue = ( $lastRecordClientSupplier->remaining_money + request('value') );
                        $treasuryValue = ( $lastRecordTreasury->treasury_money_after - request('value') );
                    }
    
                    // start insert to treasury_bill_dets
                    $getId = DB::table('treasury_bill_dets')->insertGetId([
                        'num_order' => ($lastNumId+1), 
                        'date' => request('date') ?? Carbon::now(),
                        'treasury_id' => request('treasury_id'), 
                        'treasury_type' => request('treasury_type'), 
                        'bill_id' => 0,
                        'bill_type' => 0, 
                        
                        'client_supplier_id' => (request()->has('client') || request()->has('supplier') && !request()->has('partner')) 
                                                ? $lastRecordClientSupplier->client_supplier_id 
                                                : 0,
                        'partner_id' => (request()->has('partner')) ? $lastRecordClientSupplier->partner_id : null, 
    
                        'treasury_money_after' => $treasuryValue, 
                        'amount_money' => request('value'), 
                        'remaining_money' => $userValue, 
                        'commission_percentage' => (request()->has('partner')) ? $lastRecordClientSupplier->commission_percentage : 0, 
                        'transaction_from' => null, 
                        'transaction_to' => null, 
                        'notes' => request('notes'), 
                        'user_id' => auth()->user()->id, 
                        'year_id' => $this->currentFinancialYear(),
                        'created_at' => now()
                    ]);
                });
            }



            
        }
    }



    //////////////////////////////////////////////// datatable /////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function datatable()
    {
        $all = DB::table('treasury_bill_dets')
                        ->leftJoin('financial_treasuries', 'financial_treasuries.id', 'treasury_bill_dets.treasury_id')
                        ->leftJoin('users', 'users.id', 'treasury_bill_dets.user_id')
                        ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'treasury_bill_dets.client_supplier_id')
                        ->leftJoin('clients_and_suppliers_types', 'clients_and_suppliers_types.id', 'clients_and_suppliers.client_supplier_type')
                        ->select(
                            'treasury_bill_dets.id', 'treasury_bill_dets.num_order', 'treasury_bill_dets.date', 'treasury_bill_dets.treasury_type', 'treasury_bill_dets.treasury_money_after', 'treasury_bill_dets.amount_money', 'treasury_bill_dets.remaining_money', 'treasury_bill_dets.notes', 'treasury_bill_dets.created_at', 
                            'financial_treasuries.name as treasuryName',
                            'clients_and_suppliers.name as cleintOrSupplierName',
                            'clients_and_suppliers_types.name as cleintOrSupplierTypeName',
                            'users.name as userName',
                        )
                        ->orderBy('treasury_bill_dets.created_at', 'desc')
                        ->where('treasury_type', 'اذن توريد نقدية')
                        ->orWhere('treasury_type', 'اذن صرف نقدية')
                        ->get();

        return DataTables::of($all)
            ->addColumn('num_order', function($res){
                return $res->num_order;
            })
            ->addColumn('created_at', function($res){
                if($res->created_at){
                    return Carbon::parse($res->created_at)->format('d-m-Y')
                            .' <p style="margin: 0 7px;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</p>';
                }
            })
            ->addColumn('date', function($res){
                if(Carbon::parse($res->date)->format('d-m-Y') != Carbon::parse($res->created_at)->format('d-m-Y')){
                    return "<span class='bg bg-warning' style='padding: 0 4px;'>".Carbon::parse($res->date)->format('d-m-Y')."</span>";
                }
            })
            ->addColumn('client_supplier', function($res){
                return '<strong class="text-primary">'.$res->cleintOrSupplierName.'</strong>';
            })
            ->addColumn('treasury_type', function($res){
                if($res->treasury_type === 'اذن توريد نقدية'){
                    return "<span class='bg rounded bg-success text-white' style='padding: 0 4px;'>".$res->treasury_type."</span>";
                    
                }elseif($res->treasury_type === 'اذن صرف نقدية'){
                    return "<span class='bg rounded bg-danger text-white' style='padding: 0 4px;'>".$res->treasury_type."</span>";

                }elseif($res->treasury_type === 'اذن ارتجاع نقدية'){
                    return "<span class='bg rounded bg-dark text-white' style='padding: 0 4px;'>".$res->treasury_type."</span>";
                }
            })
            ->addColumn('treasury', function($res){
                return '<strong class="text-primary">'.$res->treasuryName.'</strong>';
            })
            ->addColumn('treasury_money_after', function($res){
                return display_number($res->treasury_money_after);
            })
            ->addColumn('remaining_money', function($res){
                if($res->remaining_money < 0){
                    return '<strong class="bg rounded bg-secondary text-white" style="font-size: 13px;padding: 0 4px;">'.display_number($res->remaining_money).'</strong>';
                }else{
                    return '<strong style="font-size: 13px;padding: 0 4px">'.display_number($res->remaining_money).'</strong>';
                }
            })
            ->addColumn('amount_money', function($res){
                if($res->treasury_type === 'اذن توريد نقدية'){
                    return '<strong class="bg rounded bg-success text-white" style="font-size: 13px;padding: 0 4px">'.display_number($res->amount_money).'</strong>';
                    
                }elseif($res->treasury_type === 'اذن صرف نقدية'){
                    return '<strong class="bg rounded bg-danger text-white" style="font-size: 13px;padding: 0 4px">'.display_number($res->amount_money).'</strong>';

                }elseif($res->treasury_type === 'اذن ارتجاع نقدية'){
                    return '<strong class="bg rounded bg-dark text-white" style="font-size: 13px;padding: 0 4px">'.display_number($res->amount_money).'</strong>';
                }
            })            
            ->addColumn('user', function($res){
                return $res->userName;
            })
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->notes.'">
                            '.Str::limit($res->notes, 20).'
                        </span>';
            })
            ->rawColumns(['num_order', 'created_at', 'date', 'client_supplier', 'treasury_type', 'treasury', 'treasury_money_after', 'amount_money', 'remaining_money', 'user', 'notes'])
            ->toJson();
    }


}
