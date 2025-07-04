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

        {{--<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:slnt,wght@11,200..1000&family=Changa:wght@200..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">--}}


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

            #amount_paid{
                display: none;
            }

            .form-control:disabled, .form-control[readonly] {
                border: 0px solid !important;
                background: transparent !important;
            }
            .dark_theme{
                display: none;
            }
            @media (max-width: 991px) {
                #top_section {
                    margin-top: 30px;
                }
            }
        </style>
	</head>

    @include('back.bills_css_js.css_js.main_css')

<body style="height: 100vh !important;overflow: auto;background: #f3e5d3 !important;">

    <div id="overlay_page"></div>

    
    {{--@include('back.layouts.navbar')--}}
    
    <div class="page" id="page_purchases">        
        @include('back.layouts.header')

        @include('back.layouts.calc')
    
        {{--@include('back.purchases.modal_search_product')--}}
        {{--@include('back.purchases.modal_dismissal_notices')--}}
    
        
        
        <form>
            @csrf
            @include('back.purchases.modal_save_bill')
            

            <div class="container-fluid">
    
                {{-------------------------------------------------- start top الموردين وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- start top الموردين وبحث عن سلعة/خدمة --------------------------------------------------}}
                <div id="top_section" style="padding: 7px 10px 0;">
                    <div class="row">
                        <div class="col-lg-4" style="margin-bottom: 8px;">
                            <select class="" name="supplier_id" id="supplier" style="border: 1px solid #5c5c5c !important;">
                                <option value="" selected>إبحث عن مورد</option>
                            </select>
                            <bold class="text-danger" id="errors-supplier_id" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-1" style="margin-bottom: 8px;">
                            <input type="text" class="form-control" id="custom_bill_num" name="custom_bill_num" placeholder="رقم فاتورة مخصص" value="">
                        </div>
                        
                        <div class="col-lg-7" style="margin-bottom: 8px;">
                            <select class="" id="products_selectize" style="border: 1px solid #5c5c5c !important;">
                                <option value="" selected>إبحث عن سلعة/خدمة</option>         
                            </select>
                        </div>
                    </div>
                </div>
                {{-------------------------------------------------- end top الموردين وبحث عن سلعة/خدمة --------------------------------------------------}}
                {{-------------------------------------------------- end top الموردين وبحث عن سلعة/خدمة --------------------------------------------------}}
                
    
    
    
    
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                <div class="" id="main_content" style="padding: 18px;margin-bottom: 60px;">
                    <div class="row"> 
    
                        <div class="col-lg-4 product-selection p-3 total_info" style="background: #bda17e;">
                            <div class="text-center" style="text-decoration: underline;background: rgb(104 72 32);color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
                                {{ $pageNameAr }}
                                <span style="font-size: 18px;margin: 0px 5px;" id="nextBillNum">{{ ($lastBillNum+1) }}</span>
                            </div>
                            
                            <div class="text-center" id="date_time" style="font-size: 25px !important;margin-top: 10px;">
                                <span class="badge badge-light" id="date"></span>
                                <span class="badge badge-danger mx-2" id="time"></span>
                                {{--  <button class="btn btn-dark btn-sm ml-2"><i class="fas fa-sign-out-alt"></i> Sign Out</button>  --}}
                            </div>
        
                            <br>
        
                            <div class="total-bar d-flex align-items-center justify-content-between" style="padding: 10px;border: 2px solid #f3e5d3; ">
                                <div class="row">
                                    
                                    <p class="col-lg-6 col-12">
                                        <label for="">
                                            ضريبة ق م (%)
                                            <i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="⚠️ مثل: 10% او 5% وهكذا سيتم تطبيقها علي جميع الأصناف."></i>
                                        </label>
                                        <input autocomplete="off" type="text" class="form-control focus_input numValid text-center" id="tax_bill" placeholder="ضريبة ق م (%)" style="font-size: 12px;" />
                                    </p>
        
                                    <p class="col-lg-6 col-12">
                                        <label for="">
                                            خصم قيمة
                                            <i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="⚠️ مثل: 100 جنية او 50 جنية وهكذا."></i>
                                        </label>
                                        <input autocomplete="off" type="text" class="form-control focus_input numValid text-center" id="discount_bill" name="discount_bill" placeholder="خصم قيمة" style="font-size: 12px;" />
                                    </p>
                                    
                                    {{--<p class="col-lg-4 col-12">
                                        <label for="">
                                            مصاريف إضافية
                                            <i class="fas fa-info-circle text-dark" data-bs-toggle="tooltip" title="💡 أدخل مبلغ المصاريف الإضافية إن وجد"></i>
                                        </label>
                                        <input autocomplete="off" type="text" class="form-control focus_input numValid text-center" id="extra_money" name="extra_money" placeholder="مصاريف إضافية" style="font-size: 12px;" />
                                    </p>--}}
                        
                                    <p class="col-6" id="countTableTr" style="font-size: 13px;">
                                        عدد العناصر:
                                        <span style="font-size: 16px;">0</span>
                                    </p>
                                    <p class="col-6" style="font-size: 13px;font-size: 14px;">
                                        م الفرعي: 
                                        <span style="font-size: 16px;" class="subtotal">0</span>
                                    </p>

                                    <p class="col-lg-12">
                                        <div style="width: 97%;background: #e1ab09;color: black;padding: 7px;text-align: center;margin: auto;">
                                            <span style="font-size: 12px;">الإجمالي: </span>
                                            <span style="font-size: 24px;" class="total_bill_after">0.00</span>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
    
    
    
                        <div class="col-lg-8" style="height: 70vh; overflow: auto; padding: 10px 10px 30px; background-image: url('{{ url('back/images/settings/farid logo bg pos white.png') }}'); background-size: cover; background-repeat: no-repeat;">
                            <table class="table table-hover table-bordered" id="products_table">
                                <thead class="text-center thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>حذف</th>
                                        <th style="width: 20%;">السلعة/الخدمة</th>
                                        <th style="width: 10%;">الوحدة ص</th>
                                        <th style="width: 8%;">ك المخزن</th>
                                        <th style="width: 8%;">
                                            ك جديدة
                                            <i class="fas fa-info-circle text-warning" data-bs-toggle="tooltip" title="⚠️ يُرجى التأكد من إدخال الكمية الجديدة للمنتج باستخدام نفس الوحدة المحددة، وذلك لضمان دقة العمليات الحسابية وسلامة بيانات الفاتورة."></i>
                                        </th>
                                        <th style="width: 10%;">س التكلفة</th>
                                        <th style="width: 10%;">س بيع</th>
                                        <th style="width: 8%;">خصم%</th>
                                        <th style="width: 8%;">ضريبة %</th>
                                        {{--<th style="width: 8%;">بونص</th>--}}
                                        <th style="width: 10%;">الإجمالي</th>
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
                    <button class="col-lg-2 col-12 btn btn-success-gradient btn-rounded mb-2" data-placement="top" id="save_bill" data-effect="effect-scale" data-toggle="modal" href="#modal_save_bill" data-toggle="tooltip" title="حفظ الفاتورة">
                        <i class="fas fa-check-double"></i> 
                        <span class="d-none d-lg-inline">حفظ الفاتورة</span>
                    </button>
    
                    <button class="col-lg-2 col-12 btn btn-danger-gradient btn-rounded mb-2 refresh_page">
                        <i class="fas fa-trash-alt"></i> 
                        <span class="d-none d-lg-inline">الغاء  الفاتورة</span>
                    </button>
        
        
                    {{--<button class="col-lg-2 col-12 btn btn-primary-gradient btn-rounded mb-2"  data-placement="top" data-toggle="tooltip" title="مصروفات الإذن" id="dismissal_notices" data-effect="effect-scale" data-toggle="modal" href="#modal_dismissal_notices">
                        <i class="fas fa-money-bill"></i> 
                        <span class="d-none d-lg-inline">مصروفات الإذن</span>
                    </button>--}}
                </div>
                {{-------------------------------------------------- end footer --------------------------------------------------}}
                {{-------------------------------------------------- end footer --------------------------------------------------}}
    
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
    
    <!-- Right-sidebar js -->
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-rtl.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-custom.js"></script>
    
    <!-- alertify -->
    <script src="{{ asset('back/assets/js/alertify.min.js') }}"></script>

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




    {{--  start search supplier by selectize #supplier --}}
    <script>
        $(document).ready(function() {
            // بدايه الجزء الخاص بالبحث وعرض الموردين في selectize
            $('#supplier').selectize({
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
                                    الفلوس: ${escape(item.remaining_money >= 0 ? 'علية '+ display_number_js( item.remaining_money ) : 'لة '+ display_number_js( item.remaining_money ) )}                           
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
                        url: `{{ url('search_suppliers_by_selectize') }}`, // رابط البحث
                        type: 'GET',
                        dataType: 'json',
                        data: { data_input_search: query },
                        success: function(response) {
                            if (response.suppliers && Array.isArray(response.suppliers)) {
                                callback(response.suppliers);
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
                        $('#supplier_name').text(selected.name);
                        if(selected.remaining_money >= 0){
                            $("#on_him").text(`${ display_number_js(selected.remaining_money) }`);
                        }else{
                            $("#for_him").text(`${ display_number_js(selected.remaining_money) }`);
                        }

                        alertify.set('notifier', 'position', 'bottom-center');
                        alertify.set('notifier', 'delay', 3);
                        alertify.success("تم استدعاء بيانات المورد بنجاح");
                    }else{
                        $('#supplier_name').text("");
                        $("#on_him, #for_him").text('');
                    }
                }
            });
            // نهاية الجزء الخاص بالبحث وعرض الموردين في selectize
        });
    </script>
    {{--  end search supplier by selectize #supplier --}}



    {{--  start search products by selectize #products_selectize --}}
    <script>
        $(document).ready(function() {
            // بدايه الجزء الخاص بالبحث وعرض الاصناف في selectize
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
                        return `<option>
                                    كود: ${escape(item.id)} - 
                                    السلعة/الخدمة: ${escape(item.nameAr)} - 
                                    س بيع: ${ display_number_js( escape(item.sell_price_small_unit) ) } - 
                                    س تكلفة: ${ display_number_js( escape(item.last_cost_price_small_unit) ) } - 
                                    كمية ص: ${ display_number_js( escape(item.quantity_small_unit) ) } ${ escape(item.smallUnitName) }
                                </option>`;
                    },
                    item: function(item, escape) {
                        return `<div>
                                    كود: ${escape(item.id)} - 
                                    السلعة/الخدمة: ${escape(item.nameAr)} - 
                                    س بيع: ${ display_number_js( escape(item.sell_price_small_unit) ) } - 
                                    س تكلفة: ${ display_number_js( escape(item.last_cost_price_small_unit) ) } - 
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
            // نهاية الجزء الخاص بالبحث وعرض الاصناف في selectize



            // بدايه اختيار سلعة/خدمة من selectize واضافته في في جدول الاصناف
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
                    
                    var quantity_all = display_number_js(productData.quantity_small_unit); // كميه المخزن

                    function appendToProductsTable() {
                        //const bigAndSmallUnit = ``;

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
                                        <span>${smallUnitName}</span>
                                        <input autocomplete="off" type='hidden' class='small_unit_numbers' value='${small_unit_numbers}' />      
                                    </td>
                                    <td>
                                        <input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center quantity_all" value="${quantity_all}">                    
                                    </td>
                                    <td><input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput product_new_qty" name="product_new_qty[]" value="1"></td>
                                    <td>
                                        <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput purchasePrice" name="purchasePrice[]" value="${purchasePrice}">

                                        <input autocomplete="off" type='hidden' class="last_cost_price_small_unit[]" value="${purchasePrice}" />
                                        <input autocomplete="off" type='hidden' class="avg_cost_price_small_unit[]" value="${purchasePriceAvg}" />
                                    </td>
                                    <td>
                                        <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sellPrice" name="sellPrice[]" value="${sellPrice}">                                    
                                    </td>
                                    <td><input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_discount" name="prod_discount[]" value="0"></td>
                                    <td><input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_tax" name="prod_tax[]" value="0"></td>
                                    <td><input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center focus_input prod_total" name="prod_total[]" value="0"></td>
                                </tr>
                            `);
                                //<td><input type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_bonus" name="prod_bonus[]" value="0"></td>

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

                            const product_new_qty = $(`#products_table tbody #tr_${productId} .product_new_qty`);
                            const currentQty = parseInt(product_new_qty.val());
                            product_new_qty.val(currentQty + 1);

                            backgroundRedToSelectError(product_new_qty);
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
            // نهاية اختيار سلعة/خدمة من selectize واضافته في في جدول الاصناف
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

                let purchasePrice = parseFloat(row.find('.purchasePrice').val()) || 0;  // سعر القطعة
                let product_new_qty = parseInt(row.find('.product_new_qty').val()) || 0;  // الكمية المشتراة
                let discount = parseFloat(row.find('.prod_discount').val()) || 0; // نسبة الخصم (%)
                let tax = parseFloat(row.find('.prod_tax').val()) || 0; // نسبة الضريبة (%)
                let bonus = parseInt(row.find('.prod_bonus').val()) || 0; // عدد البونص
                 


                // 1. حساب إجمالي السعر قبل الخصم والضريبة
                let totalBeforeDiscount = purchasePrice * product_new_qty;

                // 2. حساب الخصم
                let discountAmount = (totalBeforeDiscount * discount) / 100;
                let totalAfterDiscount = totalBeforeDiscount - discountAmount;

                // 3. حساب الضريبة
                let taxAmount = (totalAfterDiscount * tax) / 100;
                let totalAfterTax = totalAfterDiscount + taxAmount;

                // 4. حساب سعر الوحدة بعد توزيع البونص
                //let totalUnits = product_new_qty + bonus;
                //let unitPriceAfterBonus = totalAfterTax / totalUnits;

                // 5. تحديث إجمالي الصف
                row.find('.prod_total').val( totalAfterTax );

                total += totalAfterTax;
                subTotal += totalBeforeDiscount;
            });

            let discount_bill = $("#discount_bill").val(); 
            let afterDiscountBill = total - discount_bill;    

            // عرض الإجمالي الكلي في الـ div
            $('.subtotal').text( parseFloat(subTotal).toLocaleString() + ' جنية');
            $('.total_bill_after').text( parseFloat(afterDiscountBill).toLocaleString() + ' جنية');
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


    {{-- start when change sellPrice, .purchasePrice, .product_new_qty, .prod_discount, .tax --}}
    <script>
        $(document).ready(function () {
            $(document).on('input', '.sellPrice, .purchasePrice, .product_new_qty, .prod_discount, .prod_tax, #discount_bill', function () {

                calcTotal();

                const sellPrice = $(this).closest('tr').find('.sellPrice').val();
                const purchasePrice = $(this).closest('tr').find('.purchasePrice').val();
                
                if (+purchasePrice > +sellPrice) {
                    alertify.set('notifier', 'position', 'bottom-center');
                    alertify.set('notifier', 'delay', 3);
                    alertify.error("خطأ: سعر البيع أقل من سعر التكلفة");

                    $(this).closest('tr').css('background', 'orange');
                    setTimeout(() => {
                        $(this).closest('tr').css('background', 'transparent');
                    }, 1500);
                }
            });
        });
    </script>
    {{-- end when change sellPrice, .purchasePrice, .product_new_qty, .prod_discount, .tax --}}



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
                    <p style="">
                        هل انت متأكد من حفظ الفاتورة الحالية
                    </p>
                </div>`,
                function(){
                    
                    $.ajax({
                        url: `{{ url('purchases/store') }}`,
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

                            alertify.confirm(
                                'رائع <i class="fas fa-check-double text-success" style="margin: 0px 3px;"></i>', 
                                `<span class="text-center">
                                    <span class="text-danger">تمت اضافة فاتورة المشتريات بنجاح</span>
                                    <strong class="d-block">هل تريد اضافه فاتورة مشتريات أخري</strong>
                                </span>`, 
                            function(){                                
                                location.reload();

                            }, function(){ 
                                window.location.href = "{{ url('purchases') }}";
                            }).set({
                                labels:{
                                    ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                                    cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                                }
                            });
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
    

    {{-- start general scripts --}}
    <script>

        // start show div amount paid after select supplier and treasury
        $(document).on('input', '#treasuries, #supplier', function(){
            if( $('#treasuries').val() && $('#supplier').val() ){
                $("#amount_paid").fadeIn();

            }else{            
                $("#amount_paid").fadeOut();
            }
        });
        
        $(document).on('input', '#supplier', function(){
            if( $(this).val() ){
                $("#supplier_div").fadeIn();
                $("#modal_save_bill_footer").fadeIn();

            }else{            
                $("#supplier_div").fadeOut();
                $("#modal_save_bill_footer").fadeOut();
            }
        });
        //  end show div amount paid after select supplier and treasury

    </script>
    {{-- end general scripts --}}

    
</body>
</html>
