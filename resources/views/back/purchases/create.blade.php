<!doctype html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">

        <!-- Title -->
        <title> {{ GeneralSettingsInfo()->app_name }}: @yield('title') </title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>

        <!-- Bootstrap css-->
        <link href="{{ asset('back') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- Icons css -->
        <link href="{{ asset('back') }}/assets/css-rtl/icons.css" rel="stylesheet">

        <!--  Right-sidemenu css -->
        <link href="{{ asset('back') }}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

        <!-- Style css -->
        <link href="{{ asset('back') }}/assets/css-rtl/style.css" rel="stylesheet">
        <link href="{{ asset('back') }}/assets/css-rtl/style-dark.css" rel="stylesheet">

        {{-- alertify --}}
        <link href="{{ asset('back/assets/css-rtl/alertify.rtl.min.css') }}" type="text/css" rel="stylesheet"/>
        <link href="{{ asset('back/assets/css-rtl/default.rtl.min.css') }}" type="text/css" rel="stylesheet"/>

        {{-- selectize --}}
        <link href="{{ asset('back/assets/selectize.css') }}" type="text/css" rel="stylesheet"/>

        @yield('header')

        <!-- Skinmodes css -->
        <link href="{{ asset('back') }}/assets/css-rtl/skin-modes.css" rel="stylesheet" />

        <!-- Animations css -->
        <link href="{{ asset('back') }}/assets/css-rtl/animate.css" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:slnt,wght@11,200..1000&family=Changa:wght@200..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">


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
            
        </style>
	</head>

    @include('back.purchases.css_js.main_css')

