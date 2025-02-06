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
            }
        </style>
	</head>

    @include('back.pos.css_js.main_css')

<body style="height: 100vh !important;overflow: auto;">

    <div id="overlay_page"></div>

    
    @include('back.layouts.header')
    @include('back.layouts.navbar')
    
    <div class="page" id="page_purchases">        

        @include('back.layouts.calc')
    
        @include('back.pos.modal_search_product')
    
        @include('back.pos.modal_save_bill')
    
        @include('back.pos.modal_dismissal_notices')

        <div class="container-fluid">

            {{-- start top --}}
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

                <div class="col-lg-7 col-sm-12" style="margin-bottom: 8px;">
                    <input type="text" class="form-control form-control-sm" style="height: 30px !important;border: 1px solid #5c5c5c !important;" placeholder="بحث عن صنف"  autofocus>
                    <div id="hidden_div">
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
                                    @for ($i = 0;  $i < 100; $i++)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>كوشن فرو في جلد ابيض مصري</td>
                                            <td>20</td>
                                            <td style="color: red;font-size: 14px;">1200,8</td>
                                        </tr>                            
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1" id="search_button" style="margin-top: 2px;margin-bottom: 8px;">
                    <button class="btn btn-danger btn-sm btn-block" data-effect="effect-scale" data-toggle="modal" href="#modal_search_product" data-toggle="tooltip" title="بحث عن صنف" style="height: 30px;">
                        <i class="fas fa-search-plus" style="font-size: 18px !important;"></i>
                    </button>
                </div>
            </div>
            {{-- end top --}}
            






            {{-- start content  --}}
            <div class="" id="main_content">
                <div class="row"> 
    
                    <div class="col-lg-8" style="height: 90vh;overflow: auto;">
                        <table class="table table-hover table-striped table-responsive" id="products_table">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 25%;">الصنف</th>
                                    <th>ك المخزن</th>
                                    <th>ك مباعة</th>
                                    <th style="width: 7.5%;">السعر</th>
                                    <th style="width: 7.5%;">إجمالي</th>
                                    <th>بونص</th>
                                    <th>خ جنية</th>
                                    <th>ضريبة %</th>
                                    <th>الإجمالي</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @for($i = 0; $i < 30; $i++)
                                    <tr>
                                        <th>{{ $i+1 }}</th>
                                        <td class="prod_name">ابليك مجزع اسود ف دهبي مقاس 10 اكس</td>
                                        <td>20</td>
                                        <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="1"></td>
                                        <td>600</td>
                                        <td>600.00</td>
                                        <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
                                        <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
                                        <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
                                        <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
                                        <td><button class="btn btn-outline-danger btn-sm btn-icon remove_this_tr" onclick="removeThisTr('#pos_create #products_table'); new Audio('{{ url('back/sounds/failed.mp3') }}').play();"><i class="fas fa-times"></i></button></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
    
                    
                    <div class="col-lg-4 product-selection p-3 total_info">
                        <div class="text-center" style="width: 175px;font-weight: bold;text-decoration: underline;background: rgb(195, 6, 6);color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
                            فاتورة شراء رقم: <span style="font-size: 15px;margin: 0px 5px;">1397635</span>
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
                 </div> 
            </div>
            {{-- end content  --}}




            {{-- start footer --}}
            <div class="row footer-btn-group justify-content-center">
                <button class="col-lg-2 btn btn-warning-gradient btn-rounded mb-2"><i class="fas fa-pause">
                    </i> تعليق الفاتورة
                </button>
    
                <button class="col-lg-2 btn btn-info-gradient btn-rounded mb-2"><i class="fas fa-user-plus">
                    </i> عميل جديد
                </button>
                
                <button class="col-lg-2 btn btn-success-gradient btn-rounded mb-2" id="save_bill" data-effect="effect-scale" data-toggle="modal" href="#modal_save_bill">
                    <i class="fas fa-check-double"></i> حفظ الفاتورة
                </button>

                <button class="col-lg-2 btn btn-danger-gradient btn-rounded mb-2 refresh_page">
                    <i class="fas fa-refresh"></i> الغاء  الفاتورة
                </button>
    
    
                <button class="col-lg-2 btn btn-primary-gradient btn-rounded mb-2" id="dismissal_notices" data-effect="effect-scale" data-toggle="modal" href="#modal_dismissal_notices">
                    <i class="fas fa-money-bill"></i> مصروفات الإذن
                </button>
            </div>
            {{-- end footer --}}

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

    <script>

        // start reload page when click refresh_page btn
        $(".refresh_page").on("click", function(){
            alertify.confirm('انتبه <i class="fas fa-exclamation-triangle text-danger" style="margin: 0px 3px;font-size: 25px;"></i>', '<p class="text-danger text-center" style="font-weight: bold;line-height: 2;"> هل أنت متأكد من إلغاء المعاملة</p>', 
                function(){
                    location.reload();
                },function(){
                    
                    
                }).set({
                    labels:{
                        ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                        cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                    }
            });
        });
        // end reload page when click refresh_page btn


        // start when change clients or suppliers
        $(document).ready(function() {
            const $clients = $(".clients").selectize();
            const $suppliers = $(".suppliers").selectize();

            const clientsSelectize = $clients[0].selectize;
            const suppliersSelectize = $suppliers[0].selectize;

            // start function check if checked client and supplier in same time
            function checKifFoundCliendAndSupplierVal(){
                if($('.clients').val() && $('.suppliers').val() ){
                    clientsSelectize.clear();
                    suppliersSelectize.clear();

                    alertify
                    .dialog('alert')
                    .set({transition:'slide',message: `
                        <div style="text-align: center;font-weight: bold;">
                            <p style="color: red;font-size: 18px;margin-bottom: 10px;">خطأ <i class="fas fa-exclamation-triangle" style="margin: 0px 3px;"></i></p>
                            <p>يجب أن تكون المعاملة مسنودة إلي عميل أو مودر، وليس كلاهما معاً</p>
                        </div>
                    `, 'basic': true})
                    .show();  

                    
                }
            }
            // end function check if checked client and supplier in same time




            // start function get cleint or supplier info
            //function clientOrSupplier($id){
            //    const url = `{{ url('treasury_bills/create/get_client_or_supplier') }}/${id}`;

            //    $.ajax({
            //        type: "GET",
            //        url: url,
            //        success: function(res){
                        
            //        }
            //    });
                                    
            //}
            // end function get cleint or supplier info



            clientsSelectize.on('change', function(value) {
                checKifFoundCliendAndSupplierVal();
            });

            suppliersSelectize.on('change', function(value) {
                checKifFoundCliendAndSupplierVal();
            });
        });
        // end when change clients or suppliers




        
        // start save treasury bill when click save bill btn
        $("#save_bill").on("click", function(){

            const treasury_type = $("#treasury_type").val();
            const treasury_id = $("#treasury_id").val();
            const client = $(".clients").val();
            const supplier = $(".suppliers").val();
            const value = $("#value").val();

            $("#overlay_page").fadeIn();


            if(!treasury_type){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.error("نوع المعاملة مطلوب");
                
                $("#overlay_page").fadeOut();
                
            }else if(!treasury_id){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.error(" الخزينة المالية مطلوبة");
                
                $("#overlay_page").fadeOut();

            }else if(!client && !supplier){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.error("يُرجى اختيار عميل أو مورد لإتمام المعاملة");
                
                $("#overlay_page").fadeOut();

            }else if(!value){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.error("مبلغ المعاملة مطلوب");
                
                $("#overlay_page").fadeOut();

            }else{

                $("#overlay_page").fadeOut();

                alertify.confirm('انتبه <i class="fas fa-exclamation-triangle text-danger" style="margin: 0px 3px;font-size: 25px;"></i>', '<p class="text-danger text-center" style="font-weight: bold;line-height: 2;"> هل أنت متأكد من حفظ المعاملة في الخزينة المالية ؟</p>', 
                    function(){
    
                        //$.ajax({
                        //    url: "{{ url($pageNameEn) }}/store",
                        //    type: 'POST',
                        //    processData: false,
                        //    contentType: false,
                        //    data: new FormData($('.modal #form')[0]),
                        //    beforeSend:function () {
                        //        $('form [id^=errors]').text('');
                        //    },
                        //    error: function(res){
                        //        $.each(res.responseJSON.errors, function (index , value) {
                        //            $(`form #errors-${index}`).css('display' , 'block').text(value);
                        //        });               
                                
                        //        $('.dataInput:first').select().focus();
                        //        document.querySelector('.modal #save').disabled = false;
                        //        document.querySelector('.spinner_request').style.display = 'none';                
    
                        //        alertify.set('notifier','position', 'top-center');
                        //        alertify.set('notifier','delay', 3);
                        //        alertify.error("هناك شيئ ما خطأ");
                        //    },
                        //    success: function(res){
    
                        //        document.querySelector('.modal #save').disabled = false;
                        //        document.querySelector('.spinner_request').style.display = 'none';
    
                        //        $(".modal").modal('hide');
                                
                        //        alertify.set('notifier','position', 'top-center');
                        //        alertify.set('notifier','delay', 6);
                        //        alertify.success(`تم التحويل بنجاح`);
                                
                        //        location.reload();
                        //    }
                        //});
                    },function(){
                        
                    }).set({
                        labels:{
                            ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                            cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                        }
                });
            }



        });
        // end save treasury bill when click save bill btn
    </script>


    <script>
        @include('back.pos.css_js.main_js')
    </script>

    {{--  start refresh_page  --}}
        @include('back.layouts.refresh_page')
    {{--  end refresh_page  --}}
</body>
</html>
