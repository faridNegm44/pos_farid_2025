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

class ClientsController extends Controller
{
    protected $latestId;

    public function __construct()
    {
        $this->latestId = $latestId = DB::table('clients_and_suppliers')->where('client_supplier_type', 3)->orWhere('client_supplier_type', 4)->max('code');
    }
    public function index()
    {                                                
        $pageNameAr = 'العملاء';
        $pageNameEn = 'clients';
        
        return view('back.clients.index' , compact('pageNameAr' , 'pageNameEn'));
    }


    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string|unique:clients_and_suppliers,name|max:255',
                'type_payment' => 'required|in:كاش,آجل',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|numeric',
                'money' => 'nullable|numeric',
                'debit_limit' => 'nullable|numeric',
                'commercial_register' => 'nullable|numeric',
                'tax_card' => 'nullable|numeric',
                'vat_registration_code' => 'nullable|numeric',
                'phone_of_commissioner' => 'nullable|integer',
                'image' => 'mimes:jpeg,png,jpg,gif|max:1500',
                'note' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'in' => 'القيمة المختارة في :attribute غير مسموح بها. يُرجى اختيار قيمة من الخيارات المتاحة فقط.',

            ],[
                'name' => 'إسم العميل',                
                'address' => 'عنوان العميل',                
                'phone' => 'تلفون العميل',                
                'money' => 'الفلوس',                
                'type_payment' => 'طريقة التعامل',                
                'debit_limit' => 'الحد الآقصي لـ مدين',                
                'commercial_register' => 'ك السجل التجاري',                
                'tax_card' => 'ك البطاقة الضريبية',                
                'vat_registration_code' => 'ك التسجيل ض.ق.م',                
                'name_of_commissioner' => 'اسم المفوض',                
                'phone_of_commissioner' => 'تليفون المفوض',                
                'image' => 'إسم العميل',                
                'note' => 'ملاحظات',                
                'image' => 'الصورة',                
            ]);


            DB::transaction(function () {
                if(request('image') == ""){
                    $name = "df_image.png";
                }else{
                    $file = request('image');
                    $name = time() . '.' .$file->getClientOriginalExtension();
                    $path = public_path('back/images/clients');
                    $file->move($path , $name);
                } 

                $moneyOnHim = request('money_on_him');
                $moneyForHim = request('money_for_him');
                $lastNumId = DB::table('treasury_bill_dets')->where('treasury_type', 'رصيد اول عميل')->max('num_order');

                $getId = DB::table('clients_and_suppliers')->insertGetId([
                    'client_supplier_type' => request('client_supplier_type'),
                    'code' => ($this->latestId+1),
                    'name' => request('name'),
                    'email' => request('email'),
                    'phone' => request('phone'),
                    'address' => request('address'),
                    'image' => $name,
                    'type_payment' => request('type_payment'),
                    'debit_limit' => request('type_payment') === 'آجل' ? request('debit_limit') : null, 
                    'status' => request('status'),
                    'commercial_register' => request('commercial_register'),
                    'tax_card' => request('tax_card'),
                    'vat_registration_code' => request('vat_registration_code'),
                    'name_of_commissioner' => request('name_of_commissioner'),
                    'phone_of_commissioner' => request('phone_of_commissioner'),
                    'note' => request('note'),
                    'created_at' => now()
                ]);
                
                DB::table('treasury_bill_dets')->insert([
                    'num_order' => ($lastNumId+1), 
                    'date' => Carbon::now(),
                    'treasury_id' => 0, 
                    'treasury_type' => 'رصيد اول عميل',
                    'bill_id' => 0,
                    'bill_type' => 'رصيد اول عميل', 
                    'client_supplier_id' => $getId, 
                    'amount_money' => $moneyOnHim > 0 ? $moneyOnHim : ($moneyForHim * -1),
                    'remaining_money' => $moneyOnHim > 0 ? $moneyOnHim : ($moneyForHim * -1),
                    'transaction_from' => null, 
                    'transaction_to' => null, 
                    'notes' => request('note'), 
                    'user_id' => auth()->user()->id, 
                    'year_id' => $this->currentFinancialYear(),
                    'created_at' => now()
                ]);

            });
        }
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $find = ClientsAndSuppliers::where('id', $id)->first();
            return response()->json($find);
        }
        return view('back.welcome');
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string|max:255|unique:clients_and_suppliers,name,'.$id,
                'type_payment' => 'required|in:كاش,آجل',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|numeric',
                'money' => 'nullable|numeric',
                'debit_limit' => 'nullable|numeric',
                'commercial_register' => 'nullable|numeric',
                'tax_card' => 'nullable|numeric',
                'vat_registration_code' => 'nullable|numeric',
                'phone_of_commissioner' => 'nullable|integer',
                'image' => 'mimes:jpeg,png,jpg,gif|max:1500',
                'note' => 'nullable|string|max:255',
            ],[
                'required' => 'حقل :attribute إلزامي.',
                'string' => 'حقل :attribute يجب ان يكون من نوع نص.',
                'unique' => 'حقل :attribute مستخدم من قبل.',
                'numeric' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'integer' => 'حقل :attribute يجب ان يكون من نوع رقم.',
                'in' => 'القيمة المختارة في :attribute غير مسموح بها. يُرجى اختيار قيمة من الخيارات المتاحة فقط.',

            ],[
                'name' => 'إسم العميل',                
                'address' => 'عنوان العميل',        
                'type_payment' => 'طريقة التعامل',                
                'phone' => 'تلفون العميل',                
                'money' => 'الفلوس',                
                'debit_limit' => 'الحد الآقصي لـ مدين',                
                'commercial_register' => 'ك السجل التجاري',                
                'tax_card' => 'ك البطاقة الضريبية',                
                'vat_registration_code' => 'ك التسجيل ض.ق.م',                
                'name_of_commissioner' => 'اسم المفوض',                
                'phone_of_commissioner' => 'تليفون المفوض',                
                'image' => 'إسم العميل',                
                'note' => 'ملاحظات',                
                'image' => 'الصورة',                
            ]);

            
            //DB::transaction(function() use($id){
                
            //!= $client->type_payment && $lastRowTreasuryBillDets->remaining_money != 0
            //});


            $client = ClientsAndSuppliers::where('id', $id)->first();
            $lastRowTreasuryBillDets = DB::table('treasury_bill_dets')->where('client_supplier_id', $id)->orderBy('id', 'desc')->first();

            if(request('image') == ''){
                $name = request("image_hidden");
            }else{
                $file = request('image');
                $name = time() . '.' .$file->getClientOriginalExtension();
                $path = public_path('back/images/clients');
                $file->move($path , $name);
                
                if(request("image_hidden") != "df_image.png"){
                    File::delete(public_path('back/images/clients/'.$client->image));
                }
            }
            
            if(request('type_payment') != $client->type_payment){
                if($lastRowTreasuryBillDets->remaining_money != 0){
                    return response()->json(['errorChangeTypePayment' => '⚠️ لا يمكن تغيير طريقة الدفع حالياً، توجد مديونيات قائمة في الوقت الحالي (له أو عليه) . يُرجى تسوية الحسابات أولاً قبل تعديل طريقة الدفع.']);

                }else{
                    $client->update([
                        'client_supplier_type' => request('client_supplier_type'),
                        'name' => request('name'),
                        'email' => request('email'),
                        'phone' => request('phone'),
                        'address' => request('address'),
                        'image' => $name,
                        'type_payment' => request('type_payment'),
                        'debit' => request('debit'),
                        'debit_limit' => request('debit_limit'),
                        'status' => request('status'),
                        'commercial_register' => request('commercial_register'),
                        'tax_card' => request('tax_card'),
                        'vat_registration_code' => request('vat_registration_code'),
                        'name_of_commissioner' => request('name_of_commissioner'),
                        'phone_of_commissioner' => request('phone_of_commissioner'),
                        'note' => request('note'),
                        'updated_at' => now()
                    ]);
                }

            }else{
                $client->update([
                    'client_supplier_type' => request('client_supplier_type'),
                    'name' => request('name'),
                    'email' => request('email'),
                    'phone' => request('phone'),
                    'address' => request('address'),
                    'image' => $name,
                    'type_payment' => request('type_payment'),
                    'debit' => request('debit'),
                    'debit_limit' => request('debit_limit'),
                    'status' => request('status'),
                    'commercial_register' => request('commercial_register'),
                    'tax_card' => request('tax_card'),
                    'vat_registration_code' => request('vat_registration_code'),
                    'name_of_commissioner' => request('name_of_commissioner'),
                    'phone_of_commissioner' => request('phone_of_commissioner'),
                    'note' => request('note'),
                    'updated_at' => now()
                ]);
            }
        } 
    }
 
    public function destroy($id)
    {
        $find = ClientsAndSuppliers::where('id', $id)->first();
        $clientTreasuryBillDets = DB::table('treasury_bill_dets')->where('client_supplier_id', $id)->get();

        if(count($clientTreasuryBillDets) > 1){
            return response()->json(['cannot_delete' => $find->name]);

        }elseif(count($clientTreasuryBillDets) == 1){
            if($find->image != "df_image.png"){
                File::delete(public_path('back/images/clients/'.$find->image));
            }

            $find->delete();
            DB::table('treasury_bill_dets')->where('client_supplier_id', $id)->delete();
            return response()->json(['success_delete' => $find->name]);
        }
    }


    public function datatable()
    {
        $all = ClientsAndSuppliers::where('client_supplier_type', 3)
                                    ->orWhere('client_supplier_type', 4)
                                    ->leftJoin('clients_and_suppliers_types', 'clients_and_suppliers_types.id', 'clients_and_suppliers.client_supplier_type')
                                    ->select(
                                        'clients_and_suppliers.*', 
                                        'clients_and_suppliers_types.name as type_name',
                                    )
                                    ->orderBy('id', 'desc')
                                    ->get();

                                //return $all;

        return DataTables::of($all)
            ->addColumn('code', function($res){
                return  "<strong>#".$res->code."</strong>";
            })
            ->addColumn('name', function($res){
                return  "<strong class='text-primary'>".$res->name."</strong>";
            })
            ->addColumn('type_name', function($res){
                return $res->type_name;
            })
            ->addColumn('address', function($res){
                return '<span class="" data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->address.'">
                            '.Str::limit($res->address, 20).'
                        </span>';
            })
            //->addColumn('opening_creditor', function($res){
            //    if($res->amount_money < 0){
            //        return '<span style="color: red;font-size: 15px;">'.$res->amount_money.'</span>';
            //    }else{
            //        return 0;
            //    }
            //})
            //->addColumn('opening_debtor', function($res){
            //    if($res->amount_money > 0){
            //        return '<span style="font-size: 15px;">'.$res->amount_money.'</span>';
            //    }else{
            //        return 0;
            //    }
            //})
            //->addColumn('max_limit', function($res){
            //    if($res->debit_limit){
            //        return '<span class="text-danger">'.$res->debit_limit.'</span>';
            //    }else{
            //        return 0;
            //    }
            //})
            ->addColumn('notes', function($res){
                return '<span data-bs-toggle="popover" data-bs-placement="bottom" title="'.$res->note.'">
                            '.Str::limit($res->note, 20).'
                        </span>';
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
            ->rawColumns(['code', 'name', 'type_name', 'phone', 'address', 'status', 'opening_creditor', 'opening_debtor', 'max_limit', 'notes', 'created_at', 'action'])
            ->toJson();
    }
}