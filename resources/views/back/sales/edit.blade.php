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
        </style>
    </head>

    @include('back.bills_css_js.css_js.main_css')

<body style="height: 100vh !important;overflow: auto;background: #b4c7e0 !important;">

    <div id="overlay_page"></div>

    
    {{--@include('back.layouts.navbar')--}}
    
    <div class="page" id="page_sales">        
        @include('back.layouts.header')

        @include('back.layouts.calc')
    
        <div class="container-fluid">

            {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
            {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
            <div id="top_section" style="padding: 7px 10px 0;">
                <div class="row">
                    <div class="col-lg-6">
                        العميل: 
                        <span id="client_id">{{ $find[0]->clientName }}</span>
                        @if ($userInfo >= 0)
                            <span class="badge badge-success" style="font-size: 120%;margin: 0 10px;">علية: {{ display_number($userInfo) }} جنية</span>
                            
                        @else
                            <span class="badge badge-danger" style="font-size: 120%;margin: 0 10px;">لة: {{ display_number($userInfo) }} جنية</span>                                
                        @endif
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

                    <div class="col-lg-4 product-selection p-3 total_info" style="background: #748DAE;">
                        <div class="text-center" style="text-decoration: underline;background: rgb(76 101 134);color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
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
                                    <p class="col-lg-6 col-12 d-none">
                                        <label for="">
                                            ضريبة ق م (%)
                                            {{--<i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="⚠️ مثل: 10% او 5% وهكذا سيتم تطبيقها علي جميع الأصناف."></i>--}}
                                        </label>
                                        <input autocomplete="off" readonly type="text" class="form-control focus_input numValid text-center" id="tax_bill" placeholder="ضريبة ق م (%)" style="font-size: 12px;" />
                                    </p>
                                @endif                                    
                                                                    
                                <p class="col-12">
                                    <label for="">
                                        خصم قيمة
                                        {{--<i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="⚠️ مثل: 100 جنية او 50 جنية وهكذا."></i>--}}
                                    </label>
                                    <input autocomplete="off" readonly type="text" class="form-control focus_input numValid text-center" id="bill_discount" name="bill_discount" placeholder="خصم قيمة" style="font-size: 12px;" value="{{ display_number( $find[0]->bill_discount ) }}"/>
                                </p>
                                
                                <div class="col-12">
                                    <label for="extra_money_type" class="form-label">
                                        مصاريف إضافية
                                        {{--<i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="💡 أدخل مبلغ المصاريف الإضافية إن وجد"></i>--}}
                                    </label>
                                
                                    <div class="row">
                                        <div class="col-md-7 mb-2">
                                            <select class="form-control" disabled name="extra_money_type" id="extra_money_type">
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
                                            <input autocomplete="off" readonly type="text" class="form-control text-center numValid focus_input" id="extra_money" name="extra_money" placeholder="مبلغ المصاريف" style="font-size: 12px;" value="{{ display_number( $find[0]->extra_money ) }}"/>
                                        </div>
                                    </div>
                                </div>
                                
                            
                                <ul class="row" style="font-size: 11px;">
                                    <li class="col-12 mb-2">
                                        العناصر:
                                        <strong style="font-size: 16px; color: #007bff;">
                                            {{ display_number($find[0]->count_items) }}
                                        </strong>
                                    </li>

                                    <li class="col-12 mb-2">
                                        الإجمالي الأساسي:
                                        <strong style="font-size: 20px; color: #28a745;">
                                            {{ display_number($find[0]->total_bill_before) }}
                                        </strong>
                                    </li>
                                </ul>



                                <p class="col-lg-12">
                                    <div style="width: 97%;background: #eeb50a;color: black;padding: 7px;text-align: center;margin: auto;">
                                        <span style="font-size: 12px;">صافي الفاتورة: </span>
                                        <span style="font-size: 24px;" class="total_bill_after">{{ display_number( $find[0]->total_bill_after ) }}</span>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-8" style="height: 77vh; overflow: auto; padding: 10px 10px 30px; background-image: url('{{ url('back/images/settings/farid logo bg pos white.png') }}'); background-size: cover; background-repeat: no-repeat;">
                        <table class="table table-hover table-bordered" id="products_table">                                
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th class="nowarp_thead" style="width: 60px !important;min-width: 60px !important;">التحكم</th>
                                    <th class="nowarp_thead" style="width: 250px !important;min-width: 250px !important;">السلعة/الخدمة</th>
                                    <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">الوحدة</th>
                                    <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">ك المخزن</th>
                                    <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">
                                        ك مباعة
                                        <i class="fas fa-info-circle text-warning" data-bs-toggle="tooltip" title="⚠️ يُرجى إتمام عملية البيع باستخدام الوحدة الصغرى للمنتج، وذلك لضمان دقة العمليات الحسابية وسلامة بيانات الفاتورة."></i>
                                    </th>
                                    <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">س بيع</th>
                                    <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">خصم%</th>                                                                                        
                                    <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;display: none;">ضريبة%</th>
                                    <th class="nowarp_thead" style="width: 150px !important;min-width: 150px !important;">الإجمالي</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                @foreach ($find as $item)
                                    <tr id="tr_{{ $item->product_id }}">
                                        <th>{{ $item->product_id }}</th>
                                        <td>
                                            <button type="button" class="btn btn-link p-0 delete-row-btn" data-row-id="{{ $item->store_det_id }}" title="حذف" style="color:#e74c3c;">
                                                <i class="fas fa-trash-alt fa-lg"></i>
                                            </button>
                                            {{--<button type="button" class="btn btn-link p-0 edit-row-btn" data-row-id="{{ $item->store_det_id }}" title="تعديل" style="color:#2980b9;">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>--}}
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
                                            <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sale_quantity" name="sale_quantity" value="{{ display_number(round($item->product_bill_quantity)) }}" >
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


    {{--  start search products by selectize #products_selectize --}}
        {{--<script>
            $(document).ready(function() {
                // بدايه الجزء الخاص بالبحث وعرض العملاء في selectize
                $('#products_selectize').selectize({
                    valueField: 'id',  // القيمة المخزنة عند الاختيار
                    labelField: 'nameAr', // النص الظاهر للمستخدم
                    searchField: ['id', 'nameAr', 'nameEn', 'natCode', 'shortCode'], // البحث في كل الحقول
                    loadThrottle: 300, // تقليل عدد الطلبات عند البحث
                    maxItems: 1, // اختيار عنصر واحد فقط
                    create: false, // منع إضافة عناصر جديدة
                    preload: 'focus', // تحميل البيانات عند التركيز على الحقل
                    render: {
                        option: function(item, escape) {
                            const quantity = escape(item.quantity_small_unit);
                            const disabled = quantity == 0 ? 'style="background:#f8d7da; color:#721c24; cursor: not-allowed;" disabled' : '';                        

                            return `<option ${disabled}>
                                        كود: ${escape(item.id)} - 
                                        السلعة/الخدمة: ${escape(item.nameAr)} - 
                                        س بيع: ${ display_number_js( escape(item.sell_price_small_unit) ) } -                                 
                                        كمية ص: ${ display_number_js( escape(item.quantity_small_unit) ) } ${ escape(item.smallUnitName) }
                                    </option>`;
                                    //${ escape(item.quantity_small_unit) == 0 ? '' : ' - كمية ك: ' + display_number_js( escape(item.quantity_small_unit) / escape(item.small_unit_numbers) ) + ' ' + escape(item.bigUnitName) }
                        },
                        item: function(item, escape) {
                            return `<div>
                                        كود: ${escape(item.id)} - 
                                        السلعة/الخدمة: ${escape(item.nameAr)} - 
                                        س بيع: ${ display_number_js( escape(item.sell_price_small_unit) ) } - 
                                        كمية ص: ${ display_number_js( escape(item.quantity_small_unit) ) } ${ escape(item.smallUnitName) }
                                    </div>`;
                        }
                    },
                    load: function(query, callback) {
                        if (!query.length) return callback();
                        $.ajax({
                            url: `{{ url('search_products_by_selectize') }}`, // رابط البحث
                            type: 'GET',
                            dataType: 'json',
                            data: { data_input_search: query },
                            success: function(response) {
                                if (response.items && Array.isArray(response.items)) {
                                    callback(response.items);
                                } else {
                                    console.error("البيانات غير صحيحة:", response);
                                    callback([]);
                                }
                            },
                            error: function(error) {
                                console.error("خطأ في جلب البيانات:", error);
                                callback([]);
                            }
                        });
                    }
                });
                // نهاية الجزء الخاص بالبحث وعرض العملاء في selectize



                // بدايه اختيار سلعة/خدمة من selectize واضافته في في جدول العملاء            
                $('#products_selectize').change(function() {
                    
                    var productId = $(this).val();
                    var selectizeInstance = $(this)[0].selectize; // الحصول على instance من selectize
                    var selectedItem = selectizeInstance.getItem(productId); // الحصول على العنصر المحدد

                    if (selectedItem) {
                        var productData = selectizeInstance.options[productId]; // بيانات العنصر المحدد
                        var productName = productData.nameAr; // اسم السلعة/الخدمة
                        
                        var smallUnit = productData.smallUnit; // الوحدة الصغري
                        var smallUnitName = productData.smallUnitName; // الوحدة الصغري
                        var small_unit_numbers = display_number_js(productData.small_unit_numbers); // الوحدة الصغري
                        
                        var bigUnit = productData.bigUnit; // الوحدة الكبري
                        var bigUnitName = productData.bigUnitName; // الوحدة الكبري
                        
                        var sellPrice = productData.sell_price_small_unit == null ? 0 : display_number_js(productData.sell_price_small_unit); // سعر البيع
                        var purchasePrice = productData.last_cost_price_small_unit == null ? 0 :  display_number_js(productData.last_cost_price_small_unit); // سعر الشراء
                        var purchasePriceAvg = productData.avg_cost_price_small_unit == null ? 0 :  display_number_js(productData.last_cost_price_small_unit); // سعر الشراء
                        var discount = productData.prod_discount == null ? 0 : display_number_js(productData.prod_discount); // خصم المنتج
                        var tax = productData.prod_tax == null ? 0 : display_number_js(productData.prod_tax); // ضريبة المنتج
                        
                        var quantity_all = display_number_js(productData.quantity_small_unit); // كميه المخزن

                        
                        // بدايه التاكد لو في صلاحيه للمستخدم ع تغيير سعر البيع
                        if(@json(userPermissions()->sale_price_view)){
                            var sale_price_permissions = `
                                <td>
                                    <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sellPrice" name="sellPrice[]" value="${sellPrice}">  
                                </td>`;
                        }else{
                            var sale_price_permissions = `
                                <td>
                                    <input readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sellPrice" name="sellPrice[]" value="${sellPrice}">  
                                </td>`;
                        }
                        // نهاية التاكد لو في صلاحيه للمستخدم ع تغيير سعر البيع

                        // بدايه التاكد لو في صلاحيه للمستخدم ع الخصم
                        if(@json(userPermissions()->discount_bill_view)){
                            var discount_permissions = `
                                <td>
                                    <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_discount" name="prod_discount[]" value="${discount}">
                                </td>`;
                        }else{
                            var discount_permissions = `
                                <td>
                                    <input readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_discount" name="prod_discount[]" value="${discount}">
                                </td>`;
                        }
                        // نهاية التاكد لو في صلاحيه للمستخدم ع الخصم

                        // بدايه التاكد لو في صلاحيه للمستخدم ع الضريبة
                        if(@json(userPermissions()->tax_bill_view)){
                            var tax_permissions = `
                                <td style="display: none;">
                                    <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_tax" name="prod_tax[]" value="${tax}">
                                    <input autocomplete="off" type='hidden' class="last_cost_price_small_unit" name="last_cost_price_small_unit[]" value="${purchasePrice}" />
                                    <input autocomplete="off" type='hidden' class="avg_cost_price_small_unit" name="avg_cost_price_small_unit[]" value="${purchasePriceAvg}" />
                                </td>`;
                        }else{
                            var tax_permissions = `
                                <td style="display: none;">
                                    <input readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_tax" name="prod_tax[]" value="${tax}">
                                    <input autocomplete="off" type='hidden' class="last_cost_price_small_unit" name="last_cost_price_small_unit[]" value="${purchasePrice}" />
                                    <input autocomplete="off" type='hidden' class="avg_cost_price_small_unit" name="avg_cost_price_small_unit[]" value="${purchasePriceAvg}" />
                                </td>`;
                        }
                        // نهاية التاكد لو في صلاحيه للمستخدم ع الضريبة




                        // التاكد من ان كميه النتج في المخزن اكبر من 0
                        if (quantity_all == 0) {
                            alertify.set('notifier', 'position', 'bottom-center');
                            alertify.set('notifier', 'delay', 3);
                            alertify.error("لا يمكن اختيار منتج غير متوفر في المخزن");
                            selectizeInstance.clear();
                            return;
                        }
                        // التاكد من ان كميه النتج في المخزن اكبر من 0


                        //let bigAndSmallUnit = '';
                        //if(bigUnit == 0){
                        //    bigAndSmallUnit = `
                        //        <span>${smallUnitName}</span>
                        //        <input type="hidden" class='prod_units' value="${smallUnit}" name='prod_units[]'/>
                        //    `;
                        //}else{
                        //    bigAndSmallUnit = `
                        //        <select class='prod_units' name='prod_units[]'>
                        //            <option class='small_unit_class' value='${smallUnit}'>${smallUnitName}</option>    
                        //            <option class='big_unit_class' value='${bigUnit}'>${bigUnitName}</option>    
                        //        </select>
                        //    `;
                        //}

                        function appendToProductsTable() {

                            $('#products_table tbody').append(`
                                <tr id="tr_${productId}">
                                    <th>${productId}</th>
                                    <td>
                                        <button class="btn btn-danger btn-sm remove_this_tr" onclick="removeThisTr('#pos_create #products_table'); new Audio('{{ url('back/sounds/failed.mp3') }}').play();">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                    <td class="prod_name">
                                        ${productName}
                                        <input autocomplete="off" type='hidden' name="prod_name[]" value="${productId}" />
                                    </td>
                                    <td class="">
                                        ${smallUnitName}
                                        <input autocomplete="off" type='hidden' class='small_unit_numbers' value='${small_unit_numbers}' />      
                                    </td>
                                    <td>
                                        <input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center quantity_all" value="${quantity_all}">                    
                                    </td>
                                    <td><input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sale_quantity" name="sale_quantity[]" value="1">
                                    </td>                                                        

                                    ${sale_price_permissions}                                                                    
                                    ${discount_permissions}
                                    ${tax_permissions}

                                    <td><input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center focus_input prod_total" name="prod_total[]" value="0"></td>
                                    </tr>
                                `);
                                    //<td><input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_bonus" name="prod_bonus[]" value="0"></td>

                            alertify.set('notifier', 'position', 'bottom-center');
                            alertify.set('notifier', 'delay', 3);
                            alertify.success("تم إضافة المنتج لأصناف الفاتورة");

                            if(countTableTr() > 0){
                                $("#save_bill").fadeIn();
                            }

                        }

                        if (productId) {
                            if ($(`#products_table tbody #tr_${productId}`).length > 0) {
                                alertify.set('notifier', 'position', 'bottom-center');
                                alertify.set('notifier', 'delay', 3);
                                alertify.error("تم إضافة المنتج من قبل لأصناف الفاتورة");

                                const sale_quantity = $(`#products_table tbody #tr_${productId} .sale_quantity`);
                                const currentQty = parseInt(sale_quantity.val());
                                sale_quantity.val(currentQty + 1);

                                backgroundRedToSelectError(sale_quantity);
                                calcTotal();

                            } else {
                                appendToProductsTable();
                                $("#countTableTr span").text(countTableTr());
                                $("#products_selectize")[0].selectize.focus();
                                calcTotal();
                            }
                        }
                        selectizeInstance.clear();
                    }
                });
                // نهاية اختيار سلعة/خدمة من selectize واضافته في في جدول العملاء
            });
        </script>--}}
    {{--  end search products by selectize #products_selectize --}}

    

    {{-- start function calcTotal --}}
        {{--<script>
            function calcTotal() {
                let subTotal = 0;
                let total = 0;

                $('#products_table tbody tr').each(function() {
                    let row = $(this).closest('tr');

                    let sellPrice = parseFloat(row.find('.sellPrice').val()) || 0;  // سعر القطعة
                    let sale_quantity = parseInt(row.find('.sale_quantity').val()) || 0;  // الكمية المشتراة
                    let discount = parseFloat(row.find('.prod_discount').val()) || 0; // نسبة الخصم (%)
                    let tax = parseFloat(row.find('.prod_tax').val()) || 0; // نسبة الضريبة (%)


                    // 1. حساب إجمالي السعر قبل الخصم والضريبة
                    let totalBeforeDiscount = sellPrice * sale_quantity;

                    // 2. حساب الخصم
                    let discountAmount = (totalBeforeDiscount * discount) / 100;
                    let totalAfterDiscount = totalBeforeDiscount - discountAmount;

                    // 3. حساب الضريبة
                    let taxAmount = (totalAfterDiscount * tax) / 100;
                    let totalAfterTax = totalAfterDiscount + taxAmount;
                    
                    // 5. تحديث إجمالي الصف
                    row.find('.prod_total').val(display_number_js( totalAfterTax.toFixed(3) ) );

                    total += totalAfterTax;
                    subTotal += totalBeforeDiscount;
                });

                let bill_discount = $("#bill_discount").val(); 
                let extra_money = $("#extra_money").val(); 

                let afterDiscountBill = total - bill_discount;    
                let afterExtraMoney = Number(afterDiscountBill) + Number(extra_money);    

                // عرض الإجمالي الكلي في الـ div
                $('.subtotal').text( parseFloat(subTotal).toLocaleString() + ' جنية');
                $('.total_bill_after').text( afterExtraMoney + ' جنية');
                $('#remaining').text( parseFloat(afterExtraMoney).toLocaleString() + ' جنية'); 


                //if(bill_discount > total){
                //    alert('❌ لا يمكن أن يكون خصم الفاتورة أكبر من إجمالي السلع والخدمات بعد الخصومات.');
                //    $("#bill_discount").val(0);
                //    afterDiscountBill = total;
                //}
            }
        </script>--}}
    {{-- end function calcTotal --}}

    

    {{-- start when change tax_bill update prod_tax value --}}
        {{--<script>
            $(document).on('input', '#tax_bill', function () {
                const thisVal = $(this);
                
                if(countTableTr() == 0){
                    thisVal.val('');
                    alertify.set('notifier', 'position', 'bottom-center');
                    alertify.set('notifier', 'delay', 3);
                    alertify.error("خطأ: اضف أصناف أولا الي الفاتورة");
                }else{
                    $('.prod_tax').val( Number(thisVal.val()) );
                    calcTotal();
                }
            });
        </script>--}}
    {{-- end when change tax_bill update prod_tax value --}}
    
    
    
    {{-- start when change extra_money_type --}}
        {{--<script>
            $(document).on('input', '#extra_money_type', function () {
                const thisVal = $(this).val();

                if(thisVal){
                    $.ajax({
                        type: "GET",
                        url: `{{ url('get_info/extra_expenses') }}/${thisVal}`,
                        success: function(res){
                            alertify.set('notifier','position', 'bottom-center');
                            alertify.set('notifier','delay', 3);
                            alertify.success("تم استدعاء سعر هذا المصروف الإضافي بنجاح 💰");
                            
                            $('#extra_money').val( res.amount ? display_number_js(res.amount) : 0 );

                            calcTotal();
                        }
                    });       
                }else{
                    $('#extra_money').val('');
                }
            });
        </script>--}}
    {{-- end when change extra_money_type --}}

    

    {{-- start when change sellPrice, .sale_quantity, .prod_discount, .tax --}}
        {{--<script>
            $(document).ready(function () {
                $(document).on('input', '.sellPrice, .sale_quantity, .prod_discount, .prod_tax, #bill_discount, #extra_money, #extra_money_type', function () {
                    calcTotal();
                    //$("#overlay_page").fadeIn();
                    //$("#overlay_page").fadeOut();
                });
            });
        </script>--}}
    {{-- end when change sellPrice, .sale_quantity, .prod_discount, .tax --}}



    {{-- start general scripts --}}
        <script>
            ////////////////////////////// start when click edit-row-btn تعديل صف من جدول الأصناف ////////////////////////////
            //$(document).on('click', '.edit-row-btn', function() {
            //    var rowId = $(this).data('row-id');
            //    var rowSellPrice = $(this).closest('tr').find('.sellPrice').val();
            //    var rowProdDiscount = $(this).closest('tr').find('.prod_discount').val();
            //    var rowProdTax = $(this).closest('tr').find('.prod_tax').val();

            //    alertify.confirm(
            //    'تحذير هام <i class="fas fa-exclamation-triangle text-warning" style="margin:0 3px;"></i>',
            //    `<div style='text-align:center;background-color:#cde6f3; padding:15px; border-radius:5px;'>
            //        <p class='text-danger' style='font-size:14px;'>
            //            هل أنت متأكد من تعديل بيانات هذا الصنف في الفاتورة الحالية؟ ✏️
            //        </p>
            //        <div style='margin-top: 10px !important;'>
            //            ⚠️ هذا الإجراء لا يمكن التراجع عنه، وسيؤثر على حساب العميل 💰 ومخزون الصنف 📦.
            //        </div>
            //    </div>`,
            //    function() {
            //        $.ajax({
            //            url: `{{ url('sales/update_product_from_bill') }}/${rowId}`,
            //            type: "GET",
            //            data: {
            //                rowId: rowId, 
            //                rowSellPrice: rowSellPrice,
            //                rowProdDiscount: rowProdDiscount,
            //                rowProdTax: rowProdTax,                        
            //            },
            //            success: function(res) {
            //                if(res.notAuth){
            //                    alertify.dialog('alert')
            //                        .set({transition:'slide',message: `
            //                            <div style='text-align:center;'>
            //                                <p style='color:#e67e22;font-size:18px;margin-bottom:10px;'>صلاحية غير متوفرة 🔐⚠️</p>
            //                                <p>${res.notAuth}</p>
            //                            </div>
            //                        `, 'basic': true})
            //                        .show();
            //                    $(".modal").modal('hide');
            //                }else{
            //                    if(res.no_edits){
            //                        alertify.dialog('alert')
            //                        .set({transition:'slide',message: `
            //                            <div style='text-align:center;'>
            //                                <p>${res.no_edits}</p>
            //                            </div>
            //                        `, 'basic': true})
            //                        .show();
            //                    }

            //                    if(res.success_edit){
            //                        alert(
            //                            "تم تعديل بيانات الصنف بنجاح ✅.\n" +
            //                            "💰 تم تعديل حساب العميل بناءً على التعديلات الأخيرة."
            //                        );

            //                        location.reload();
            //                    }

            //                    if(res.cannot_delete){
            //                        alertify.set('notifier','position','top-center');
            //                        alertify.set('notifier','delay',6);
            //                        alertify.warning('خطأ: لا يمكن حذف الفاتورة لارتباطها بسجلات أخرى.');
            //                    }
            //                }
            //            },
            //            error: function(){
            //                alertify.error('حدث خطأ أثناء محاولة حذف الفاتورة');
            //            }
            //        });
            //        },
            //        function(){}
            //    ).set({
            //        labels:{
            //            ok:"نعم <i class='fas fa-check text-success' style='margin:0 3px;'></i>",
            //            cancel:"لا <i class='fa fa-times text-light' style='margin:0 3px;'></i>"
            //        }
            //    });
            //});
            ////////////////////////////// end when click edit-row-btn تعديل صف من جدول الأصناف ////////////////////////////
           
           
           

            //////////////////////////// start when click delete-row-btn حذف صنف من جدول الأصناف  ////////////////////////////
            $(document).on('click', '.delete-row-btn', function() {
                var rowId = $(this).data('row-id');

                alertify.confirm(
                'تحذير هام <i class="fas fa-exclamation-triangle text-warning" style="margin:0 3px;"></i>',
                `<div style='text-align:center;background-color:#f8d7da; padding:15px; border-radius:5px;'>
                    <p class='text-danger' style='font-size:14px;'>
                        هل أنت متأكد من حذف هذا الصنف من الفاتورة نهائيًا؟ 🗑️
                    </p>
                    <div style='margin-top: 10px !important;'>
                        ⚠️ هذا الإجراء لا يمكن التراجع عنه، وسيؤثر على حساب العميل 💰 ومخزون الصنف 📦.
                    </div>
                </div>`,
                function() {
                    $.ajax({
                        url: `{{ url('sales/destroy_product_from_bill') }}/${rowId}`,
                        type: "GET",
                        success: function(res) {
                            if(res.notAuth){
                                alertify.dialog('alert')
                                    .set({transition:'slide',message: `
                                        <div style='text-align:center;'>
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
                                        <div style='text-align:center;'>
                                            <p>${res.no_edits}</p>
                                        </div>
                                    `, 'basic': true})
                                    .show();
                                }

                                if(res.success_delete){
                                    alert(
                                        "🗑️ تم حذف الصنف من الفاتورة بنجاح.\n" +
                                        "📦 تمت إعادة كمية الصنف إلى المخزن.\n" +
                                        "📊 تم تحديث متوسط السعر تلقائيًا."
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
            //////////////////////////// end when click delete-row-btn حذف صنف من جدول الأصناف  ////////////////////////////
        </script>
    {{-- end general scripts --}}
    
    
</body>
</html>
