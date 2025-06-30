
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        tbody tr td {
            padding: 5px !important;
        }
        #selectAll{
            width: 1.5em;
            height: 1.5em;
        }
        input[type="checkbox"]{
            width: 1em;
            height: 1em;
            vertical-align: top;
            background-color: #fff;
            border: 1px solid #e3d9da;
            margin: 0px 8px;
            position: relative;
            top: 3px;
        }
    </style>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('#selectAll').click(function(event) {
                if(this.checked) {
                    $('input[type="checkbox"]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[type="checkbox"]').each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@endsection



@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ $pageNameAr }}</h4>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <div class="card" style="padding: 10px" id="permisions">
            @php
                $models = [
                    // start first add
                    'financialYears', 'stores', 'financial_treasury', 'units', 'companies', 'productsCategories', 'products_sub_category', 'products', 'taswea_products', 'transfer_between_stores', 'clients', 'clients_report', 'clients_account_statement', 'suppliers', 'suppliers_report', 'suppliers_account_statement', 'taswea_client_supplier', 'partners', 'partners_report', 'partners_account_statement', 'taswea_partners', 'sales', 'sales_create', 'sales_return', 'products_stock_alert', 'purchases', 'purchases_create', 'purchases_return', 'treasury_bills', 'treasury_bills_create', 'treasury_bills_report', 'transfer_between_storages', 'expenses', 'expenses_report', 'users', 'settings', 'roles_permissions'
                    // end first add
                ];
                $count = 1;
            @endphp

            <form action="{{ url('roles_permissions/update/'.$find['id']) }}" method="POST">
                @csrf
                <div>
                    <div style="padding: 0px 5px 20px;">
                        <label for="role_name">اسم الإذن</label>

                        <input type="text" class="form-control" name="role_name" id="role_name" placeholder="اسم الإذن" value="{{ old('role_name', $find['role_name']) }}" />

                        @if($errors->has('role_name'))
                            <div class="error text-danger">{{ $errors->first('role_name') }}</div>
                        @endif
                    </div>

                    <div style="width: 1005;overflow: auto;">
                        <table class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <td style="color: #fff !important;padding: 10px;">#</td>
                                    <td style="color: #fff !important;padding: 10px;">الأسم</td>
                                    <td style="color: #fff !important;padding: 10px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                            <label class="form-check-label" for="selectAll">إختر الكل</label>
                                        </div>
                                    </td>
                                </tr>
                            </thead>

                            {{-- {{ $find[''.$model.'_create'] == 1 ? 'checked' : '' }} --}}
                            <tbody>
                                @foreach ($models as $model)
                                    <tr style="font-weight: bold;" id="{{ $model }}">
                                        <td class="text-nowrap fw-semibold">{{ $count++ }}</td>
                                        <td class="text-nowrap fw-semibold">@lang('app.'.$model)</td>


                                        <td>
                                            <div class="d-flex">
                                                @if($model != 'settings')
                                                    <div class="form-check me-3 me-lg-5" id="{{ $model }}_view_div">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_view" {{ old(''.$model.'_view') ? 'checked' : '' }} {{ $find[''.$model.'_view'] == 1 ? 'checked' : '' }} id="{{ $model }}_view"/>
                                                        <label class="form-check-label text-purple" for="{{ $model }}_view">عرض</label>
                                                    </div>
                                                @endif

                                                @if(
                                                    $model != 'clients_report' &&
                                                    $model != 'clients_account_statement' &&
                                                    $model != 'suppliers_report' &&
                                                    $model != 'suppliers_account_statement' &&
                                                    $model != 'partners_report' &&
                                                    $model != 'partners_account_statement' &&
                                                    $model != 'sales_create' &&
                                                    $model != 'sales_return' &&
                                                    $model != 'products_stock_alert' &&
                                                    $model != 'purchases_create' &&
                                                    $model != 'purchases_return' &&
                                                    $model != 'treasury_bills_create' &&
                                                    $model != 'treasury_bills_report' &&
                                                    $model != 'settings' &&
                                                    
                                                    $model != 'expenses_report' 
                                                )
                                                    <div class="form-check me-3 me-lg-5" id="{{ $model }}_create_div">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_create" {{ old(''.$model.'_create') ? 'checked' : '' }} {{ $find[''.$model.'_create'] == 1 ? 'checked' : '' }} id="{{ $model }}_create"/>
                                                        <label class="form-check-label text-success" for="{{ $model }}_create">اضافة</label>
                                                    </div>
                                                @endif
                                            
                                                @if(
                                                    $model != 'transfer_between_stores' &&
                                                    $model != 'taswea_products' &&
                                                    $model != 'clients_report' &&
                                                    $model != 'clients_account_statement' &&
                                                    $model != 'suppliers_report' &&
                                                    $model != 'suppliers_account_statement' &&
                                                    $model != 'taswea_client_supplier' &&
                                                    $model != 'partners_report' &&
                                                    $model != 'partners_account_statement' &&
                                                    $model != 'taswea_partners' &&
                                                    $model != 'sales' &&
                                                    $model != 'sales_create' &&
                                                    $model != 'sales_return' &&
                                                    $model != 'products_stock_alert' &&
                                                    $model != 'purchases' &&
                                                    $model != 'purchases_create' &&
                                                    $model != 'purchases_return' &&
                                                    $model != 'treasury_bills' &&
                                                    $model != 'treasury_bills_create' &&
                                                    $model != 'treasury_bills_report' &&
                                                    $model != 'transfer_between_storages' &&
                                                    $model != 'expenses' &&
                                                    $model != 'expenses_report' 
                                                )
                                                    <div class="form-check me-3 me-lg-5" id="{{ $model }}_update_div">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_update" {{ old(''.$model.'_update') ? 'checked' : '' }} {{ $find[''.$model.'_update'] == 1 ? 'checked' : '' }} id="{{ $model }}_update"/>
                                                        <label class="form-check-label text-primary" for="{{ $model }}_update">تحديث</label>
                                                    </div>
                                                @endif

                                                @if(
                                                    $model != 'financialYears' &&
                                                    $model != 'transfer_between_stores' &&
                                                    $model != 'taswea_products' &&
                                                    $model != 'clients_report' &&
                                                    $model != 'clients_account_statement' &&
                                                    $model != 'suppliers_report' &&
                                                    $model != 'suppliers_account_statement' &&
                                                    $model != 'taswea_client_supplier' &&
                                                    $model != 'partners_report' &&
                                                    $model != 'partners_account_statement' &&
                                                    $model != 'taswea_partners' &&
                                                    $model != 'sales' &&
                                                    $model != 'sales_create' &&
                                                    $model != 'sales_return' &&
                                                    $model != 'products_stock_alert' &&
                                                    $model != 'purchases' &&
                                                    $model != 'purchases_create' &&
                                                    $model != 'purchases_return' &&
                                                    $model != 'treasury_bills' &&
                                                    $model != 'treasury_bills_create' &&
                                                    $model != 'treasury_bills_report' &&
                                                    $model != 'transfer_between_storages' &&
                                                    $model != 'expenses_report' &&
                                                    $model != 'settings'
                                                )
                                                    <div class="form-check me-3 me-lg-5" id="{{ $model }}_delete_div">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_delete" {{ old(''.$model.'_delete') ? 'checked' : '' }} {{ $find[''.$model.'_delete'] == 1 ? 'checked' : '' }} id="{{ $model }}_delete"/>
                                                        <label class="form-check-label text-danger" for="{{ $model }}_delete">حذف</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>

{{--
                                        <td>
                                            <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5" id="{{ $model }}_create_div">
                                                <input class="form-check-input" type="checkbox" name="{{ $model }}_create" {{ old(''.$model.'_create') ? 'checked' : '' }} {{ $find[''.$model.'_create'] == 1 ? 'checked' : '' }} id="{{ $model }}_create"/>
                                                <label class="form-check-label" for="{{ $model }}_create">اضافة</label>
                                            </div>

                                            <div class="form-check me-3 me-lg-5" id="{{ $model }}_view_div">
                                                <input class="form-check-input" type="checkbox" name="{{ $model }}_view" {{ old(''.$model.'_view') ? 'checked' : '' }} {{ $find[''.$model.'_view'] == 1 ? 'checked' : '' }} id="{{ $model }}_view"/>
                                                <label class="form-check-label" for="{{ $model }}_view">عرض</label>
                                            </div>

                                            <div class="form-check me-3 me-lg-5" id="{{ $model }}_update_div">
                                                <input class="form-check-input" type="checkbox" name="{{ $model }}_update" {{ old(''.$model.'_update') ? 'checked' : '' }} {{ $find[''.$model.'_update'] == 1 ? 'checked' : '' }} id="{{ $model }}_update"/>
                                                <label class="form-check-label" for="{{ $model }}_update">تحديث</label>
                                            </div>

                                            <div class="form-check me-3 me-lg-5" id="{{ $model }}_delete_div">
                                                <input class="form-check-input" type="checkbox" name="{{ $model }}_delete" {{ old(''.$model.'_delete') ? 'checked' : '' }} {{ $find[''.$model.'_delete'] == 1 ? 'checked' : '' }} id="{{ $model }}_delete"/>
                                                <label class="form-check-label" for="{{ $model }}_delete">حذف</label>
                                            </div>
                                            </div>
                                        </td>--}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary-gradient waves-effect waves-light" id="save" style="display: block;width: 20%;height: 50px;margin: 0 auto;">تحديث</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection

