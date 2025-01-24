<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageNameAr }}</title>
    <!-- Bootstrap css-->
    <link href="{{ asset('back') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('back') }}/assets/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:slnt,wght@11,200..1000&family=Changa:wght@200..800&display=swap" rel="stylesheet">

    {{-- selectize --}}
    <link href="{{ asset('back/assets/selectize.css') }}" type="text/css" rel="stylesheet"/>
    {{-- alertify --}}
    <link href="{{ asset('back/assets/css-rtl/alertify.rtl.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('back/assets/css-rtl/default.rtl.min.css') }}" type="text/css" rel="stylesheet"/>

    <style>
        .alertify .ajs-body .ajs-content{
            font-size: 13px !important;
        }
        body {
            overflow: auto !important;
        }
        .main-content {
            display: flex;
            flex-direction: column;
            height: auto !important;
        }
    </style>
    
    @include('back.pos.css_js.main_css')
</head>
<body id="">
    <div class="container-fluid">

        {{--  start calc  --}}
            @include('back.layouts.calc')
        {{--  end calc  --}}

        {{--  start modal_save_bill  --}}
            {{--@include('back.pos.modal_save_bill')--}}
        {{--  end modal_save_bill  --}}

        {{--<div class="overlay_div">
            <div class="spinner spinner-border " role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>--}}


        {{--  ///////////////////////////////////////////////// start navbar /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start navbar /////////////////////////////////////////////////  --}}
        <div class="" style="background: #15222f;margin: 0;margin-bottom: 12px;border-radius: 0 0 15px 15px;padding: 10px;">

            <div class="row">
                <div class="col-lg-2">
                    <select class="selectize" style="margin: 5px 0;">
                        <option selected>نوع المعاملة</option>                              
                        <option value="اذن توريد نقدية">اذن توريد نقدية</option>
                        <option value="اذن صرف نقدية">اذن صرف نقدية</option>
                        <option value="اذن ارتجاع نقدية">اذن ارتجاع نقدية</option>
                    </select>
                </div>
               
                <div class="col-lg-2">
                    <select class="selectize" style="margin: 5px 0;">
                        <option selected>اختر الخزينة المالية</option>                              
                        <option value="اذن توريد نقدية">اذن توريد نقدية</option>
                        <option value="اذن صرف نقدية">اذن صرف نقدية</option>
                        <option value="اذن ارتجاع نقدية">اذن ارتجاع نقدية</option>
                    </select>
                </div>
                
                <div class="col-lg-4" id="clients">
                    <select class="selectize clients" style="margin: 5px 0;">
                        <option value="" selected>العملاء</option>                              
                        <option value="شركة العاصفة سيبسيب">شركة العاصفة سيبسيب 01012775704</option>
                        <option value="ام ليلي">ام ليلي</option>
                        <option value="ali">ali</option>
                        <option value="farid">farid</option>
                    </select>
                </div>
                
                <div class="col-lg-4" id="suppliers">
                    <select class="selectize suppliers" style="margin: 5px 0;">
                        <option value="" selected>الموردين</option>                              
                        <option value="اسماء نجم">اسماء نجم</option>
                        <option value="ام ليلي">ام ليلي</option>
                        <option value="ali">ali</option>
                        <option value="farid">farid</option>
                    </select>
                </div>
        
            </div>
            
        </div>
        {{--  ///////////////////////////////////////////////// end navbae /////////////////////////////////////////////////
        ///////////////////////////////////////////////// end navbae /////////////////////////////////////////////////  --}}




 



        {{--  ///////////////////////////////////////////////// start main-content /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start main-content /////////////////////////////////////////////////  --}}

        <div class="main-content container cart p-3 no-scrollbar" style="background: white !important;display: block !important;">
            <div style="margin-bottom: 20px;">
                <div class="text-center" style="width: 100%;font-weight: bold;text-decoration: underline;background: #269579;color: #fff;padding: 10px;border-radius: 0px;margin: 0 auto;">
                    {{ $pageNameAr }}: <span style="font-size: 15px;margin: 0px 5px;">1397635</span>
                </div>
                
                <div class="text-center" id="date_time">
                    <span class="badge badge-light" id="date"></span>
                    <span class="badge badge-danger mx-2" id="time" style="font-weight: bold;font-size: 15px !important;margin-top: 10px;"></span>
                </div>

                <br>

                <div class="d-flex align-items-center justify-content-between" style="padding: 10px;">
                    <input type="text" class="form-control" name="" id="" placeholder="مبلغ المعاملة" style="width: 30%;margin: 0 10px;">  
                    <input type="text" class="form-control" name="" id="" placeholder="ملاحظات" style="width: 70%;margin: 0 10px;">  
                </div>
            </div>

            <div class="row" style="margin-bottom: 30px;">
                <div class="col-lg-6 col-12"> 
                    <table class="table table-bordered text-center">
                        <caption style="text-align: center;caption-side: top;font-weight: inherit;font-size: 10pt;background-color: rgb(63, 62, 62);color: white;">
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
                                <span id="totalBeforeTreasuryOne" style="font-weight: bold;font-size: 14px;display: block;color: red;">13399.80</span>
                            </td>
                            <td>
                                <span id="totalBeforeTreasuryTwo" style="font-weight: bold;font-size: 14px;display: block;color: red;">0.00</span>
                            </td>
                        </tr>
                        <tr>
                            <td>بعد</td>
                            <td>
                                <span id="totalAfterTreasuryOne" style="font-weight: bold;font-size: 14px;display: block;color: red;">13399.80</span>
                            </td>
                            <td>
                                <span id="totalAfterTreasuryTwo" style="font-weight: bold;font-size: 14px;display: block;color: red;">0.00</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-6 col-12"> 
                    <table class="table table-bordered text-center">
                        <caption style="text-align: center;caption-side: top;font-weight: inherit;font-size: 10pt;background-color: rgb(62, 62, 63);color: white;">
                            الموقف المالي للجهة
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
                                <span id="totalBeforeTreasuryOne" style="font-weight: bold;font-size: 14px;display: block;color: red;">13399.80</span>
                            </td>
                            <td>
                                <span id="totalBeforeTreasuryTwo" style="font-weight: bold;font-size: 14px;display: block;color: red;">0.00</span>
                            </td>
                        </tr>
                        <tr>
                            <td>بعد</td>
                            <td>
                                <span id="totalAfterTreasuryOne" style="font-weight: bold;font-size: 14px;display: block;color: red;">13399.80</span>
                            </td>
                            <td>
                                <span id="totalAfterTreasuryTwo" style="font-weight: bold;font-size: 14px;display: block;color: red;">0.00</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                
        </div>

        {{--  ///////////////////////////////////////////////// end main-content /////////////////////////////////////////////////
        ///////////////////////////////////////////////// end main-content /////////////////////////////////////////////////  --}}







        {{--  ///////////////////////////////////////////////// start footer /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start footer /////////////////////////////////////////////////  --}}
        <div class="footer-btn-group">
            <button class="btn btn-warning btn-sm refresh_page">
                <i class="fas fa-refresh"></i> الغاء  المعاملة
            </button>

            <button class="btn btn-light btn-sm" id="save_bill" data-effect="effect-scale" data-toggle="modal" href="#modal_save_bill">
                <i class="fas fa-check-double"></i> حفظ الفاتورة
            </button>

            
            <button class="btn btn-secondary btn-sm" data-effect="effect-scale" data-toggle="modal" href="#calc">
                <i class="fas fa-calculator"></i> % الالة الحاسبة
            </button>

            <a class="btn btn-danger btn-sm text-light" href="{{ url('/') }}">
                <i class="fas fa-store" style="margin-top: 8px;"></i> الصفحة الرئيسية
            </a>
        </div>
        {{--  ///////////////////////////////////////////////// end footer /////////////////////////////////////////////////
        ///////////////////////////////////////////////// end footer /////////////////////////////////////////////////  --}}

    </div>

    {{--  JQuery min js  --}}
    <script src="{{ asset('back') }}/assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/bootstrap-rtl.js"></script>
    <script src="{{ asset('back') }}/assets/all.min.js"></script>
    <script src="{{ asset('back') }}/pos/js/customJs.js"></script>
    
    {{--  selectize  --}}
    <script src="{{ asset('back/assets/selectize.min.js') }}"></script>

    {{--  alertify  --}}
    <script src="{{ asset('back/assets/js/alertify.min.js') }}"></script>
    

    <script>
        $(document).ready(function () {      
            const clients = $(".clients").selectize;
            const suppliers = $(".suppliers").selectize;
            
            $(clients).on('change', function(){
                
                if(clients && suppliers){
                    $(".clients").val('');
                    $(".suppliers").val('');

                    alertify.alert()
                    .setting({
                        'label': "تم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                        'title': 'خطأ <i class="fas fa-times text-danger" style="margin: 0px 3px;font-size: 25px;font-weight: bold;"></i>',
                        'message': '<span class="text-danger">عفوا. لا يمكن اختيار مورد وعميل في نفس الوقت</span>' ,
                    }).show();
                }
            });
        });        
    
    </script>





    <script>
        @include('back.pos.css_js.main_js')
    </script>

    {{--  start refresh_page  --}}
        @include('back.layouts.refresh_page')
    {{--  end refresh_page  --}}
    
</body>
</html>
