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

<body style="height: 100vh !important;overflow: auto;background: #b0ddc4 !important;">

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
                
    
    
    
    
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                {{-------------------------------------------------- start content تفاصيل الفاتورة و اجمالي السعر والضريبة و ... --------------------------------------------------}}
                <div class="" id="main_content" style="padding: 18px;margin-bottom: 60px;">
                    <div class="row"> 
    
                        <div class="col-lg-4 product-selection p-3 total_info" style="background: #70a584;">
                            <div class="text-center" style="text-decoration: underline;background: rgb(66 112 81);color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
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
                                                <input autocomplete="off" type="text" class="form-control text-center numValid focus_input"  id="extra_money" name="extra_money" placeholder="مبلغ المصاريف" style="font-size: 12px;" value="{{ display_number( $find[0]->extra_money ) }}"/>
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
    
    
    
                        <div class="col-lg-8" style="height: 70vh; overflow: auto; padding: 10px 10px 30px; background-image: url('{{ url('back/images/settings/farid logo bg pos white.png') }}'); background-size: cover; background-repeat: no-repeat;">
                            <table class="table table-hover table-bordered" id="products_table">                                
                                <thead class="bg bg-black-5">
                                    <tr>
                                        <th>#</th>
                                        <th class="nowarp_thead" style="width: 60px !important;min-width: 60px !important;">تم التعديل</th>
                                        <th class="nowarp_thead" style="width: 250px !important;min-width: 250px !important;">السلعة/الخدمة</th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">الوحدة</th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">ك المخزن</th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">
                                            ك مباعة
                                            <i class="fas fa-info-circle text-warning" data-bs-toggle="tooltip" title="⚠️ يُرجى إتمام عملية البيع باستخدام الوحدة الصغرى للمنتج، وذلك لضمان دقة العمليات الحسابية وسلامة بيانات الفاتورة."></i>
                                        </th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">س بيع</th>
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">خصم%</th>                                                                                        
                                        <th class="nowarp_thead" style="width: 100px !important;min-width: 100px !important;">ضريبة%</th>
                                        <th class="nowarp_thead" style="width: 150px !important;min-width: 150px !important;">الإجمالي</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @foreach ($find as $item)    
                                        <tr id="tr_{{ $item->product_id }}">
                                            <th>{{ $item->product_id }}</th>
                                            <td>
                                                <input type="checkbox" class="row_changed_checkbox custom_check" disabled style="margin-left:5px; width:19px; height:19px;">
                                            </td>
                                            <td class="prod_name">
                                                {{ $item->productNameAr }}
                                                <input autocomplete="off" type='hidden' name="prod_name[]" value="{{ $item->product_id }}" />
                                            </td>
                                            <td class="">
                                                <span>{{ $item->smallUnitName }}</span>
                                                <input autocomplete="off" type='hidden' class='small_unit_numbers' value='{{ display_number( $item->small_unit_numbers ) }}' />      
                                            </td>
                                            <td>
                                                <input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center quantity_all" value="{{ display_number( $item->quantity_small_unit ) }}">                    
                                            </td>
                                            <td>
                                                <input autocomplete="off" type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sale_quantity" name="sale_quantity[]" value="{{ display_number( $item->product_bill_quantity ) }}" >
                                            </td>
                                            <td>
                                                <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input reqInput sellPrice" value="{{ 
                                                                    $item->current_sell_price_in_sale_bill != $item->sell_price_small_unit ? 
                                                                        display_number( $item->current_sell_price_in_sale_bill ) : 
                                                                        display_number( $item->sell_price_small_unit ) 
                                                                }}">                                    
                                            </td>
                                            <td>
                                                <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_discount" value="{{ display_number( $item->discount ) }}">
                                            </td>
                                            <td>
                                                <input autocomplete="off" readonly type="text" class="form-control form-control-sm inputs_table numValid text-center focus_input prod_tax" value="{{ display_number( $item->tax ) }}">
                                            </td>
                                            <td>
                                                <input autocomplete="off" type="text" readonly class="form-control form-control-sm inputs_table numValid text-center focus_input prod_total" name="prod_total[]" value="{{ display_number( $item->total_after ) }}">
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
    
    
    
    
    
    
    
    
    
    
    
    
    
                {{-------------------------------------------------- start footer --------------------------------------------------}}
                {{-------------------------------------------------- start footer --------------------------------------------------}}
                <div class="row footer-btn-group justify-content-center">
                    {{-- style="display: none;" --}}
                    <button class="col-lg-2 col-12 btn btn-success-gradient btn-rounded mb-2" data-placement="top" id="save_bill" data-effect="effect-scale" data-toggle="modal" href="#modal_save_bill" data-toggle="tooltip" title="حفظ الفاتورة">
                        <i class="fas fa-check-double"></i> 
                        <span class="d-none d-lg-inline">حفظ مرتجع الفاتورة</span>
                    </button>
    
                    <button class="col-lg-2 col-12 btn btn-danger-gradient btn-rounded mb-2 return_bill">
                        <i class="fas fa-reply"></i> 
                        <span class="d-none d-lg-inline">إرجاع الفاتورة كاملة</span>
                    </button>
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

    {{-- start when click return_bill --}}
        <script>
            $(".return_bill").on("click", function(){
                alertify.confirm(
                'تحذير !! <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>',
                `<div style="text-align: center;">
                    <p style="">
                        هل أنت متأكد من إرجاع الفاتورة كاملة؟ 🧾↩️
                    </p>
                </div>`,
                function(){
                    $('.row_changed_checkbox').each(function() {
                        $(this).prop('checked', true); // تحديد كل صنف في الفاتورة
                        $(this).closest('tr').css('background-color', '#f8d7da'); // تغيير لون الخلفية للصف المحدد
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
    {{-- end when click return_bill --}}

    

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




    {{-- عند تحميل الصفحة، احفظ القيم الأصلية في data-original--}}
        <script>
            $(document).ready(function () {
                $('#products_table tbody tr').each(function () {
                    var row = $(this);
                    row.find('.sellPrice').attr('data-original', row.find('.sellPrice').val());
                    row.find('.sale_quantity').attr('data-original', row.find('.sale_quantity').val());
                    row.find('.prod_discount').attr('data-original', row.find('.prod_discount').val());
                    row.find('.prod_tax').attr('data-original', row.find('.prod_tax').val());
                });

                // عند تغيير أي قيمة في الصف، يتم تفعيل أو إلغاء تفعيل الـ checkbox
                $(document).on('input', '.sellPrice, .sale_quantity, .prod_discount, .prod_tax', function () {
                    var row = $(this).closest('tr');
                    var checkbox = row.find('.row_changed_checkbox');

                    // القيم الحالية
                    var currentValues = {
                        sellPrice: row.find('.sellPrice').val(),
                        sale_quantity: row.find('.sale_quantity').val(),
                        prod_discount: row.find('.prod_discount').val(),
                        prod_tax: row.find('.prod_tax').val()
                    };

                    // القيم الأصلية (من attributes)
                    var originalValues = {
                        sellPrice: row.find('.sellPrice').attr('data-original'),
                        sale_quantity: row.find('.sale_quantity').attr('data-original'),
                        prod_discount: row.find('.prod_discount').attr('data-original'),
                        prod_tax: row.find('.prod_tax').attr('data-original')
                    };



                    


                    // تحقق إذا كانت القيم الحالية = الأصلية
                    if (
                        currentValues.sellPrice == originalValues.sellPrice &&
                        currentValues.sale_quantity == originalValues.sale_quantity &&
                        currentValues.prod_discount == originalValues.prod_discount &&
                        currentValues.prod_tax == originalValues.prod_tax
                    ) {
                        checkbox.prop('checked', false);
                        $(this).closest('tr').css('background-color', ''); 
                    } else {
                        checkbox.prop('checked', true);
                        $(this).closest('tr').css('background-color', '#f589894d');
                    }

                    // التاكد من ان الكميه المرتجعه لا تتجاوز كميه الفاتورة
                    if(currentValues.sale_quantity > originalValues.sale_quantity){
                        row.find('.sale_quantity').val(originalValues.sale_quantity);

                        alertify.set('notifier', 'position', 'bottom-center');
                        alertify.set('notifier', 'delay', 4);
                        alertify.error(`❌ الكمية المرتجعة (${currentValues.sale_quantity}) لا يمكن أن تتجاوز الكمية في الفاتورة (${originalValues.sale_quantity})`);
                        
                        checkbox.prop('checked', false);
                        $(this).closest('tr').css('background-color', ''); 

                        calcTotal();   
                    }
                    // التاكد من ان الكميه المرتجعه لا تتجاوز كميه الفاتورة

                });
            });
        </script>
    {{-- عند تحميل الصفحة، احفظ القيم الأصلية في data-original--}}




    {{-- start when change clients or suppliers --}}
    {{--<script>
        $(document).on('input', '#supplier', function() {      
            const client_id = $(thclients)[0].selectize.getValue();

            $.ajax({
                type: "GET",
                url: `{{ url('get_info/supplierInfo') }}/${client_id}`,
        clients: function(){
                    $("#on_him").text(0);
                    $("#for_him").text(0);
                },
                success: function(res){
                    alertify.set('notifier','position', 'bottom-center');
                    alertify.set('notifier','delay', 3);
                    alertify.success("تم استدعاء الموقف المالي للجهة بنجاح");
                    
                    if(res > 0){
                        $("#on_him").text(`${parseFloat(res).toLocaleString()}`);
                    }else{
                        $("#for_him").text(`${parseFloat(res).toLocaleString()}`);
                    } 
                }
            });                        
        });
    </script>--}}
    {{--end when change clients or suppliers --}}


    



    {{--  start when click finally_save_bill_btn to save bill --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '#finally_save_bill_btn', function(){
            let checkedCount = $('.row_changed_checkbox:checked').length;

            if (checkedCount === 0) {
                alertify.set('notifier', 'position', 'bottom-center');
                alertify.set('notifier', 'delay', 3);
                alertify.error("❌ لا يوجد أصناف تم تعديلها في الفاتورة");
                return false;
            }

            alertify.confirm(
                'انتبة !! <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>',
                `<div style="text-align: center;">
                    <p>هل انت متأكد من حفظ مرتجعات الفاتورة الحالية 🧾↩️</p>
                </div>`,
                function(){
                    $.ajax({
                        url: `{{ url('sales/store') }}`,
                        type: 'POST',
                        data: new FormData($('form')[0]),
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('form [id^=errors]').text('');
                            $("#products_table tbody input, select").css('border', '');
                            $(".tooltip-msg").remove();
                        },
                        error: function(res){
                            console.log(res.responseJSON.errors);

                            $('#modal_save_bill').removeClass('show').hide();
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');

                            $.each(res.responseJSON.errors, function (index, value) {
                                let [inputName, inputNumber] = index.split('.');
                                let row = $("#products_table tbody tr").eq(inputNumber);
                                row.find(`.${inputName}`)
                                    .css('border', '2px solid red')
                                    .after(`
                                        <i class="fas fa-info-circle text-danger tooltip-msg" data-bs-toggle="tooltip" title="${value}"></i>
                                    `);
                                $(`#errors-${index}`).show().text(value);
                            });
                        },
                        success: function(res){
                            if (res.errorClientPayment) {
                                alert(res.errorClientPayment);
                            } else if (res.sale_quantity_big_than_stock) {
                                alert(res.sale_quantity_big_than_stock);
                            } else {
                                alertify.confirm(
                                    'رائع <i class="fas fa-check-double text-success" style="margin: 0px 3px;"></i>', 
                                    `<span class="text-center">
                                        <span class="text-danger">تمت اضافة فاتورة المبيعات بنجاح</span>
                                        <strong class="d-block">هل تريد اضافه فاتورة مبيعات أخري</strong>
                                    </span>`,
                                    function(){ location.reload(); },
                                    function(){ window.location.href = "{{ url('sales') }}"; }
                                ).set({
                                    labels: {
                                        ok: "نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                                        cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                                    }
                                });
                            }
                        }
                    });
                },
                function() {}
            ).set({
                labels: {
                    ok: "نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                    cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                }
            });
        });
    </script>

    {{--  end when click finally_save_bill_btn to save bill --}}
    

    {{-- start general scripts --}}
    <script>
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
