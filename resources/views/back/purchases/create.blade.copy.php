<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <!-- Bootstrap css-->
    <link href="{{ asset('back') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('back') }}/assets/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:slnt,wght@11,200..1000&family=Changa:wght@200..800&display=swap" rel="stylesheet">

    {{-- selectize --}}
    <link href="{{ asset('back/assets/selectize.css') }}" type="text/css" rel="stylesheet"/>
    {{-- alertify --}}
    <link href="{{ asset('back/assets/css-rtl/alertify.rtl.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('back/assets/css-rtl/default.rtl.min.css') }}" type="text/css" rel="stylesheet"/>
    
    @include('back.pos.css_js.main_css')
</head>
<body id="pos_create">
    <div class="container-fluid">

        {{--  start calc  --}}
        @include('back.layouts.calc')
        {{--  end calc  --}}

        {{--  start modal_search_product  --}}
        @include('back.pos.modal_search_product')
        {{--  end modal_search_product  --}}

        {{--  start modal_save_bill  --}}
        @include('back.pos.modal_save_bill')
        {{--  end modal_save_bill  --}}

        {{--  start modal_dismissal_noticess  --}}
        @include('back.pos.modal_dismissal_notices')
        {{--  end modal_dismissal_noticess  --}}

        <style>
            .alertify .ajs-body .ajs-content{
                font-size: 13px !important;
            }
        </style>


        <div class="overlay_div">
            <div class="spinner spinner-border " role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>


        {{--  ///////////////////////////////////////////////// start navbar /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start navbar /////////////////////////////////////////////////  --}}
        <div class="header d-flex align-items-center justify-content-between flex-wrap row" style="background: #15222f;margin: 0;margin-bottom: 12px;border-radius: 0 0 15px 15px;">

            {{--  right  --}}
            <div class="col-lg-9">
                <div class="">
                    <div class="row">
                        <div class="col-lg-4" style="margin-top: 5px !important;">
                            <select class="selectize">
                                <option value="" selected>العملاء</option>                              
                                <option>اسماء نجم</option>
                                <option>ام ليلي</option>
                                <option>ali</option>
                                <option>farid</option>
                            </select>
                        </div>

                        <div class="col-lg-7 col-sm-12" style="position: relative;margin: 5px 0;">
                            <input type="text" class="form-control form-control-sm" style="height: 30px !important;" placeholder="بحث عن صنف" autofocus>
                            
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

                        <div class="col-lg-1" id="search_button" style="margin-top: 2px;">
                            <button class="btn btn-light btn-sm btn-block" style="margin: 5px 0px;" data-effect="effect-scale" data-toggle="modal" href="#modal_search_product" data-toggle="tooltip" title="بحث عن صنف">
                                <i class="fas fa-search-plus" style="font-size: 18px !important;"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{--  left  --}}
            <div class="col-lg-3 text-left" id="icons_left">
                <div class="btn-group">
                    <a href="{{ url('/') }}" target="_blank" style="color: #fff;" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="الصفحة الرئيسية">
                        <i class="fas fa-store"></i>
                    </a>
                    <button class="btn btn-warning btn-sm"><i class="fas fa-maximize"></i></button>
                </div>
            </div>            
        </div>
        {{--  ///////////////////////////////////////////////// end navbae /////////////////////////////////////////////////
        ///////////////////////////////////////////////// end navbae /////////////////////////////////////////////////  --}}




 



        {{--  ///////////////////////////////////////////////// start main-content /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start main-content /////////////////////////////////////////////////  --}}

        <div class="main-content" style="background: white !important;margin-bottom: 30px;">
            {{--  <div class="row">  --}}

                {{-- right --}}
                <div class="cart p-3 no-scrollbar"> 
                    <table class="table table-hover nowrap" id="products_table">
                    {{--<table class="table table-bordered table-striped table-hover text-center nowrap" id="products_table">--}}
                        <thead class="text-center thead-dark" style="position: sticky; top: -14px;">
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
                                    <td class="prod_name">كوشن فرو في جلد ابيض مصري </td>
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

                {{-- left --}}
                
                <div class="product-selection p-3 no-scrollbar total_info">
                    <div class="text-center" style="width: 175px;font-weight: bold;text-decoration: underline;background: #3b8ce2;color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
                        فاتورة بيع: <span style="font-size: 15px;margin: 0px 5px;">1397635</span>
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
            {{--  </div>  --}}
        </div>

        {{--  ///////////////////////////////////////////////// end main-content /////////////////////////////////////////////////
        ///////////////////////////////////////////////// end main-content /////////////////////////////////////////////////  --}}







        {{--  ///////////////////////////////////////////////// start footer /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start footer /////////////////////////////////////////////////  --}}
        <div class="footer-btn-group">
            <button class="btn btn-warning btn-sm"><i class="fas fa-pause">
                </i> تعليق الفاتورة
            </button>

            <button class="btn btn-success btn-sm"><i class="fas fa-user-plus">
                </i> عميل جديد
            </button>

            <button class="btn btn-danger btn-sm refresh_page">
                <i class="fas fa-refresh"></i> الغاء  الفاتورة
            </button>

            <button class="btn btn-light btn-sm" id="save_bill" data-effect="effect-scale" data-toggle="modal" href="#modal_save_bill">
                <i class="fas fa-check-double"></i> حفظ الفاتورة
            </button>

            <button class="btn btn-primary btn-sm" id="dismissal_notices" data-effect="effect-scale" data-toggle="modal" href="#modal_dismissal_notices">
                <i class="fas fa-money-bill"></i> مصروفات الإذن
            </button>
            
            <button class="btn btn-secondary btn-sm" data-effect="effect-scale" data-toggle="modal" href=".calc">
                <i class="fas fa-calculator"></i> % الالة الحاسبة
            </button>
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
        @include('back.pos.css_js.main_js')
    </script>

    {{--  start refresh_page  --}}
        @include('back.layouts.refresh_page')
    {{--  end refresh_page  --}}
    
</body>
</html>
