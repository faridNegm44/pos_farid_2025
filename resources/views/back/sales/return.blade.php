<!doctype html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Title -->
        <title> {{ GeneralSettingsInfo()->app_name }}: {{ $pageNameAr }} {{ $find[0]->id }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>

        <!-- Bootstrap css-->
        <link href="{{ asset('back') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- Icons css -->
        <link href="{{ asset('back') }}/assets/css-rtl/icons.css" rel="stylesheet">
        
        <!-- Style css -->
        <link href="{{ asset('back') }}/assets/css-rtl/style.css" rel="stylesheet">
        <link href="{{ asset('back') }}/assets/css-rtl/style-dark.css" rel="stylesheet">

        <!--  Right-sidemenu css -->
        <link href="{{ asset('back') }}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

        {{-- alertify --}}
        <link href="{{ asset('back/assets/css-rtl/alertify.rtl.min.css') }}" type="text/css" rel="stylesheet"/>
        <link href="{{ asset('back/assets/css-rtl/default.rtl.min.css') }}" type="text/css" rel="stylesheet"/>

        {{-- selectize --}}
        <link href="{{ asset('back/assets/selectize.css') }}" type="text/css" rel="stylesheet"/>

        <!-- Skinmodes css -->
        <link href="{{ asset('back') }}/assets/css-rtl/skin-modes.css" rel="stylesheet" />

        <!-- Animations css -->
        <link href="{{ asset('back') }}/assets/css-rtl/animate.css" rel="stylesheet">

        {{-- custom css --}}
        <link href="{{ asset('back/assets/custom.css') }}" rel="stylesheet">

        <style>
            @font-face {
                font-family: "4_F4";
                src: url("{{ asset('back/fonts/4_F4.ttf') }}");
            }
            body{
                /* font-family: Arial, Helvetica, sans-serif, serif; */
                font-family: "4_F4", serif;
                overflow: hidden; 
                height: 100vh; 
                display: flex; 
                flex-direction: column; 

            }

            .page {
              overflow-y: auto;
              flex-grow: 1; 
              height: 100%;
            }
         
            .selectize-dropdown .active {
                background-color: #ead298 !important;
                color: #030303 !important;
            }
            .selectize-dropdown option {
                padding: 5px !important;
            }

            .selectize-control .input-active{
                border: 2px solid brown !important;
                color: #030303 !important;
            }

            .form-control:disabled, .form-control[readonly] {
                border: 0px solid !important;
                /*background: transparent !important;*/
            }
            .dark_theme{
                display: none;
            }
            @media (max-width: 991px) {
                #top_section {
                    margin-top: 30px;
                }
            }

            .custom_check {
                -webkit-appearance: none;
                appearance: none;
                width: 18px;
                height: 18px;
                border: 2px solid transparent;
                border-radius: 4px;
                background-color: transparent;
                cursor: pointer;
                transition: all 0.3s;
                position: relative;
            }

            .custom_check:checked {
                background-color: #c0180c; /* الخلفية عند التحديد */
                border-color: #c0180c;
            }

            .custom_check:checked::after {
                content: '';
                position: absolute;
                top: 3px;
                left: 5px;
                width: 4px;
                height: 8px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }

            .ajs-error{
                min-width: 500px !important;
            }
        </style>
    </head>

    @include('back.bills_css_js.css_js.main_css')

