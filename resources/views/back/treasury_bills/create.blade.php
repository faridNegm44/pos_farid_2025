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
        <title> {{ GeneralSettingsInfo()->app_name }}: {{ $pageNameAr }} </title>

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

            bold{
                font-size: 10px;
                color: #000;
                text-shadow: 2px 2px 4px red;
            }
        </style>
	</head>


<body>

    <div id="overlay_page"></div>

    @include('back.layouts.header')
    @include('back.layouts.navbar')
    
    <div class="page" id="page_create_treasury_bill" style="margin-top: 30px;min-height: 0vh;">    
        
        
        <div class="container">
            
            <div class="panel-group1" id="accordion11">
                <div class="panel panel-default  mb-4">
                    <div class="panel-heading1 bg-warning-gradient ">
                        <h4 class="panel-title1">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#collapseFour1" aria-expanded="false">
                                ملاحظات حول كيفية إضافة معاملة في الخزينة
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour1" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="">
                        <div class="panel-body border">
                            <ul style="font-size: 11px;">
                                <ol>
                                    <li>اختر نوع المعاملة أولاً، سواء كان إذن توريد نقدية، أو صرف نقدية، أو ارتجاع نقدية.</li>
                                    <li>بعد ذلك، حدد الخزينة التي سيتم تنفيذ الإذن عليها.</li>
                                    <li>ثم، حدد الجهة المراد تنفيذ الإذن عليها، سواء كانت موردًا أو عميلًا أو شريكا.</li>
                                    <li>يجب اختيار جهة واحدة فقط.</li>
                                    <li>اكتب مبلغ الإذن.</li>
                                </ol>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <h5 class="text-center" style="background: #383a3e;color: #fff;padding: 10px;border-radius: 0px;margin: 0 auto;">
                {{ $pageNameAr }}
            </h5>
            <form class="" id="form">
                @csrf

                <div class="bg-secondary-gradient" style="padding: 0px 15px;">
    
                    {{--  start نوع المعامل && العملاء && الموردين --}}
                    <div class="row justify-content-center" style="padding: 10px 10px 0 10px;">
                        <div class="col-lg-2">
                            <label for="treasury_type" class="text-dark">نوع المعاملة</label>
                            <i class="fas fa-star require_input"></i>
                            <select class="form-control" id="treasury_type" name="treasury_type" required>
                                <option value="" selected>نوع المعاملة</option>                              
                                <option value="اذن توريد نقدية">اذن توريد نقدية</option>
                                <option value="اذن صرف نقدية">اذن صرف نقدية</option>
                                {{--<option value="اذن ارتجاع نقدية">اذن ارتجاع نقدية</option>--}}
                            </select>
                            <bold id="errors-treasury_type" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-2">
                            <label for="treasury_id" class="text-dark">اختر الخزينة المالية</label>
                            <i class="fas fa-star require_input"></i>
                            <select class="form-control" id="treasury_id" name="treasury_id">
                                <option value="" selected>اختر الخزينة المالية</option>                              
                                @foreach ($treasuries as $treasury)
                                    <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ display_number($treasury->treasury_money_after) }}</option>                                
                                @endforeach
                            </select>
                            <bold id="errors-treasury_id" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-2">
                            <label for="user" class="text-dark">الجهة</label>
                            <i class="fas fa-star require_input"></i>
                            <select class="form-control" id="user">
                                <option value="" selected disabled>الجهة</option>                              
                                <option value="عميل">عميل</option>                                
                                <option value="مورد">مورد</option>                                
                                <option value="شريك">شريك</option>                                
                            </select>
                            <bold id="errors-user" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-4" id="clients" style="display: none;">
                            <label for="" class="text-dark">العملاء</label>
                            <i class="fas fa-star require_input"></i>
                            <select class="selectize clients" name="client">
                                <option value="" disabled selected>العملاء</option>     
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">
                                        ( {{ $client->id }} ) -
                                        ( {{ $client->name }} )
    
                                        @if ($client->phone)
                                            ( {{ $client->phone }} )
                                        @endif                                    
                                    </option>
                                @endforeach                         
                            </select>
                            <bold id="errors-client_supplier_id" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-4" id="suppliers" style="display: none;">
                            <label for="" class="text-dark">الموردين</label>
                            <i class="fas fa-star require_input"></i>
                            <select class="selectize suppliers" name="supplier">
                                <option value="" disabled selected>الموردين</option>                              
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">
                                        ( {{ $supplier->id }} ) - 
                                        ( {{ $supplier->name }} )
    
                                        @if ($supplier->phone)
                                            ( {{ $supplier->phone }} )
                                        @endif                                    
                                    </option>
                                @endforeach       
                            </select>
                            <bold id="errors-client_supplier_id" style="display: none;"></bold>
                        </div>    
                        
                        <div class="col-lg-4" id="partners"  style="display: none;">
                            <label for="" class="text-dark">الشركاء</label>
                            <i class="fas fa-star require_input"></i>
                            <select class="selectize partners" name="partner">
                                <option value="" disabled selected>الشركاء</option>                              
                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->id }}">
                                        ( {{ $partner->id }} ) - 
                                        ( {{ $partner->name }} )
    
                                        @if ($partner->phone)
                                            ( {{ $partner->phone }} )
                                        @endif                                    
                                    </option>
                                @endforeach       
                            </select>
                            <bold id="errors-partners_id" style="display: none;"></bold>
                        </div>    
                    </div>
                    {{--  start نوع المعامل && العملاء && الموردين --}}
                    
                    
            
                    {{--  start مبلغ المعاملة && ملاحظات --}}
                    <div class="row justify-content-center" style="margin: 10px 0 20px;">
                        <div class="col-lg-2">
                            <label for="value" class="text-dark">مبلغ المعاملة</label>
                            <i class="fas fa-star require_input"></i>
                            <input type="number" class="form-control mb-1 text-center" name="value" id="value" min="1" placeholder="مبلغ المعاملة" style="font-size: 13px;" required>  
                        </div>
                        <bold id="errors-value" style="display: none;"></bold>
                        
                        <div class="col-lg-2">
                            <label for="date" class="text-dark">تاريخ المعاملة</label>
                            <input type="date" class="form-control mb-1 text-center" name="date" id="date" min="1" placeholder="تاريخ المعاملة" style="font-size: 13px;"  value="{{ date('Y-m-d') }}">  
                        </div>
                        <bold id="errors-date" style="display: none;"></bold>
                        
                        <div class="col-lg-6">
                            <label for="" class="text-dark">ملاحظات</label>
                            <input type="text" class="form-control" name="notes" id="notes" placeholder="ملاحظات">  
                        </div>
                        <bold id="errors-notes" style="display: none;"></bold>
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
                                    <th>قبل</th>
                                    <th>بعد</th>
                                </tr>
                                </thead>
                                <tbody style="background: #fff;">
                                <tr>
                                    <td>
                                        <span id="totalBeforeTreasury">0</span>
                                        <input id="totalBeforeTreasuryInput" type="hidden" value="0">
                                    </td>
                                    <td><span id="totalAfterTreasury">0</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
        
                        <div class="col-lg-6 col-12"> 
                            <table class="table table-bordered text-center">
                                <caption style="text-align: center;caption-side: top;font-weight: inherit;font-size: 10pt;background: #383a3e;color: white;">
                                    الموقف المالي للجهة
                                    <span id="userStatus" style="margin: 0 5px;color: #deea17;display: none;"></span>
                                </caption>
                                <thead class="">
                                <tr>
                                    <th>قبل</th>
                                    <th>متبقي/لة</th>
                                </tr>
                                </thead>
                                <tbody  style="background: #fff;">
                                <tr>
                                    <td><span id="totalBeforeUser" style="color: red;">0</span></td>
                                    <td><span id="totalAfterUser" style="color: red;">0</span></td>
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
            </form>
    
        </div>
    </div>

    @include('back.layouts.footer')



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
     <!-- Internal Modal js-->
     <script src="{{ url('back') }}/assets/js/modal.js"></script>
     {{-- bootstrap.bundle --}}
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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



        // start function resetDefault
            function resetDefault(){
                $('#value').val('');
                $('#totalBeforeTreasury').text(0);
                $('#totalBeforeTreasuryInput').val(0);
                $('#totalAfterTreasury').text(0);
                $('#totalBeforeUser').text(0);
                $('#totalAfterUser').text(0);
                $('#userStatus').css('display', 'none').text('');
            }
        // end function resetDefault



        // start when change نوع المعاملة
            $("#treasury_type").on("change", function(){
                //resetDefault();
                $('#value').val('');
                $("#treasury_id").val('');
                $('#totalBeforeTreasury').text(0);
                $('#totalBeforeTreasuryInput').val(0);
                $('#totalAfterTreasury').text(0);
                $('.clients')[0].selectize.setValue('');
                $('.suppliers')[0].selectize.setValue('');
                $('.partners')[0].selectize.setValue('');
            });
        // end when change نوع المعاملة



        // start when change الخزينة المالية
            $("#treasury_id").on("change", function(){
                //resetDefault();
                $('#value').val('');
                $('#totalBeforeTreasury').text(0);
                $('#totalBeforeTreasuryInput').val(0);
                $('#totalAfterTreasury').text(0);
                $('#userStatus').text('');
                $('.clients')[0].selectize.setValue('');
                $('.suppliers')[0].selectize.setValue('');
                $('.partners')[0].selectize.setValue('');
            });
        // end when change الخزينة المالية



        // start when change clients or suppliers
            $(document).ready(function() {
                resetDefault();
                
                const $clients = $(".clients").selectize();
                const $suppliers = $(".suppliers").selectize();
                const $partners = $(".partners").selectize();

                const clientsSelectize = $clients[0].selectize;
                const suppliersSelectize = $suppliers[0].selectize;
                const partnersSelectize = $partners[0].selectize;


                // start function check if checked client and supplier in same time
                function checKifFoundCliendAndSupplierVal(){
                    if($('.clients').val() && $('.suppliers').val() || $('.clients').val() && $('.partners').val() || $('.suppliers').val() && $('.partners').val()){
                        resetDefault();
                        location.reload();    
                    }
                }
                // end function check if checked client and supplier in same time



                // start function get cleint or supplier info
                function getClientOrSupplierOrPartnerInfo(id, type){
                    const url = `{{ url('get_info/client_or_supplier') }}/${id}/${type}`;
                    $.ajax({
                        type: "GET",
                        url: url,
                        beforeSend: function(){
                            $("#totalBeforeUser").text(0);
                            $("#totalAfterUser").text(0);
                            $("#userStatus").css('display', 'none');
                        },
                        success: function(res){
                            console.log(res);

                            if(res && res != null){
                                alertify.set('notifier','position', 'top-center');
                                alertify.set('notifier','delay', 3);
                                alertify.success("تم استدعاء الموقف المالي للجهة بنجاح");
                                
                                if(res < 0){
                                    $("#totalBeforeUser").text(parseFloat(res));          
                                    $("#userStatus").css('display', 'inline').text(`دائن (له): ${parseFloat(res).toLocaleString()}`);
                                }else{
                                    $("#totalBeforeUser").text(parseFloat(res));
                                    $("#userStatus").css('display', 'inline').text(`مدين (عليه): ${parseFloat(res).toLocaleString()}`);
                                }
                            }else if(res == null){
                                alert('s');
                            }                    
                        }
                    });             
                }
                // end function get cleint or supplier info

                clientsSelectize.on('change', function(value) {
                    let clientVal = $('.clients').val();
                    
                    if(clientVal){
                        $('#value').val('');
                        $('#totalAfterTreasury').text(0);
    
                        $("#overlay_page").fadeIn();
                        getClientOrSupplierOrPartnerInfo(clientVal, 'عميل');
                        $("#overlay_page").fadeOut();
                        checKifFoundCliendAndSupplierVal();
                    }else{
                        $('#value').val('');
                        $('#totalBeforeUser').text(0);
                        $('#totalAfterUser').text(0);
                        $('#userStatus').css('display', 'none').text('');
                    }
                });
                
                suppliersSelectize.on('change', function(value) {
                    let supplierVal = $('.suppliers').val();

                    if(supplierVal){
                        $('#value').val('');
                        $('#totalAfterTreasury').text(0);
    
                        $("#overlay_page").fadeIn();
                        getClientOrSupplierOrPartnerInfo(supplierVal, 'مورد');
                        $("#overlay_page").fadeOut();
                        checKifFoundCliendAndSupplierVal();
                    }else{
                        $('#value').val('');
                        $('#totalBeforeUser').text(0);
                        $('#totalAfterUser').text(0);
                        $('#userStatus').css('display', 'none').text('');
                    }
                });
                
                partnersSelectize.on('change', function(value) {
                    let partnerVal = $('.partners').val();

                    if(partnerVal){
                        $('#value').val('');
                        $('#totalAfterTreasury').text(0);
    
                        $("#overlay_page").fadeIn();
                        getClientOrSupplierOrPartnerInfo(partnerVal, 'شريك');
                        $("#overlay_page").fadeOut();
                        checKifFoundCliendAndSupplierVal();
                    }else{
                        $('#value').val('');
                        $('#totalBeforeUser').text(0);
                        $('#totalAfterUser').text(0);
                        $('#userStatus').css('display', 'none').text('');
                    }
                });
            });
        // end when change clients or suppliers



        // start function get treasury info
            function getTreasuryInfo(id){
                const url = `{{ url('get_info/treasury') }}/${id}`;

                $.ajax({
                    type: "GET",
                    url: url,
                    beforeSend: function(){
                        $("#totalBeforeTreasury").text(0);
                        $("#totalBeforeTreasuryInput").val(0);
                        $("#totalAfterTreasury").text(0);
                    },
                    success: function(res){                    
                        if(res.treasury_money_after){
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 3);
                            alertify.success("تم استدعاء بيانات الخزينة بنجاح");

                            $("#totalBeforeTreasury").text(parseFloat(res.treasury_money_after).toLocaleString());
                            $("#totalBeforeTreasuryInput").val(parseFloat(res.treasury_money_after));
                        }
                    }
                });             
            }

            $('#treasury_id').on('change', function(value) {
                $("#overlay_page").fadeIn();
                getTreasuryInfo($(this).val());
                $("#overlay_page").fadeOut();
            });
        // end function get treasury info




        // start when change user سواء عميل او مورد او شريك 
        $('#user').on('change', function(){
            const thisVal = $(this).val();

            $("#overlay_page").fadeIn();
            $("#clients, #suppliers, #partners").fadeOut();
            
            $('.clients')[0].selectize.setValue('');
            $('.suppliers')[0].selectize.setValue('');
            $('.partners')[0].selectize.setValue('');
            
            $("#overlay_page").fadeOut();

            if(thisVal == 'عميل'){
                $("#clients").fadeIn();
                
            }else if(thisVal == 'مورد'){
                $("#suppliers").fadeIn();
                
            }else if(thisVal == 'شريك'){
                $("#partners").fadeIn();

            }
        });
        // end when change user سواء عميل او مورد او شريك 




        // start when change مبلغ المعاملة
            $("#value").on("input", function(){
                //$("#overlay_page").fadeIn();

                const thisVal = parseFloat($(this).val());
                const treasury_id = $("#treasury_id").val(); // استرجاع قيمة treasury_id
                const totalBeforeUser = $("#totalBeforeUser").text();
                const treasury_type = $("#treasury_type").val();
                const clients = $(".clients");
                const suppliers = $(".suppliers");
                const partners = $(".partners");
                const totalBeforeTreasuryInput = parseFloat($("#totalBeforeTreasuryInput").val());


                if (!treasury_id || !treasury_type) {
                    alert('قم باختيار نوع المعاملة ثم الخزينة ثم عميل او مورد');
                    $(this).val('');

                }else{

                    if (!isNaN(thisVal) && !isNaN(totalBeforeUser)) { // start check if thisVal and totalBeforeUser is numbers

                        if(thisVal < 1){  // start check if thisVal big than 1
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 3);
                            alertify.error(" مبلغ المعاملة يجب ان يكون أكبر من صفر");
                            $(this).val('');

                        } else{
                            
                            if(treasury_type == 'اذن توريد نقدية'){  // start check if treasury_type == اذن توريد نقدية

                                if (thisVal <= totalBeforeUser) {  // start check if thisVal <= totalBeforeUser
                                    $("#totalAfterUser").text('متبقي '+(totalBeforeUser - thisVal).toFixed(2)); // حساب مبلغ الجهه
                                }else{
                                    $("#totalAfterUser").text('لة '+(thisVal - totalBeforeUser).toFixed(2)); // حساب مبلغ الجهه
                                } // end check if thisVal <= totalBeforeUser
        
                                $('#totalAfterTreasury').text((thisVal + totalBeforeTreasuryInput).toLocaleString()); // تزويد مبلغ الخزينة
                            



                            } else if(treasury_type == 'اذن صرف نقدية'){  // start check if treasury_type == اذن صرف نقدية
                                if(thisVal > totalBeforeTreasuryInput){
                                    alertify.set('notifier','position', 'top-center');
                                    alertify.set('notifier','delay', 3);
                                    alertify.error(" مبلغ المعاملة أكبر من مبلغ الخزينة");

                                    $(this).val('');
                                    $("#totalAfterUser").text(0);
                                    $('#totalAfterTreasury').text(0);

                                }else{

                                    if (totalBeforeUser < 0) {
                                        
                                        if(thisVal > (totalBeforeUser * -1)){
                                            $("#totalAfterUser").text('علية '+(thisVal - (totalBeforeUser * -1)).toFixed(2)); // حساب مبلغ الجهه

                                        }else{
                                            $("#totalAfterUser").text('لة '+((totalBeforeUser * -1) - thisVal).toFixed(2)); // حساب مبلغ الجهه
                                        }

                                    } else {
                                        $("#totalAfterUser").text('علية '+(parseFloat(totalBeforeUser) + thisVal).toLocaleString()); // حساب مبلغ الجهه
                                    }


                                    $('#totalAfterTreasury').text((totalBeforeTreasuryInput - thisVal).toLocaleString()); // تزويد مبلغ الخزينة
                                }


                            }  // end check if treasury_type == اذن ارتجاع نقدية || اذن صرف نقدية || اذن صرف نقدية

                        }  // end check if thisVal big than 1

                    } else{
                        $("#totalAfterUser").text(0);
                        $('#totalAfterTreasury').text(0);
                    }  // end check if thisVal and totalBeforeUser is numbers                
                }

                
            });
        // end when change مبلغ المعاملة


        
        // start save treasury bill when click save bill btn
            $("#save_bill").on("click", function(e){
                e.preventDefault();

                const treasury_type = $("#treasury_type").val();
                const treasury_id = $("#treasury_id").val();
                const client = $(".clients").val();
                const supplier = $(".suppliers").val();
                const partner = $(".partners").val();
                const value = $("#value").val();

                //$("#overlay_page").fadeIn();


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

                }else if(!client && !supplier && !partner){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error("يُرجى اختيار جهة لإتمام المعاملة");
                    
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
        
                            $.ajax({
                                url: "{{ url($pageNameEn) }}/store",
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                data: new FormData($('#form')[0]),
                                beforeSend:function () {
                                    $('form [id^=errors]').text('');
                                    $("#overlay_page").fadeIn();
                                },
                                error: function(res){
                                    $.each(res.responseJSON.errors, function (index , value) {
                                        $(`form #errors-${index}`).css('display' , 'block').text(value);
                                    });               
                                            
                                    $("#overlay_page").fadeOut();

                                    alertify.set('notifier','position', 'top-center');
                                    alertify.set('notifier','delay', 3);
                                    alertify.error("هناك شيئ ما خطأ");
                                },
                                success: function(res){
                                    $("#overlay_page").fadeOut();                                    
                                    alert('تم تنفيذ المعاملة بنجاح ✅');
                                    
                                    location.reload();
                                }
                            });
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
