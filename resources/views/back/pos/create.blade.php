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

    @include('back.pos.style')
</head>
<body id="pos_create">
    <div class="container-fluid">

        {{--  start calc  --}}
        @include('back.layouts.calc')
        {{--  end calc  --}}

        {{--  start modal_search_product  --}}
        @include('back.pos.modal_search_product')
        {{--  end modal_search_product  --}}



        {{--  ///////////////////////////////////////////////// start navbar /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start navbar /////////////////////////////////////////////////  --}}
        {{--  <div class="header d-flex align-items-center justify-content-between flex-wrap text-center" style="background: #dbdaee;margin-bottom: 12px;border-radius: 0 0 10px 10px;">  --}}
        <div class="header d-flex align-items-center justify-content-between flex-wrap row" style="background: #dbdaee;margin-bottom: 12px;border-radius: 0 0 10px 10px;">

            {{--  right  --}}
            <div class="col-md-8">
                <div class="">

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <select class="form-control form-control-sm" >
                                <option>Walk In Customer</option>
                            </select>
                        </div>

                        <div class="col-md-1 col-sm-12">
                            <button class="btn btn-light btn-sm"><i class="fas fa-user-plus"></i></button>
                        </div>

                        <div class="col-md-6 col-sm-12" style="position: relative;">
                            <input type="text" class="form-control form-control-sm" placeholder="بحث عن صنف" >
                            
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

                        <div class="col-md-1 col-sm-12">
                            <button class="btn btn-light btn-sm" data-effect="effect-scale" data-toggle="modal" href="#modal_search_product">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{--  left  --}}
            <div class="col-md-4 text-left">
                <div class="btn-group">
                    <button class="btn btn-light btn-sm" data-effect="effect-scale" data-toggle="modal" href="#calc"><i class="fas fa-calculator"></i></button>
                    <button class="btn btn-light btn-sm"><i class="fas fa-bell"></i></button>
                    <button class="btn btn-light btn-sm"><i class="fas fa-sync-alt"></i></button>
                    <button class="btn btn-light btn-sm"><i class="fas fa-maximize"></i></button>
                </div>
            </div>            
        </div>
        {{--  ///////////////////////////////////////////////// end navbae /////////////////////////////////////////////////
        ///////////////////////////////////////////////// end navbae /////////////////////////////////////////////////  --}}




 



        {{--  ///////////////////////////////////////////////// start main-content /////////////////////////////////////////////////
        ///////////////////////////////////////////////// start main-content /////////////////////////////////////////////////  --}}

        <div class="main-content">
            {{--  <div class="row">  --}}
                <div class="cart p-3 no-scrollbar col-lg-8 col-12"> 
                    <table class="table table-bordered table-hover" id="products_table" style="height: 100px;overflow: hidden;">
                        <thead class="text-center thead-dark">
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
                                    <td><button class="btn btn-danger btn-sm btn-icon remove_this_tr" onclick="removeThisTr('#pos_create #products_table'); new Audio('{{ url('back/sounds/failed.mp3') }}').play();"><i class="fas fa-times"></i></button></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

            
                <div class="product-selection p-3 no-scrollbar col-lg-4 col-12">
                    <div class="text-center" style="width: 175px;font-weight: bold;text-decoration: underline;background: #3b8ce2;color: #fff;padding: 6px 10px;border-radius: 3px;margin: 0 auto;">
                        فاتورة بيع: <span class="">139</span>
                    </div>
                    
                    <div class="text-center">
                        <span class="badge badge-light" id="date"></span>
                        <span class="badge badge-danger mx-2" id="time" style="font-weight: bold;"></span>
                        {{--  <button class="btn btn-dark btn-sm ml-2"><i class="fas fa-sign-out-alt"></i> Sign Out</button>  --}}
                    </div>

                    <br>

                    <div class="total-bar d-flex align-items-center justify-content-between" style="padding: 10px;border-top: 2px solid #ddd; ">
                        <div>
                            <p id="countTableTr">عدد العناصر: <span>0</span></p>
                            <p>Sub Total: 32000.00</p>
                            <p>Tax: 5760.00</p>
                            <p>Coupon: 0.00</p>
                        </div>
                        <div>
                            <p>Total Payable: 37760.00</p>
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
            <button class="btn btn-primary btn-sm" id="order"><i class="fas fa-check"></i> Order</button>
            <button class="btn btn-secondary btn-sm"><i class="fas fa-quote-left"></i> Quote</button>
            <button class="btn btn-warning btn-sm"><i class="fas fa-pause"></i> Hold Order</button>
            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Cancel</button>
            <button class="btn btn-success btn-sm"><i class="fas fa-gift"></i> Coupon</button>
            <button class="btn btn-info btn-sm"><i class="fas fa-percentage"></i> % Discount</button>
            <button class="btn btn-light btn-sm"><i class="fas fa-credit-card"></i> Credit Card</button>
            <button class="btn btn-dark btn-sm"><i class="fas fa-file-alt"></i> Quotation</button>
        </div>
        {{--  ///////////////////////////////////////////////// end footer /////////////////////////////////////////////////
        ///////////////////////////////////////////////// end footer /////////////////////////////////////////////////  --}}

    </div>

    <!-- JQuery min js -->
    <script src="{{ asset('back') }}/assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/bootstrap-rtl.js"></script>
    <script src="{{ asset('back') }}/assets/all.min.js"></script>
    <script src="{{ asset('back') }}/pos/js/customJs.js"></script>

    <script>
        $(document).ready(function () {

        });
    </script>
</body>
</html>
