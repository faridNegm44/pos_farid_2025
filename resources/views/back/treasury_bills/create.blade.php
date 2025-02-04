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


<body>

    <div id="overlay_page"></div>

    @include('back.layouts.header')
    @include('back.layouts.navbar')
    
    <div class="page" id="page_create_treasury_bill" style="margin-top: 30px;min-height: 0vh;">        
        <div class="container">
            <h5 class="text-center" style="background: #383a3e;color: #fff;padding: 10px;border-radius: 0px;margin: 0 auto;">
                {{ $pageNameAr }}
            </h5>
            <div class="bg-secondary-gradient" style="padding: 0px 15px;">

                {{--  start نوع المعامل && العملاء && الموردين --}}
                <div class="row justify-content-center" style="padding: 10px 10px 0 10px;">
                    <div class="col-lg-2">
                        <label for="treasury_type" class="text-dark">نوع المعاملة</label>
                        <i class="fas fa-star require_input"></i>
                        <select class="form-control" id="treasury_type" required>
                            <option value="" disabled selected>نوع المعاملة</option>                              
                            <option value="اذن توريد نقدية">اذن توريد نقدية</option>
                            <option value="اذن صرف نقدية">اذن صرف نقدية</option>
                            <option value="اذن ارتجاع نقدية">اذن ارتجاع نقدية</option>
                        </select>
                    </div>
                    
                    <div class="col-lg-2">
                        <label for="treasury_id" class="text-dark">اختر الخزينة المالية</label>
                        <i class="fas fa-star require_input"></i>
                        <select class="form-control" id="treasury_id">
                            <option value="" disabled selected>اختر الخزينة المالية</option>                              
                            @foreach ($treasuries as $treasury)
                                <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ $treasury->money }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-lg-3" id="clients">
                        <label for="" class="text-dark">العملاء</label>
                        <i class="fas fa-star require_input"></i>
                        <select class="selectize clients">
                            <option value="" disabled selected>العملاء</option>     
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">
                                    @if ($client->phone)
                                        {{ $client->phone }} - 
                                    @endif
                                    {{ $client->name }}
                                </option>
                            @endforeach                         
                        </select>
                    </div>
                    
                    <div class="col-lg-3" id="suppliers">
                        <label for="" class="text-dark">الموردين</label>
                        <i class="fas fa-star require_input"></i>
                        <select class="selectize suppliers">
                            <option value="" disabled selected>الموردين</option>                              
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    @if ($supplier->phone)
                                        {{ $supplier->phone }} - 
                                    @endif
                                    {{ $supplier->name }}
                                </option>
                            @endforeach       
                        </select>
                    </div>    
                </div>
                {{--  start نوع المعامل && العملاء && الموردين --}}
                
                
        
                {{--  start مبلغ المعاملة && ملاحظات --}}
                <div class="row justify-content-center" style="margin: 10px 0 20px;">
                    <div class="col-lg-2">
                        <label for="" class="text-dark">مبلغ المعاملة</label>
                        <input type="number" class="form-control mb-1" name="" id="" placeholder="مبلغ المعاملة" style="font-size: 13px;" value="0" required>  
                    </div>
                    
                    <div class="col-lg-7">
                        <label for="" class="text-dark">ملاحظات</label>
                        <input type="text" class="form-control" name="" id="" placeholder="ملاحظات">  
                    </div>
                </div>
                {{--  end مبلغ المعاملة && ملاحظات --}}
                
                
                
                {{--  start الموقف المالي للجهة && الموقف المالي للخزينة --}}
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-lg-6 col-12"> 
                        <table class="table table-bordered text-center">
                            <caption style="text-align: center;caption-side: top;font-weight: inherit;font-size: 10pt;background: #383a3e;color: white;">
                                الموقف المالي للخزينة
                            </caption>
                            <thead class="">
                            <tr>
                                <th>#</th>
                                <th>مدين (عليه)</th>
                                <th>دائن (له)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>قبل</td>
                                <td>
                                    <span id="totalBeforeTreasuryOne">13399.80</span>
                                </td>
                                <td>
                                    <span id="totalBeforeTreasuryTwo">0.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>بعد</td>
                                <td>
                                    <span id="totalAfterTreasuryOne">13399.80</span>
                                </td>
                                <td>
                                    <span id="totalAfterTreasuryTwo">0.00</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <div class="col-lg-6 col-12"> 
                        <table class="table table-bordered text-center">
                            <caption style="text-align: center;caption-side: top;font-weight: inherit;font-size: 10pt;background: #383a3e;color: white;">
                                الموقف المالي للجهة
                                <span id="name_client" style="margin: 0 5px;color: #deea17;display: none;">( عميل: علي مجدي )</span>
                                <span id="name_supplier" style="margin: 0 5px;color: #deea17;display: none;">( مورد: علي مجدي )</span>
                            </caption>
                            <thead class="">
                            <tr>
                                <th>#</th>
                                <th>مدين (عليه)</th>
                                <th>دائن (له)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>قبل</td>
                                <td>
                                    <span id="totalBeforeTreasuryOne">13399.80</span>
                                </td>
                                <td>
                                    <span id="totalBeforeTreasuryTwo">0.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>بعد</td>
                                <td>
                                    <span id="totalAfterTreasuryOne">13399.80</span>
                                </td>
                                <td>
                                    <span id="totalAfterTreasuryTwo">0.00</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  
                {{--  end الموقف المالي للجهة && الموقف المالي للخزينة --}}
            </div> 
    
    
            <div class="row footer-btn-group justify-content-center">
                <button class="col-lg-2 btn btn-success-gradient btn-rounded mb-2" id="save_bill">
                    <i class="mdi mdi-content-save"></i> حفظ المعاملة
                </button>

                <button class="col-lg-2 btn btn-warning-gradient btn-rounded mb-2 refresh_page">
                    <i class="mdi mdi-refresh"></i> الغاء  المعاملة
                </button>
    
            </div>
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
                



                //clientOrSupplier(value);
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


</body>
</html>
