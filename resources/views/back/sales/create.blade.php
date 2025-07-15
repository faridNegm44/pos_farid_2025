<!doctype html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Title -->
        <title> {{ GeneralSettingsInfo()->app_name }}: {{ $pageNameAr }} {{ ($lastBillNum+1) }}</title>

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
            /*#amount_paid{
                display: none;
            }*/

            @media (max-width: 991px) {
                #top_section {
                    margin-top: 30px;
                }
            }

        </style>
	</head>

    @include('back.bills_css_js.css_js.main_css')

<body style="height: 100vh !important;overflow: auto;background: #b0ddc4 !important;">

    <div id="overlay_page"></div>

    
    {{--@include('back.layouts.navbar')--}}
    
    <div class="page" id="page_sales">        
        @include('back.layouts.header')

        @include('back.layouts.calc')
    
        {{--@include('back.sales.modal_search_product')--}}
        {{--@include('back.sales.modal_dismissal_notices')--}}
        
        
        
        
        <form>
            @csrf
            @include('back.sales.modal_save_bill')
            

            <div class="container-fluid">
    
                {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- start top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                <div id="top_section" style="padding: 7px 10px 0;">
                    <div class="row">
                        <div class="col-lg-5" style="margin-bottom: 8px;">
                            <select name="client_id" id="clients" style="border: 1px solid #5c5c5c !important;">
                                <option value="" selected>إبحث عن عميل</option>         
                            </select>
                            <bold class="text-danger" id="errors-client_id" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-1" style="margin-bottom: 8px;">
                            <button type="button" class="btn btn-danger-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".client_modal" title="اضافة عميل جديد" style="width: 75%;margin: 0px auto;font-size: 19px;padding: 0px !important;display: block;">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                        
                        <div class="col-lg-1" style="margin-bottom: 8px;">
                            <input type="text" class="form-control" id="custom_bill_num" name="custom_bill_num" placeholder="رقم فاتورة مخصص" value="">
                        </div>
                        
                        
                        <div class="col-lg-5" style="margin-bottom: 8px;">
                            <select class="" id="products_selectize" style="border: 1px solid #5c5c5c !important;">
                                <option value="" selected>إبحث عن سلعة/خدمة</option>         
                            </select>
                        </div>
                    </div>
                </div>
                {{-------------------------------------------------- end top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- end top العملاء وبحث عن سلعة/خدمة --------------------------------------------------}}
                
    
    
    
    
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                <div class="" id="main_content" style="padding: 18px;margin-bottom: 60px;">
                    <div class="row"> 
    
                        <div class="col-lg-4 product-selection p-3 total_info" style="background: #70a584;">
                            <div class="text-center" style="text-decoration: underline;background: rgb(66 112 81);color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
                                {{ $pageNameAr }}
                                <span style="font-size: 18px;margin: 0px 5px;" id="nextBillNum">{{ ($lastBillNum+1) }}</span>
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
                                        <input autocomplete="off" type="text" class="form-control focus_input numValid text-center" id="bill_discount" name="bill_discount" placeholder="خصم قيمة" style="font-size: 12px;" />
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
                                                        <option value="{{ $item->id }}">{{ $item->expense_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <div class="col-md-5">
                                                <input autocomplete="off" type="text" class="form-control text-center numValid focus_input" 
                                                       id="extra_money" name="extra_money" placeholder="مبلغ المصاريف" style="font-size: 12px;" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                
                                    <p class="col-6" id="countTableTr" style="font-size: 13px;">
                                        عدد العناصر:
                                        <span style="font-size: 16px;">0</span>
                                    </p>
                                    <p class="col-6" style="font-size: 13px;font-size: 14px;">
                                        الإجمالي قبل: 
                                        <span style="font-size: 16px;" class="subtotal">0</span>
                                    </p>

                                    <p class="col-lg-12">
                                        <div style="width: 97%;background: #eeb50a;color: black;padding: 7px;text-align: center;margin: auto;">
                                            <span style="font-size: 12px;">الإجمالي المستحق: </span>
                                            <span style="font-size: 24px;" class="total_bill_after">0.00</span>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
    
    
    
                        <div class="col-lg-8" style="height: 70vh; overflow: auto; padding: 10px 10px 30px; background-image: url('{{ url('back/images/settings/farid logo bg pos white.png') }}'); background-size: cover; background-repeat: no-repeat;">
                            <table class="table table-hover table-bordered" id="products_table">
                                <thead class="bg bg-black-5">
                                    <tr>
                                        <th>#</th>
                                        <th>حذف</th>
                                        <th style="width: 25%;max-width: 100%;">السلعة/الخدمة</th>
                                        <th style="width: 10%;">الوحدة</th>
                                        <th style="width: 10%;">ك المخزن</th>
                                        <th style="width: 10%;">
                                            ك مباعة
                                            <i class="fas fa-info-circle text-warning" data-bs-toggle="tooltip" title="⚠️ يُرجى إتمام عملية البيع باستخدام الوحدة الصغرى للمنتج، وذلك لضمان دقة العمليات الحسابية وسلامة بيانات الفاتورة."></i>
                                        </th>
                                        <th style="width: 10%;">س بيع</th>
                                        <th style="width: 10%;">خصم%</th>                                                                                        
                                        <th style="width: 10%;">ضريبة%</th>
                                        <th style="width: 15%;max-width: 100%;">الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                     </div> 
                </div>
                {{-------------------------------------------------- end content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                {{-------------------------------------------------- end content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
    
    
    
    
    
    
    
    
    
    
    
    
    
                {{-------------------------------------------------- start footer --------------------------------------------------}}
                {{-------------------------------------------------- start footer --------------------------------------------------}}
                <div class="row footer-btn-group justify-content-center">
                    {{--<button class="col-lg-2 col-12 btn btn-warning-gradient btn-rounded mb-2" data-placement="top" data-toggle="tooltip" title="تعليق الفاتورة">
                        <i class="fas fa-pause"></i> 
                        <span class="d-none d-lg-inline">تعليق الفاتورة</span>
                    </button>--}}
                            

                    {{-- style="display: none;" --}}
                    <button class="col-lg-2 col-12 btn btn-light-gradient btn-rounded mb-2" data-placement="top" id="save_bill" data-effect="effect-scale" data-toggle="modal" href="#modal_save_bill" data-toggle="tooltip" title="حفظ الفاتورة">
                        <i class="fas fa-check-double"></i> 
                        <span class="d-none d-lg-inline">حفظ الفاتورة</span>
                    </button>
    
                    <button class="col-lg-2 col-12 btn btn-danger-gradient btn-rounded mb-2 refresh_page">
                        <i class="fas fa-trash-alt"></i> 
                        <span class="d-none d-lg-inline">الغاء  الفاتورة</span>
                    </button>
                </div>
                {{-------------------------------------------------- end footer --------------------------------------------------}}
                {{-------------------------------------------------- end footer --------------------------------------------------}}
    
            </div>
        </form>
        
        @include('back.sales.modal_add_new_client')
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
    @include('back.layouts.refresh_page')



    {{--  start search clients by selectize #client --}}
    <script>
        $(document).ready(function() {
            // بدايه الجزء الخاص بالبحث وعرض العملاء في selectize
            $('#clients').selectize({
                valueField: 'id',  // القيمة المخزنة عند الاختيار
                labelField: 'name', // النص الظاهر للمستخدم
                searchField: ['id', 'name', 'phone', 'address'], // البحث في كل الحقول
                loadThrottle: 300, // تقليل عدد الطلبات عند البحث
                maxItems: 1, // اختيار عنصر واحد فقط
                create: false, // منع إضافة عناصر جديدة
                preload: 'focus', // تحميل البيانات عند التركيز على الحقل
                render: {
                    option: function(item, escape) {
                        return `<option>
                                    كود: ${escape(item.id)} - 
                                    الاسم: ${escape(item.name)} - 
                                    تليفون: ${escape(item.phone ?? '')} -                                 
                                    عنوان: ${escape(item.address  ?? '' )} -                           
                                    الفلوس: ${escape(item.remaining_money >= 0 ? 'علية '+ display_number_js(item.remaining_money) : 'لة '+ display_number_js(item.remaining_money) )}                           
                                </option>`;
                    },
                    item: function(item, escape) {
                        return `<div>
                                    كود: ${escape(item.id)} - 
                                    الاسم: ${escape(item.name)} - 
                                    تليفون: ${escape(item.phone ?? '')} -   
                                    عنوان: ${escape(item.address  ?? '' )} -                              
                                    الفلوس: ${escape(item.remaining_money >= 0 ? 'علية '+ display_number_js(item.remaining_money) : 'لة '+ display_number_js(item.remaining_money) )}                      
                                </div>`;
                    }
                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: `{{ url('search_clients_by_selectize') }}`, // رابط البحث
                        type: 'GET',
                        dataType: 'json',
                        data: { data_input_search: query },
                        success: function(response) {
                            if (response.clients && Array.isArray(response.clients)) {
                                callback(response.clients);
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
                },
                onChange: function(value) {
                    let selected = this.options[value];
                    if (selected) {
                        $('#accountType').text(selected.type_payment);
                        $('#client_name').text(selected.name);
                        $('#on_him').text(selected.remaining_money >= 0 ? display_number_js(selected.remaining_money) : '');
                        $('#for_him').text(selected.remaining_money < 0 ? display_number_js(selected.remaining_money) : '');

                        alertify.set('notifier', 'position', 'bottom-center');
                        alertify.set('notifier', 'delay', 3);
                        alertify.success("تم استدعاء بيانات العميل بنجاح");
                    }
                }
            });
            // نهاية الجزء الخاص بالبحث وعرض العملاء في selectize
        });
    </script>
    {{--  end search clients by selectize #client --}}
    
    



    {{--  start search products by selectize #products_selectize --}}
    <script>
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
                            <td>
                                <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_tax" name="prod_tax[]" value="${tax}">
                                <input autocomplete="off" type='hidden' class="last_cost_price_small_unit" name="last_cost_price_small_unit[]" value="${purchasePrice}" />
                                <input autocomplete="off" type='hidden' class="avg_cost_price_small_unit" name="avg_cost_price_small_unit[]" value="${purchasePriceAvg}" />
                            </td>`;
                    }else{
                        var tax_permissions = `
                            <td>
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
    </script>
    {{--  end search products by selectize #products_selectize --}}



    
    {{-- start function calcTotal --}}
    <script>
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
                row.find('.prod_total').val( totalAfterTax.toFixed(3) );

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
    </script>
    {{-- end function calcTotal --}}

    

    {{-- start when change tax_bill update prod_tax value --}}
    <script>
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
    </script>
    {{-- end when change tax_bill update prod_tax value --}}
    
    
    
    {{-- start when change extra_money_type --}}
    <script>
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
    </script>
    {{-- end when change extra_money_type --}}

    

    {{-- start when change sellPrice, .sale_quantity, .prod_discount, .tax --}}
    <script>
        $(document).ready(function () {
            $(document).on('input', '.sellPrice, .sale_quantity, .prod_discount, .prod_tax, #bill_discount, #extra_money, #extra_money_type', function () {
                calcTotal();
                //$("#overlay_page").fadeIn();
                //$("#overlay_page").fadeOut();
            });
        });
    </script>
    {{-- end when change sellPrice, .sale_quantity, .prod_discount, .tax --}}


    {{--  start when click finally_save_bill_btn to save bill --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '#finally_save_bill_btn', function(){
            alertify.confirm(
                'انتبة !! <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>',
                `<div style="text-align: center;">
                    <p>
                        💾 هل أنت متأكد من <strong>حفظ الفاتورة الحالية</strong>؟<br>
                        ⚠️ تأكد من صحة البيانات قبل المتابعة.
                    </p>
                </div>`,
                function(){
                    
                    $.ajax({
                        url: `{{ url('sales/store') }}`,
                        type: 'post',
                        processData: false,
                        contentType: false,
                        data: new FormData($('form')[0]),
                        beforeSend:function () {
                            $('form [id^=errors]').text('');
                            $("#products_table tbody input, select").css('border', '');
                            $(".tooltip-msg").remove();
                        },
                        error: function(res){
                            console.log(res.responseJSON.errors);

                            $('#modal_save_bill').removeClass('show').hide();
                            $('.modal-backdrop').remove(); // إزالة الخلفية السوداء
                            $('body').removeClass('modal-open'); // إصلاح الـ scroll

                            $.each(res.responseJSON.errors, function (index , value) {
                                let splitRes = index.split('.');
                                let inputName = splitRes[0];
                                let inputNumber = splitRes[1];

                                let row = $("#products_table tbody tr").eq(inputNumber);
                                row.find(`.${inputName}`)
                                .css('border', '2px solid red')
                                .after(`
                                    <i class="fas fa-info-circle text-danger tooltip-msg" data-bs-toggle="tooltip" title="${value}"></i>
                                `);

                                $(`form #errors-${index}`).show().text(value);
                            });
                        },
                        success: function(res){

                            if(res.errorClientPayment){  // لمعرفه نوع التعامل مع العميل سواء كاش او اجل
                                alert(res.errorClientPayment);

                            }else if(res.sale_quantity_big_than_stock){ // لو كميه المنتج المباعه اكبر من المتوفره ف المخزن
                                alert(res.sale_quantity_big_than_stock)
                            
                            }else{
                                alertify.success("✔ تم الحفظ بنجاح...");
                                setTimeout(function () {
                                    window.location.href = "{{ url('sales/create') }}";
                                }, 500);
                            }
                        }
                    });

                }, function(){

                }).set({
                    labels:{
                        ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                        cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                    }
                });
            });
    </script>
    {{--  end when click finally_save_bill_btn to save bill --}}
    


    {{--  start when click finally_save_bill_and_print_btn to save bill and print --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '#finally_save_bill_and_print_btn', function(){
            alertify.confirm(
                'انتبة !! <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>',
                `<div style="text-align: center;">
                    <p>🧾 هل أنت متأكد من حفظ الفاتورة الحالية وبدء عملية <strong>الطباعة</strong>؟<br>
                    ⚠️ تأكد من صحة البيانات قبل المتابعة.</p>
                </div>`,
                function(){
                    
                    $.ajax({
                        url: `{{ url('sales/store') }}`,
                        type: 'post',
                        processData: false,
                        contentType: false,
                        data: new FormData($('form')[0]),
                        beforeSend:function () {
                            $('form [id^=errors]').text('');
                            $("#products_table tbody input, select").css('border', '');
                            $(".tooltip-msg").remove();
                        },
                        error: function(res){
                            console.log(res.responseJSON.errors);

                            $('#modal_save_bill').removeClass('show').hide();
                            $('.modal-backdrop').remove(); // إزالة الخلفية السوداء
                            $('body').removeClass('modal-open'); // إصلاح الـ scroll

                            $.each(res.responseJSON.errors, function (index , value) {
                                let splitRes = index.split('.');
                                let inputName = splitRes[0];
                                let inputNumber = splitRes[1];

                                let row = $("#products_table tbody tr").eq(inputNumber);
                                row.find(`.${inputName}`)
                                .css('border', '2px solid red')
                                .after(`
                                    <i class="fas fa-info-circle text-danger tooltip-msg" data-bs-toggle="tooltip" title="${value}"></i>
                                `);

                                $(`form #errors-${index}`).show().text(value);
                            });
                        },
                        success: function(res){

                            if(res.errorClientPayment){  // لمعرفه نوع التعامل مع العميل سواء كاش او اجل
                                alert(res.errorClientPayment);

                            }else if(res.sale_quantity_big_than_stock){ // لو كميه المنتج المباعه اكبر من المتوفره ف المخزن
                                alert(res.sale_quantity_big_than_stock)
                            
                            }else if(res.bill_id) {
                                alertify.success("✔ تم الحفظ بنجاح، جاري فتح صفحة الطباعة...");
                                setTimeout(function () {
                                    window.open(`{{ url('sales/report/print_receipt') }}/${res.bill_id}`, '_blank');
                                    window.location.href = "{{ url('sales/create') }}";
                                }, 500);

                            } else {
                                alert("⚠️ لم يتم استلام bill_id من السيرفر!");
                            }
                        }
                    });

                }, function(){

                }).set({
                    labels:{
                        ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                        cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                    }
                });
            });
    </script>
    
    {{--  end when click finally_save_bill_and_print_btn to save bill and print --}}




    {{-- start client modal --}}
    <script>
        $('.client_modal #save').click(function(e){
            e.preventDefault();

            document.querySelector('.modal #save').disabled = true;        
            document.querySelector('.spinner_request').setAttribute("style", "display: inline-block;");

            const client_modal_name = $("#client_modal_name").val();
            const client_modal_phone = $("#client_modal_phone").val();
            const client_modal_address = $("#client_modal_address").val();
            const client_modal_type_payment = $("#client_modal_type_payment").val();

            $.ajax({
                url: "{{ url('clients/store_client_from_pos_page') }}",
                type: 'POST',
                data: {
                    client_modal_name: client_modal_name,
                    client_modal_phone: client_modal_phone,
                    client_modal_address: client_modal_address,
                    client_modal_type_payment: client_modal_type_payment,
                },
                beforeSend:function () {
                    $('form [id^=errors]').text('');
                },
                error: function(res){
                    console.log(res);

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.error("عذرًا، حدث خطأ أثناء العملية ⚠️ يُرجى المحاولة مرة أخرى 🔄");

                    document.querySelector('.modal #save').disabled = false;
                    document.querySelector('.spinner_request').style.display = 'none';

                    $(`.client_modal #errors-client_modal_name`).css('display' , 'block').text(res.responseJSON.errors.client_modal_name);
                    $(`.client_modal #errors-client_modal_phone`).css('display' , 'block').text(res.responseJSON.errors.client_modal_phone);
                    $(`.client_modal #errors-client_modal_address`).css('display' , 'block').text(res.responseJSON.errors.client_modal_address);
                    $(`.client_modal #errors-client_modal_type_payment`).css('display' , 'block').text(res.responseJSON.errors.client_modal_type_payment);
                },
                success: function(res){
                    $(".client_modal").modal('hide');

                    document.querySelector('.modal #save').disabled = false;
                    document.querySelector('.spinner_request').style.display = 'none';

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.success("تمت اضافة العميل بنجاح");

                }
            });
        });
    </script>
    {{-- end client modal --}}




    {{-- start general scripts --}}
    <script>

        // start show div amount paid after select clients and treasury
        $(document).on('input', '#treasuries, #clients', function(){
            if( $('#treasuries').val() && $('#clients').val() ){
                $("#amount_paid").fadeIn();

            }else{            
                $("#amount_paid").fadeOut();
            }
        });
        
        $(document).on('input', '#clients', function(){
            if( $(this).val() ){
                $("#modal_save_bill_footer").fadeIn();

            }else{            
                $("#modal_save_bill_footer").fadeOut();
            }
        });
        //  end show div amount paid after select clients and treasury
    </script>
    {{-- end general scripts --}}

    
</body>
</html>