<body style="height: 100vh !important;overflow: auto;background: #d8c1e5 !important;">

    <div id="overlay_page"></div>

    
    {{--@include('back.layouts.navbar')--}}
    
    <div class="page" id="page_sales">        
        @include('back.layouts.header')

        @include('back.layouts.calc')
    
        {{--@include('back.sales_return.modal_search_product')--}}
        {{--@include('back.sales_return.modal_dismissal_notices')--}}
    
        
        
        <form>
            @csrf
            @include('back.sales_return.modal_save_bill')
            

            <div class="container-fluid">
    
                {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                <div id="top_section" style="padding: 7px 10px 0;">
                    <div class="row">
                        <div class="col-lg-6">
                            العميل: 
                            <span id="client_id">{{ $find[0]->clientName }}</span>
                        </div>
                        
                        <div class="col-lg-6"> 
                            <span id="custom_bill_num">{{ $find[0]->custom_bill_num ? 'رقم مخصص: '.$find[0]->custom_bill_num : '' }}</span>
                        </div>
                        
                        
                    </div>
                </div>
                {{-------------------------------------------------- end top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- end top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                



                {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{--<div id="top_section" style="padding: 7px 10px 0;">
                    <div class="row">                        
                        <div class="col-12" style="margin-bottom: 8px;">
                            <select class="" id="products_selectize" style="border: 1px solid #5c5c5c !important;">
                                <option value="" selected>إبحث عن سلعة/خدمة</option>         
                            </select>
                        </div>
                    </div>
                </div>--}}
                {{-------------------------------------------------- end top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- end top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}


    
    
    
    
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                <div class="" id="main_content" style="padding: 18px;margin-bottom: 60px;">
                    <div class="row"> 
    
                        <div class="col-lg-4 product-selection p-3 total_info" style="background: #703591;">
                            <div class="text-center" style="text-decoration: underline;background: #42175b;color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
                                {{ $pageNameAr }}
                                <span style="font-size: 18px;margin: 0px 5px;" id="nextBillNum">{{ $find[0]->id }}</span>
                            </div>
                            
                            <div class="text-center" id="date_time" style="font-size: 25px !important;margin-top: 10px;">
                                <span class="badge badge-light" id="date"></span>
                                <span class="badge badge-danger mx-2" id="time"></span>
                            </div>
        
                            <br>
        
                            <div class="total-bar d-flex align-items-center justify-content-between" style="padding: 10px;border: 2px solid #cccccc;background-color: #ededed;">
                                <div class="row">
                                    @if (userPermissions()->tax_bill_view)                                        
                                        <p class="col-lg-6 col-12">
                                            <label for="">
                                                ضريبة ق م (%)
                                                <i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="⚠️ مثل: 10% او 5% وهكذا سيتم تطبيقها علي جميع الأصناف."></i>
                                            </label>
                                            <input autocomplete="off" type="text" class="form-control focus_input numValid text-center" id="tax_bill" placeholder="ضريبة ق م (%)" style="font-size: 12px;" />
                                        </p>
                                    @endif                                    
                                                                        
                                    <p class="col-lg-6 col-12">
                                        <label for="">
                                            خصم قيمة
                                            <i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="⚠️ مثل: 100 جنية او 50 جنية وهكذا."></i>
                                        </label>
                                        <input autocomplete="off" type="text" class="form-control focus_input numValid text-center" id="bill_discount" name="bill_discount" placeholder="خصم قيمة" style="font-size: 12px;" value="{{ display_number( $find[0]->bill_discount ) }}"/>
                                    </p>
                                    
                                    <div class="col-12">
                                        <label for="extra_money_type" class="form-label">
                                            مصاريف إضافية
                                            <i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="💡 أدخل مبلغ المصاريف الإضافية إن وجد"></i>
                                        </label>
                                    
                                        <div class="row">
                                            <div class="col-md-7 mb-2">
                                                <select class="form-control" name="extra_money_type" id="extra_money_type">
                                                    <option value="" selected>اختر مصروف إضافي</option>
                                                    @foreach ($extra_expenses as $item)
                                                        <option value="{{ $item->id }}" 
                                                            {{ $find[0]->extra_money_type ? 
                                                                    $find[0]->extra_money_type ==  $item->id ? 'selected' : ''  
                                                                :  ''
                                                            }} 
                                                        >
                                                        {{ $item->expense_type }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <div class="col-md-5">
                                                <input autocomplete="off" type="text" class="form-control text-center numValid focus_input" id="extra_money" name="extra_money" placeholder="مبلغ المصاريف" style="font-size: 12px;" value="{{ display_number( $find[0]->extra_money ) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                
                                    <ul class="row" style="font-size: 11px;">
                                        <li class="col-6 mb-2">
                                            العناصر:
                                            <strong style="font-size: 16px; color: #007bff;">
                                                {{ display_number($find[0]->count_items) }}
                                            </strong>
                                        </li>

                                        <li class="col-6 mb-2">
                                            المبيعات:
                                            <strong style="font-size: 16px; color: #28a745;">
                                                {{ display_number($find[0]->total_bill_before) }}
                                            </strong>
                                        </li>

                                        <li class="col-6 mb-2">
                                            المرتجعات:
                                            <strong style="font-size: 16px; color: #dc3545;">
                                                {{ display_number($find[0]->total_returns ?? 0) }}
                                            </strong>
                                        </li>

                                        <li class="col-6 mb-2">
                                            الصافي:
                                            <strong style="font-size: 16px; color: #ffc107;">
                                                {{ display_number(($find[0]->total_bill_before ?? 0) - ($find[0]->total_returns ?? 0)) }}
                                            </strong>
                                        </li>
                                    </ul>



                                    <p class="col-lg-12">
                                        <div style="width: 97%;background: #eeb50a;color: black;padding: 7px;text-align: center;margin: auto;">
                                            <span style="font-size: 12px;">الإجمالي المستحق: </span>
                                            <span style="font-size: 24px;" class="total_bill_after">{{ display_number( $find[0]->total_bill_after ) }}</span>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
    
    
    
                        <div class="col-lg-8" style="height: 77vh; overflow: auto; padding: 10px 10px 30px; background-image: url('{{ url('back/images/settings/farid logo bg pos white.png') }}'); background-size: cover; background-repeat: no-repeat;">
                            <table class="table table-hover table-bordered" id="products_table">                                
                                <thead class="bg bg-black-5">
                                    <tr>
                                        <th style="width: 20px !important;min-width: 20px !important;">#</th>
                                        <th class="nowarp_thead" style="width: 30px !important;min-width: 30px !important;">التحكم</th>
                                        <th class="nowarp_thead" style="width: 220px !important;min-width: 220px !important;">السلعة/الخدمة</th>
                                        <th class="nowarp_thead" style="width: 80px !important;min-width: 80px !important;">الوحدة</th>
                                        <th class="nowarp_thead" style="width: 80px !important;min-width: 80px !important;">ك المخزن</th>
                                        <th class="nowarp_thead" style="width: 80px !important;min-width: 80px !important;">ك مباعة</th>
                                        <th class="nowarp_thead" style="width: 80px !important;min-width: 80px !important;">ك مرتجعة</th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">س بيع</th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">خصم%</th>                                                                                        
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;display: none;">ضريبة%</th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">الإجمالي</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @foreach ($find as $item)
                                        <tr id="tr_{{ $item->product_id }}">
                                            <th>{{ $item->product_id }}</th>
                                            <td>
                                                <button type="button" class="btn btn-link p-0 return-row-btn" data-row-id="{{ $item->store_det_id }}" title="إرجاع" style="color:#d84458;">
                                                    <i class="fas fa-reply fa-lg"></i>
                                                </button>
                                            </td>
                                            <td class="prod_name">
                                                {{ $item->productNameAr }}
                                                <input autocomplete="off" type='hidden' name="prod_name" value="{{ $item->product_id }}" />
                                            </td>
                                            <td class="">
                                                <span>{{ $item->smallUnitName }}</span>
                                                <input autocomplete="off" type='hidden' class='small_unit_numbers' value='{{ display_number( $item->small_unit_numbers ) }}' />      
                                            </td>
                                            <td>
                                                <input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center quantity_all" value="{{ display_number( round($item->quantity_small_unit) ) }}">                    
                                            </td>
                                            <td>
                                                <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput" value="{{ display_number(round($item->product_bill_quantity)) }}" >
                                            </td>
                                            <td>
                                                <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sale_quantity" name="sale_quantity" value="0" >
                                            </td>
                                            <td>
                                                <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sellPrice" name="sellPrice" value="{{ 
                                                                    $item->current_sell_price_in_sale_bill != $item->sell_price_small_unit ? 
                                                                        display_number( $item->current_sell_price_in_sale_bill ) : 
                                                                        display_number( $item->sell_price_small_unit ) 
                                                                }}">                                    
                                            </td>
                                            <td>
                                                <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_discount" name="prod_discount" value="{{ display_number( $item->discount ) }}">
                                            </td>
                                            <td style="display: none;">
                                                <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_tax" name="prod_tax" value="{{ display_number( $item->tax ) }}">
                                            </td>
                                            <td>
                                                <input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center focus_input prod_total" name="prod_total" value="{{ display_number( $item->total_after ) }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                     </div> 
                </div>
                {{-------------------------------------------------- end content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                {{-------------------------------------------------- end content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}   
            </div>
        </form>
        
        @include('back.layouts.notification_sidebar')
    </div>
    

    <!-- JQuery min js -->
    <script src="{{ asset('back') }}/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/bootstrap-rtl.js"></script>

    <!-- Horizontalmenu js-->
    <script src="{{ asset('back') }}/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

    <!-- Internal Modal js-->
    <script src="{{ url('back') }}/assets/js/modal.js"></script>

    {{-- bootstrap.bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <!-- alertify -->
    <script src="{{ asset('back/assets/js/alertify.min.js') }}"></script>

    <!-- Right-sidebar js -->
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-rtl.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-custom.js"></script>

    <!-- selectize -->
    <script src="{{ asset('back/assets/selectize.min.js') }}"></script>

    {{-- general scripts file js --}}
    @include('back.layouts.general_scripts')

    <!-- custom js -->
    <script src="{{ asset('back') }}/assets/js/custom.js"></script>

    <!-- Helper js -->
    <script src="{{ asset('back') }}/assets/helpers.js"></script>







    {{-------------------------------------------------------------------------------------------------------------------------}}
    {{-------------------------------------------------------------------------------------------------------------------------}}
    {{-------------------------------------------------------------------------------------------------------------------------}}
    {{-------------------------------------------------------------------------------------------------------------------------}}
    {{----------------------------------------------------      START JS SCRIPTS      -----------------------------------------}}
    {{-------------------------------------------------------------------------------------------------------------------------}}
    {{-------------------------------------------------------------------------------------------------------------------------}}
    {{-------------------------------------------------------------------------------------------------------------------------}}
    {{-------------------------------------------------------------------------------------------------------------------------}}







    @include('back.bills_css_js.css_js.main_js')

    {{-- start general scripts --}}
        <script>
            ////////////////////////////// start when click return-row-btn تعديل صف من جدول الأصناف ////////////////////////////
            $(document).on('click', '.return-row-btn', function() {
                var rowId = $(this).data('row-id');
                var rowProductBillQuantity = $(this).closest('tr').find('.sale_quantity').val();

                alertify.confirm(
                'تحذير هام <i class="fas fa-exclamation-triangle text-warning" style="margin:0 3px;"></i>',
                `<div style='text-align:center;background-color:#e5d5ee; padding:15px; border-radius:5px;'>
                    <p class='text-danger' style='font-size:14px;'>
                        هل أنت متأكد من عمل مرتجع لهذا الصنف في الفاتورة الحالية؟ 🔄
                    </p>
                    <div style='margin-top: 10px !important;'>
                        ⚠️ هذا الإجراء لا يمكن التراجع عنه، وسيؤثر على حساب العميل 💰 ومخزون الصنف 📦.
                    </div>
                </div>`,
                function() {
                    $.ajax({
                        url: `{{ url('sales/return_product_from_bill') }}/${rowId}`,
                        type: "GET",
                        data: {
                            rowId: rowId, 
                            rowProductBillQuantity: rowProductBillQuantity,
                        },
                        success: function(res) {
                            if(res.notAuth){
                                alertify.dialog('alert')
                                    .set({transition:'slide',message: `
                                        <div style='text-align:center;padding:15px; border-radius:5px;background: #ccacba;'>
                                            <p style='color:#e67e22;font-size:18px;margin-bottom:10px;'>صلاحية غير متوفرة 🔐⚠️</p>
                                            <p>${res.notAuth}</p>
                                        </div>
                                    `, 'basic': true})
                                    .show();
                                $(".modal").modal('hide');
                            }else{
                                if(res.no_edits){
                                    alertify.dialog('alert')
                                    .set({transition:'slide',message: `
                                        <div style='text-align:center;padding:15px; border-radius:5px;background: #ccacba;'>
                                            <p>${res.no_edits}</p>
                                        </div>
                                    `, 'basic': true})
                                    .show();
                                }
                                
                                if(res.error_quantity){
                                    alertify.dialog('alert')
                                    .set({transition:'slide',message: `
                                        <div style='text-align:center;padding:15px; border-radius:5px;background: #ccacba;'>
                                            <p class="p-1">⚠️ لا يمكن إتمام المرتجع!</p>
                                            <p class="p-1">الكمية المرتجعة أكبر من الكمية المباعة في الفاتورة. 🧾📦</p>
                                        </div>
                                    `, 'basic': true})
                                    .show();
                                }
                                
                                if(res.error_quantity_zero){
                                    alertify.set('notifier','position','top-center');
                                    alertify.set('notifier','delay',6);
                                    alertify.error(`${res.error_quantity_zero}`);
                                }

                                if(res.success_edit){
                                    alert(
                                        "تم تعديل بيانات الصنف بنجاح ✅.\n" +
                                        "💰 تم تعديل حساب العميل بناءً على التعديلات الأخيرة."
                                    );

                                    location.reload();
                                }

                                if(res.cannot_delete){
                                    alertify.set('notifier','position','top-center');
                                    alertify.set('notifier','delay',6);
                                    alertify.warning('خطأ: لا يمكن حذف الفاتورة لارتباطها بسجلات أخرى.');
                                }
                            }
                        },
                        error: function(){
                            alertify.error('حدث خطأ أثناء محاولة حذف الفاتورة');
                        }
                    });
                    },
                    function(){}
                ).set({
                    labels:{
                        ok:"نعم <i class='fas fa-check text-success' style='margin:0 3px;'></i>",
                        cancel:"لا <i class='fa fa-times text-light' style='margin:0 3px;'></i>"
                    }
                });
            });
            ////////////////////////////// end when click return-row-btn تعديل صف من جدول الأصناف ////////////////////////////
        </script>
    {{-- end general scripts --}}
    
    
</body>
</html>
