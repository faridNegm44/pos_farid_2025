@extends('back.layouts.app')

@section('title')
    الأذونات والتراخيص
@endsection

@section('header')
    <style>
        input[type="checkbox"]{
            width: 1.50em;
            height: 1.50em;
            margin-top: .165em;
            vertical-align: top;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            border: 1px solid #e3d9da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            margin: 0px 8px;
            position: relative;
            top: 3px;
        }

        /* #settings #create input,
        #settings #create label,
        
        #notebook_shortcomings #create,
        #notebook_shortcomings #create label,
        #notebook_shortcomings #update,
        #notebook_shortcomings #update label
        {
            display: none;
            cursor: auto;
        }
                
        #settings #create:after,
        #notebook_shortcomings #create:after,
        #notebook_shortcomings #update:after
        {
            content: '--------';
            cursor: auto;
        } */

        table tr td:nth-child(2){
            cursor: pointer;
        }
    </style>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {

            $("#settings #create, #settings #update,#notebook_shortcomings #create, #notebook_shortcomings #update, #change_categoory_price #create, #change_categoory_price #view").html("--------");



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

        $('table tr td:nth-child(2)').on('click', function(){
            const checkboxes = $(this).closest("tr").find("input[type='checkbox']");
            checkboxes.prop("checked", !$(this).hasClass("checked"));
            
            $(this).toggleClass("checked");
        });
    </script>
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            @if (auth()->user()->role_relation->permissions_create == 1 )
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">الأذونات والتراخيص</h4>
                            </div>
                        </div>
                    </div>

                    @php
                        $models = ['branches', 'fiscal_years', 'financial_treasury', 'stores', 'dismissal_notices', 'treasury_bills', 'clients', 'suppliers', 'users', 'products', 'products_categories', 'change_categoory_price', 'notebook_shortcomings', 'units', 'barcode', 'sales', 'add_sale_return', 'purchases', 'add_purchase_return', 'expenses', 'settings', 'permissions'];                    
                        $count = 1;
                    @endphp

                    {{-- /////////////////////////////////////  Table  ///////////////////////////////////////////////////////////// --}}
                    <form action="{{ url('roles_permissions/store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div style="overflow: auto;">
                                    <div style="padding: 0px 5px 20px;">
                                        <label for="role_name">اسم الإذن</label>
                                        
                                        <input type="text" class="form-control" name="role_name" id="role_name" placeholder="اسم الإذن" value="{{ old('role_name') }}" required />

                                        @if($errors->has('role_name'))
                                            <div class="error">{{ $errors->first('role_name') }}</div>
                                        @endif
                                    </div>

                                    <table class="table table-responsive table-hover table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <td>#</td>
                                                <td>الاسم</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                                        <label class="form-check-label" for="selectAll">
                                                        إختر الكل
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($models as $model)
                                                <tr style="font-weight: bold;" id="{{ $model }}">
                                                    <td class="text-nowrap fw-semibold">{{ $count++ }}</td>
                                                    <td class="text-nowrap fw-semibold">@lang('app.'.$model)</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="form-check me-3 me-lg-5" id="view">
                                                                <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_view" {{ old(''.$model.'_view') ? 'checked' : '' }} id="{{ $model }}_view"/>
                                                                <label class="form-check-label" for="{{ $model }}_view">
                                                                عرض
                                                                </label>
                                                            </div>
                                                            
                                                            <div class="form-check me-3 me-lg-5" id="create">
                                                                <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_create" {{ old(''.$model.'_create') ? 'checked' : '' }} id="{{ $model }}_create"/>
                                                                <label class="form-check-label" for="{{ $model }}_create">
                                                                اضافة
                                                                </label>
                                                            </div>
                                            
                                                            <div class="form-check me-3 me-lg-5" id="update">
                                                                <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_update" {{ old(''.$model.'_update') ? 'checked' : '' }} id="{{ $model }}_update"/>
                                                                <label class="form-check-label" for="{{ $model }}_update">
                                                                تحديث
                                                                </label>
                                                            </div>

                                                            {{-- <div class="form-check me-3 me-lg-5" id="delete">
                                                                <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_delete" {{ old(''.$model.'_delete') ? 'checked' : '' }} id="{{ $model }}_delete"/>
                                                                <label class="form-check-label" for="{{ $model }}_delete">
                                                                حذف
                                                                </label>
                                                            </div>
 --}}
                                                            @if ($model == 'fiscal_years')                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_close" {{ old(''.$model.'_close') ? 'checked' : '' }} id="{{ $model }}_close"/>
                                                                    <label class="form-check-label" for="{{ $model }}_close">
                                                                        قفل سنة مالية
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            
                                                            @if ($model == 'clients')                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_import" {{ old(''.$model.'_import') ? 'checked' : '' }} id="{{ $model }}_import"/>
                                                                    <label class="form-check-label" for="{{ $model }}_import">
                                                                        استيراد العملاء
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            
                                                            @if ($model == 'suppliers')                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_import" {{ old(''.$model.'_import') ? 'checked' : '' }} id="{{ $model }}_import"/>
                                                                    <label class="form-check-label" for="{{ $model }}_import">
                                                                        استيراد الموردين
                                                                    </label>
                                                                </div>
                                                            @endif     

                                                            @if ($model == 'sales')                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_bill_details" {{ old(''.$model.'_bill_details') ? 'checked' : '' }} id="{{ $model }}_bill_details"/>
                                                                    <label class="form-check-label" for="{{ $model }}_bill_details">
                                                                        تفاصيل فاتورة
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_netProfit" {{ old(''.$model.'_netProfit') ? 'checked' : '' }} id="{{ $model }}_netProfit"/>
                                                                    <label class="form-check-label" for="{{ $model }}_netProfit">
                                                                        صافي الربح
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_bonus" {{ old(''.$model.'_bonus') ? 'checked' : '' }} id="{{ $model }}_bonus"/>
                                                                    <label class="form-check-label" for="{{ $model }}_bonus">
                                                                        بونص
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_discount" {{ old(''.$model.'_discount') ? 'checked' : '' }} id="{{ $model }}_discount"/>
                                                                    <label class="form-check-label" for="{{ $model }}_discount">
                                                                        خصم
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_tax" {{ old(''.$model.'_tax') ? 'checked' : '' }} id="{{ $model }}_tax"/>
                                                                    <label class="form-check-label" for="{{ $model }}_tax">
                                                                        ضريبة
                                                                    </label>
                                                                </div>
                                                            @endif  

                                                            @if ($model == 'purchases')                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_bill_details" {{ old(''.$model.'_bill_details') ? 'checked' : '' }} id="{{ $model }}_bill_details"/>
                                                                    <label class="form-check-label" for="{{ $model }}_bill_details">
                                                                        تفاصيل فاتورة
                                                                    </label>
                                                                </div>
                                                                                                                                                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_bonus" {{ old(''.$model.'_bonus') ? 'checked' : '' }} id="{{ $model }}_bonus"/>
                                                                    <label class="form-check-label" for="{{ $model }}_bonus">
                                                                        بونص
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_discount" {{ old(''.$model.'_discount') ? 'checked' : '' }} id="{{ $model }}_discount"/>
                                                                    <label class="form-check-label" for="{{ $model }}_discount">
                                                                        خصم
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_tax" {{ old(''.$model.'_tax') ? 'checked' : '' }} id="{{ $model }}_tax"/>
                                                                    <label class="form-check-label" for="{{ $model }}_tax">
                                                                        ضريبة
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_treasury_info" {{ old(''.$model.'_treasury_info') ? 'checked' : '' }} id="{{ $model }}_treasury_info"/>
                                                                    <label class="form-check-label" for="{{ $model }}_treasury_info">
                                                                        بيانات الخزينة
                                                                    </label>
                                                                </div>
                                                                
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input {{ $model }}" type="checkbox" name="{{ $model }}_supplier_info" {{ old(''.$model.'_supplier_info') ? 'checked' : '' }} id="{{ $model }}_supplier_info"/>
                                                                    <label class="form-check-label" for="{{ $model }}_supplier_info">
                                                                        بيانات المورد
                                                                    </label>
                                                                </div>
                                                            @endif                                                                                                                                                                                                                                                                                                                                            

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <br>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="save" style="display: block;width: 100%;height: 50px;">حفظ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <h4 class="text-center" style="margin: 100px auto;">
                    لاتمتلك الصلاحيات لرؤيه محتوي الصفحة
                    <img src="{{ url('back/images/rej2.png') }}" style="width: 80px;height: 78px;position: relative;bottom: 7px;bo"/>
                </h4>
            @endif    

        </div>


        {{-- Include Footer --}}
        @include('back.layouts.footer')
    </div>
@endsection
