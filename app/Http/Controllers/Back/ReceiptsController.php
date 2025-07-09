<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\StoreDets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReceiptsController extends Controller
{
    public function index()
    {          
        if((userPermissions()->receipts_view)){
            $pageNameAr = 'ايصال استلام نقدية / شيكات';
            $pageNameEn = 'receipts';
            $taswea_reasons = DB::table('taswea_reasons_to_client_supplier')->get();
    
            return view('back.receipts.index' , compact('pageNameAr' , 'pageNameEn', 'taswea_reasons'));
        }else{
            return redirect('/')->with(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }      
    }

    public function store(Request $request)
    {
        if((userPermissions()->receipts_create)){
            if (request()->ajax()){
                $this->validate($request , [
                    'payer_type' => 'required|string',
                    'payer_id' => 'required|integer',
                    'amount' => 'required|numeric',
                    'receipt_date' => 'nullable|date',
                ],[
                    'required' => 'حقل :attribute إلزامي.',
                    'exists' => 'حقل :attribute غير موجود.',
                    'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                    'min' => 'حقل :attribute أقل قيمة له هي 0.',
                ],[
                    'payer_id' => 'اختيار الجهة',                
                    'reason_id' => 'سبب التسوية',                
                    'amount' => 'رصيد الجهة الجديد',                
                ]);


                DB::table('receipts')->insert([
                    'payer_type' => request('payer_type'),
                    'payer_id' => request('payer_id'),
                    'amount' => request('amount'),
                    'receipt_date' => request('receipt_date') ?? null,
                    'status' => 'جاري التحصيل',
                    'notes' => request('notes'),
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now(),
                    'year_id' => $this->currentFinancialYear(),
                ]);
            }
        }else{
            return response()->json(['notAuth' => 'عذرًا، ليس لديك صلاحية لتنفيذ طلبك']);
        }  
    }

    public function getCurrentRemainingMoney($clientOrSupplier)
    {
        if(request()->ajax()){
            if($clientOrSupplier == 'عميل'){
                $find = DB::table('clients_and_suppliers')
                            ->whereIn('clients_and_suppliers.client_supplier_type', [3, 4])
                            ->leftJoin('treasury_bill_dets', function ($join) {
                                $join->on('treasury_bill_dets.client_supplier_id', '=', 'clients_and_suppliers.id')
                                    ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.client_supplier_id = clients_and_suppliers.id)');
                            })
                            ->select(
                                'clients_and_suppliers.id', 'clients_and_suppliers.name', 
                                'treasury_bill_dets.remaining_money', 
                            )
                            ->orderBy('treasury_bill_dets.id', 'desc')
                            ->get();

                return response()->json($find);

            }elseif($clientOrSupplier == 'مورد'){
                $find = DB::table('clients_and_suppliers')
                            ->whereIn('clients_and_suppliers.client_supplier_type', [1, 2])
                            ->leftJoin('treasury_bill_dets', function ($join) {
                                $join->on('treasury_bill_dets.client_supplier_id', '=', 'clients_and_suppliers.id')
                                    ->whereRaw('treasury_bill_dets.id = (select max(id) from treasury_bill_dets where treasury_bill_dets.client_supplier_id = clients_and_suppliers.id)');
                            })
                            ->select(
                                'clients_and_suppliers.id', 'clients_and_suppliers.name', 
                                'treasury_bill_dets.remaining_money', 
                            )
                            ->orderBy('treasury_bill_dets.id', 'desc')
                            ->get();

                return response()->json($find);
            }
        }
        return view('back.welcome');
    }
    
    public function datatable()
    {
        $all = DB::table('receipts')
                            ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'receipts.payer_id')
                            ->leftJoin('clients_and_suppliers_types', 'clients_and_suppliers_types.name', 'receipts.payer_type')
                            ->leftJoin('users', 'users.id', 'receipts.user_id')
                            ->leftJoin('financial_years', 'financial_years.id', 'receipts.year_id')
                            ->select(
                                'receipts.*',
                                'clients_and_suppliers.id as clientSupplierId',
                                'clients_and_suppliers.name as clientSupplierName',
                                'clients_and_suppliers.phone as clientSupplierPhone',

                                'users.name as userName',                                
                                'clients_and_suppliers_types.name as clientSupplierStatus',
                                'financial_years.name as financialName',
                            )
                            ->orderBy('receipts.id', 'desc')
                            ->get();

        return DataTables::of($all)
            ->addColumn('clientSupplierName', function($res){
                $checkPhone = $res->clientSupplierPhone ? ' - '.$res->clientSupplierPhone : '';
                return $res->clientSupplierId .' - '. $res->clientSupplierName . $checkPhone;
            })
            ->addColumn('clientSupplierStatus', function($res){
                return $res->clientSupplierStatus;
            })
            ->addColumn('amount', function($res){
                return "<strong style='font-size: 12px !important;'>" . (display_number($res->amount)) . "</strong>";

            })
            ->addColumn('status', function($res){
                if($res->status == 'جاري التحصيل'){
                    return '<span class="badge badge-dark text-white" style="font-size: 90%;">جاري التحصيل</span>';

                }else if($res->status == 'تم التحصيل'){
                    return '<span class="badge badge-success text-white" style="font-size: 90%;">تم التحصيل</span>';
                    
                }else if($res->status == 'ملغى'){
                    return '<span class="badge badge-danger text-white" style="font-size: 90%;">ملغى</span>';
                }
            })
            ->addColumn('created_at', function($res){
                $dates = Carbon::parse($res->created_at)->format('d-m-Y')
                        .' <span class="badge badge-dark text-white" style="margin: 0 7px;font-size: 100% !important;">'.Carbon::parse($res->created_at)->format('h:i:s a').'</span> <br/>';
                if($res->receipt_date){
                    $dates.= 'تاريخ اخر '.Carbon::parse($res->receipt_date)->format('Y-m-d')
                        .' <span class="text-danger" style="margin: 0 7px;font-size: 100% !important;">'.Carbon::parse($res->receipt_date)->format('h:i:s a').'</span>';
                }

                return $dates;
            })
            ->addColumn('notes', function($res){
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
            ->addColumn('action', function($res){
                return '
                        <button class="btn btn-sm btn-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'" >
                            <i class="fa fa-trash"></i>
                        </button>

                        <button type="button" class="btn btn-sm btn-success show" data-effect="effect-scale" data-toggle="modal" href="#showProductsModal" data-placement="top" data-toggle="tooltip" title="عرض المطالبة" res_id="'.$res->id.'">
                            <i class="fas fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-sm btn-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                            <i class="fas fa-marker"></i>
                        </button>

                        <button type="button" class="btn btn-sm btn-secondary print" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="طباعة المطالبة" res_id="'.$res->id.'">
                        <i class="fas fa-print"></i>
                        </button>
                    ';
            })
            ->rawColumns(['productName', 'status', 'created_at', 'amount', 'userName', 'notes', 'financialName', 'action'])
            ->toJson();
    }

    // start print /////////////////////////////
    public function print_receipt($id)
    {
        //return view('back.receipts.print_receipt');
        $pageNameAr = 'إيصال استلام نقدية / شيكات ';
        $pageNameEn = 'receipts';
        
        $receiptBill = DB::table('receipts')
                            ->leftJoin('clients_and_suppliers', 'clients_and_suppliers.id', 'receipts.payer_id')
                            ->leftJoin('clients_and_suppliers_types', 'clients_and_suppliers_types.name', 'receipts.payer_type')
                            ->leftJoin('users', 'users.id', 'receipts.user_id')
                            ->leftJoin('financial_years', 'financial_years.id', 'receipts.year_id')
                            ->where('receipts.id', $id)
                            ->select(
                                'receipts.*',
                                'clients_and_suppliers.id as clientSupplierId',
                                'clients_and_suppliers.name as clientSupplierName',
                                'clients_and_suppliers.phone as clientSupplierPhone',

                                'users.name as userName',                                
                                'clients_and_suppliers_types.name as clientSupplierStatus',
                                'financial_years.name as financialName',
                            )
                            ->orderBy('receipts.id', 'desc')
                            ->first();

                    // return $receiptBill;

        if( $receiptBill ){
            return view('back.receipts.print_receipt', compact('pageNameAr', 'pageNameEn', 'receiptBill'));
        }else{
            return redirect('/');
        }
    }
    // end print /////////////////////////////
}