<body style="height: 100vh !important;overflow: auto;background: #ffe8ed !important;">

    <div id="overlay_page"></div>

    
    @include('back.layouts.header')
    {{--@include('back.layouts.navbar')--}}
    
    <div class="page" id="page_purchases">        

        @include('back.layouts.calc')
    
        @include('back.purchases.modal_search_product')
    
        @include('back.purchases.modal_save_bill')
    
        @include('back.purchases.modal_dismissal_notices')

        <div class="container-fluid">

            {{-------------------------------------------------- start top الموردين وبحث عن صنف --------------------------------------------------}}
            {{-------------------------------------------------- start top الموردين وبحث عن صنف --------------------------------------------------}}
            <div id="top_section" style="padding: 7px 10px 0;">
                <div class="row">
                    <div class="col-lg-4" style="margin-bottom: 8px;">
                        <select class="selectize" style="border: 1px solid #5c5c5c !important;">
                            <option value="" selected>الموردين</option>     
                            @foreach ($suppliers as $supplier)
                                <option>
                                    @if ($supplier->phone)
                                        {{ $supplier->phone }} - 
                                    @endif
                                    {{ $supplier->name }}</option>
                            @endforeach                         
                        </select>
                    </div>
                    
                    <div class="col-lg-1" style="margin-bottom: 8px;">
                        <input type="text" class="form-control" id="" name="" placeholder="رقم الفاتورة">
                    </div>
                    
                    <div class="col-lg-7" style="margin-bottom: 8px;">
                        <select class="" id="products_selectize" style="border: 1px solid #5c5c5c !important;">
                            <option value="" selected>إبحث عن صنف</option>         
                        </select>
                    </div>
    
                    {{--<div class="col-lg-3 col-sm-12" style="margin-bottom: 8px;position: relative;">
                        <form id="main_form_search" style="position: relative;">
                            <input type="text" id="main_input_search" class="form-control form-control-sm focus_input" style="height: 30px !important;border: 1px solid #5c5c5c !important;" placeholder="بحث عن صنف"  autofocus>

                            <button type="submit" class="btn btn-danger btn-sm" data-effect="effect-scale" data-toggle="tooltip" title="بحث عن صنف" style="height: 30px !important;position: absolute;left: 0;top: 0;">
                                <i class="fas fa-search-plus" style="font-size: 18px !important;"></i>
                            </button>
                        </form>
                        
                        <div id="hidden_div_main_search">
                            <div class="text-sm-center table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>ك مخزن</th>
                                            <th>السعر</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>--}}
    
                    {{--<div class="col-lg-1" id="search_button" style="margin-top: 2px;margin-bottom: 8px;">
                        <button class="btn btn-danger btn-sm btn-block" data-effect="effect-scale" data-toggle="modal" href="#modal_search_product" data-toggle="tooltip" title="بحث عن صنف" style="height: 30px;">
                            <i class="fas fa-search-plus" style="font-size: 18px !important;"></i>
                        </button>
                    </div>--}}
                </div>
            </div>
            {{-------------------------------------------------- end top الموردين وبحث عن صنف --------------------------------------------------}}
            {{-------------------------------------------------- end top الموردين وبحث عن صنف --------------------------------------------------}}
            











            {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
            {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
            <div class="" id="main_content" style="padding: 18px;margin-bottom: 60px;">
                <div class="row"> 

                    <div class="col-lg-4 product-selection p-3 total_info" style="background: #e3bfc6;">
                        <div class="text-center" style="font-weight: bold;text-decoration: underline;background: rgb(195, 6, 6);color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
                            فاتورة شراء رقم
                            <span style="font-size: 15px;margin: 0px 5px;">1397635</span>
                        </div>
                        
                        <div class="text-center" id="date_time">
                            <span class="badge badge-light" id="date"></span>
                            <span class="badge badge-danger mx-2" id="time" style="font-weight: bold;font-size: 15px !important;margin-top: 10px;"></span>
                            {{--  <button class="btn btn-dark btn-sm ml-2"><i class="fas fa-sign-out-alt"></i> Sign Out</button>  --}}
                        </div>
    
                        <br>
    
                        <div class="total-bar d-flex align-items-center justify-content-between" style="padding: 10px;border: 2px solid #ddd; ">
                            <div class="row">
                                <p class="col-6" id="countTableTr" style="font-size: 13px;font-weight: bold;">
                                    عدد العناصر:
                                    <span style="font-size: 16px;">0</span>
                                </p>
                                <p class="col-6" style="font-size: 13px;font-weight: bold;font-size: 14px;">
                                    م الفرعي: 
                                    <span style="font-size: 16px;">32000.00</span>
                                </p>
                                <p class="col-4">
                                    <input type="text" class="form-control text-center" placeholder="ضريبة قيمة مضافة" style="font-size: 12px;"/>
                                </p>
                                <p class="col-4">
                                    <select class="form-control text-center" name="" id="discount" style="font-size: 12px;">
                                        <option value="" selected disabled>نوع الخصم</option>
                                        <option value="discount_rate">خ نسبة</option>
                                        <option value="discount_price">خ قيمة</option>
                                    </select>
                                </p>
                                <p class="col-4">
                                    <input type="text" class="form-control text-center" placeholder="الخصم" style="font-size: 12px;"/>
                                </p>
    
                                <div class="col-12">
                                    <table class="table table-bordered table-striped text-center">
                                        <thead class="table-dark" style="font-size: 9px;">
                                            <tr>
                                                <th>م الهدايا</th>
                                                <th>م الخصومات</th>
                                                <th>م ض.م</th>
                                                <th>م مصاريف</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span id="totalGift" style="font-weight: bold;">0.00</span>
                                                </td>
                                                <td>
                                                    <span id="totalDiscount" style="font-weight: bold;">0.00</span>
                                                </td>
                                                <td>
                                                    <span id="totalTax" style="font-weight: bold;">0.04</span>
                                                </td>
                                                <td>
                                                    <span id="totalExpenses" style="font-weight: bold;">0.00</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
    
                                <p class="col-lg-12">
                                    <div style="width: 97%;background: #ffc107;color: black;padding: 7px;text-align: center;margin: auto;">
                                        <span style="font-size: 12px;">الإجمالي: </span>
                                        <span style="font-size: 24px;">280,000</span>
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
                                    <th style="width: 25%;">الصنف</th>
                                    <th>ك المخزن</th>
                                    <th>ك شراء</th>
                                    <th style="width: 7.5%;">السعر</th>
                                    <th style="width: 7.5%;">إجمالي</th>
                                    <th>بونص</th>
                                    <th>خ جنية</th>
                                    <th>ضريبة %</th>
                                    <th>الإجمالي</th>
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
    
                {{--<button class="col-lg-2 col-12 btn btn-info-gradient btn-rounded mb-2"  data-placement="top" data-toggle="tooltip" title="عميل جديد">
                    <i class="fas fa-user-plus"></i> 
                    <span class="d-none d-lg-inline">مورد جديد</span>
                </button>--}}
                
                <button class="col-lg-2 col-12 btn btn-success-gradient btn-rounded mb-2"  data-placement="top" id="save_bill" data-effect="effect-scale" data-toggle="modal" href="#modal_save_bill" data-toggle="tooltip" title="حفظ الفاتورة">
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
    </div>


    <!-- JQuery min js -->
    <script src="{{ asset('back') }}/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/bootstrap-rtl.js"></script>

    <!-- Horizontalmenu js-->
    <script src="{{ asset('back') }}/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

    <!-- Right-sidebar js -->
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-rtl.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-custom.js"></script>

    <!-- alertify -->
    <script src="{{ asset('back/assets/js/alertify.min.js') }}"></script>

    <!-- selectize -->
    <script src="{{ asset('back/assets/selectize.min.js') }}"></script>

    <!-- custom js -->
    <script src="{{ asset('back') }}/assets/js/custom.js"></script>


    
    @include('back.purchases.css_js.main_js')
    
    @include('back.purchases.js.top_main_search')

    @include('back.purchases.js.add_product_to_table_products')

    {{--  start refresh_page  --}}
    @include('back.layouts.refresh_page')
    {{--  end refresh_page  --}}


    <script>
        // start count table tr
        function countTableTr(){ return $('#products_table tbody tr').length; }
        // end count table tr


        // start remove This Tr on table
        function removeThisTr() {
            $(document).on('click', '#products_table tbody tr .remove_this_tr', function (e) { 
                $(this).closest('tr').fadeOut(100, function(){
                    $(this).remove();

                    $("#countTableTr span").text(countTableTr());
                });    
            });
        }
        // end remove This Tr on table


        // start open modal calc when click button when click ctrl+/
        $(document).bind('keydown', function(event) {
            if( event.which === 191 && event.ctrlKey ) {
                $('.calc').modal('show');
            }
        });
        // end open modal calc when click button when click ctrl+/


        // start check if product quantity is big zero
        $(document).on('input', '#products_table tbody .product_qty', function(){
            const thisVal = $(this);
            if(thisVal.val() < 1){
                thisVal.val(1);
                backgroundRedToSelectError(thisVal);

                alertify.set('notifier','position', 'bottom-center');
                alertify.set('notifier','delay', 3);
                alertify.error("خطأ في كمية المنتج");
            }
        });
        // end check if product quantity is big zero

        
        // start function to add style to inputs error 
        function backgroundRedToSelectError(selector){
            selector.css('background', 'orange');
            setTimeout(() => {
                selector.css('background', 'transparent');
            }, 1500);
        }
        // end function to add style to inputs error 

    </script>


    <script>
        $(document).ready(function() {
            $('#products_selectize').selectize({
                valueField: 'id',  // القيمة المخزنة عند الاختيار
                labelField: 'nameAr', // النص الظاهر للمستخدم
                searchField: ['id', 'nameAr', 'nameEn'], // البحث في كل الحقول
                loadThrottle: 300, // تقليل عدد الطلبات عند البحث
                maxItems: 1, // اختيار عنصر واحد فقط
                create: false, // منع إضافة عناصر جديدة
                preload: 'focus', // تحميل البيانات عند التركيز على الحقل
                render: {
                    option: function(item, escape) {
                        return `<option>
                                    الصنف: ${escape(item.nameAr)} - 
                                    كود: ${escape(item.id)} - 
                                    س بيع: ${escape(item.sellPrice)} - 
                                    س شراء: ${escape(item.purchasePrice)}
                                
                                </option>`;
                    },
                    item: function(item, escape) {
                        return `<div>
                                    الصنف: ${escape(item.nameAr)} - 
                                    كود: ${escape(item.id)} - 
                                    س بيع: ${escape(item.sellPrice)} - 
                                    س شراء: ${escape(item.purchasePrice)}
                                </div>`;
                    }
                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: `{{ url('search_products_by_selectize') }}`, // رابط البحث
                        type: 'GET',
                        dataType: 'json',
                        data: { q: query },
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
        });
    </script>


    {{-- start when change products_selectize options --}}
    <script>
        $(document).ready(function() {
            $('#products_selectize').change(function() {
                var productId = $(this).val();
                
                function appendToProductsTable(){
                    $('#products_table tbody').append(`
                        <tr id="tr_${productId}">
                            <th>${productId}</th>
                            <td>
                                <button class="btn btn-danger btn-sm remove_this_tr" onclick="removeThisTr('#pos_create #products_table'); new Audio('{{ url('back/sounds/failed.mp3') }}').play();"><i class="fas fa-times"></i></button>
                            </td>
                            <td class="prod_name">ابليك مجزع اسود ف دهبي مقاس 10 اكس</td>
                            <td>20</td>
                            <td><input type="number" class="form-control form-control-sm text-center focus_input product_qty" value="1"></td>
                            <td>600</td>
                            <td>600.00</td>
                            <td><input type="number" class="form-control form-control-sm text-center focus_input" value="0"></td>
                            <td><input type="number" class="form-control form-control-sm text-center focus_input" value="0"></td>
                            <td><input type="number" class="form-control form-control-sm text-center focus_input" value="0"></td>
                            <td><input type="number" class="form-control form-control-sm text-center focus_input" value="0"></td>
                        </tr>
                    `);                        
                }

                if(productId){
                    if ($(`#products_table tbody #tr_${productId}`).length > 0) {
                        alertify.set('notifier','position', 'bottom-center');
                        alertify.set('notifier','delay', 3);
                        alertify.error("تم إضافة الصنف من قبل لأصناف الفاتورة");

                        const product_qty = $(`#products_table tbody #tr_${productId} .product_qty`);
                        const currentQty = parseInt(product_qty.val());
                        product_qty.val(currentQty + 1);

                        backgroundRedToSelectError(product_qty);

                    }else{
                        appendToProductsTable();
                        $("#countTableTr span").text(countTableTr());
                    }
                }
                $("#products_selectize")[0].selectize.clear();
            });
        });
    </script>
    {{-- end when change products_selectize options --}}

</body>
</html>
