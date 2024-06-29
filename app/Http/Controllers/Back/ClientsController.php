<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\ClientsAndSuppliers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    public function index()
    {                               
        $pageNameAr = 'العملاء';
        $pageNameEn = 'clients';
        return view('back.clients.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

     
    public function destroy($id)
    {
        
    }


    public function datatable()
    {
        //leftJoin('clients_and_suppliers_types' , 'clients_and_suppliers_types.id' , '=' , 'clients_and_suppliers.client_supplier_type') 
        $all = ClientsAndSuppliers::where('client_supplier_type', 3)
                                    ->orWhere('client_supplier_type', 4)
                                    ->leftJoin('clients_and_suppliers_types', 'clients_and_suppliers_types.id', 'clients_and_suppliers.client_supplier_type')
                                    ->select('clients_and_suppliers.*', 'clients_and_suppliers_types.name as type_name')
                                    ->get();

                                // dd($all);

        return DataTables::of($all)
            ->addColumn('type_name', function($res){
                return $res->type_name;
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
                            <button class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                                <i class="fas fa-marker"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'">
                                <i class="fa fa-trash"></i>
                            </button>
                        
                        ';
            })
            ->rawColumns(['code', 'type_name', 'name', 'phone', 'address', 'status', 'action'])
            ->toJson();
    }
}
