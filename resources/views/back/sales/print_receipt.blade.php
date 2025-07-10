<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<title>{{ $nameAr }} - {{ $find[0]->first_name }} {{ $find[0]->last_name }} - {{ \Carbon\Carbon::parse($find[0]->orderCreatedAt)->format('d-m-Y h:i a') }}</title>--}}
    <title>{{ $pageNameAr }} {{ $saleBill[0]->id }} - {{ $saleBill[0]->clientName }} - {{ $saleBill[0]->created_at }}</title>

    <link rel="icon" href="{{ url('back') }}/images/settings/fiv.png" type="image/x-icon"/>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap" rel="stylesheet">

    <style>
        .panel-default {
            border: 0;
        }
        .heading_table{
            border: 1px dotted;
            margin: 10px auto 20px;
            box-shadow: 7px 7px 5px 0px rgb(182 182 182 / 75%);
        }
        th, td{
            padding: 2px 0 !important;
        }
        .company_info {
            margin-top: 15px;
            text-align: left;
            font-size: 7px;
            padding: 4px 0 0 !important;
        }
        th, td {
            padding: 0 !important;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            @page {
                margin: 5px;
            }

            body {
            margin: 5px !important;
            padding: 5px !important;
            }

            .table_info thead th {
                background-color: #a5a5a5 !important;
            }

            .totals_section .final_total {
                background-color: #a5a5a5 !important;
            }

            .header {
                page-break-before: avoid;
            }

            th, td {
                padding: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div style="border: 1px solid #000;padding: 10px;">

        <div class="">
            <div class="invoice-title">
                <h4 class="text-center" style="font-weight: bold;font-size: 15px;margin: 3px !important;">
                    <b style="display: block;">{{ GeneralSettingsInfo()->app_name }}</b>
                    رقم الفاتورة: {{ $saleBill[0]->id }}
                </h4>
            </div>
            <br>
            
            <div class="row">
                <div class="col-xs-5 text-right">       
                    <ul style="font-size: 12px;">             
                        <li>اسم البائع: <b>{{ auth()->user()->name  }}</b></li>
                        <li>رقم فني التركيب: <b>0123456789</b></li>
                        <li>تاريخ الطباعة: <b style="font-size: 9px;">{{ date('Y-m-d h:i:s a') }}</b></li>  
                    </ul>
                </div>
            
                <div class="col-xs-2 text-center">
                    <img src="{{ url('back/images/settings/'.GeneralSettingsInfo()->logo) }}" alt="" style="width: 120px;height: 100px;margin-top: -12px;margin-bottom: 10px;">
                </div>
            
                <div class="col-xs-5 text-right">
                    <ul style="font-size: 12px;">
                        <li>عنوان: <b>{{ GeneralSettingsInfo()->address }}</b></li>
                        <li>رقم المعرض: <b>{{ GeneralSettingsInfo()->phone1 }}</b></li>
                        <li>تاريخ الفاتورة: <b style="font-size: 9px;">{{ \Carbon\Carbon::parse($saleBill[0]->created_at)->format('Y-m-d h:i:s a') }}</b></li>                        
                    </ul>
                </div>
            </div>
        </div>


        {{-- start table client info --}}
        <table class="table table-striped table-bordered">
            <thead class="bg bg-black-5">
                <tr>
                    <th class="text-center">الإسم</th>
                    {{--<th class="text-center">المحافظة</th>--}}
                    <th class="text-center">العنوان</th>
                    <th class="text-center">الهاتف</th>
                    <th class="text-center">عدد الأصناف</th>
                    {{--<th class="text-center">طريقة الدفع</th>--}}
                    {{--<th class="text-center">ملاحظات</th>--}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" style="font-weight: bold;">{{ $saleBill[0]->clientName }}</td>
                    {{--<td class="text-center" style="font-weight: bold;">{{ $find[0]->city }}</td>--}}
                    <td class="text-center">{{ $saleBill[0]->clientAddress }}</td>
                    <td class="text-center">{{ $saleBill[0]->clientPhone }}</td>                
                    <td class="text-center">{{ display_number( $saleBill[0]->count_items ) }}</td>
                    {{--<td class="text-center">{{ $find[0]->payment_method }}</td>--}}
                    {{--<td class="text-center">{{ $find[0]->notes }}</td>--}}
                </tr>
            </tbody>
        </table>
        {{-- end table client info --}}


        {{-- start table bill products  --}}
        <table class="table table-bordered table-striped text-center" style="font-size: 12px;">
            <thead class="bg bg-black-5">
                <tr>
                    <th class="text-center" style="width: 35% !important;">اسم المنتج</th>
                    <th class="text-center">وحدة المنتج</th>
                    <th class="text-center">الكمية</th>
                    <th class="text-center">السعر قبل</th>
                    <th class="text-center">السعر بعد</th>
                    <th class="text-center">الإجمالي</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleBill as $product)
                    <tr>
                        <td class="text-center">{{ $product->productName }}</td>
                        <td class="text-center">{{ $product->unitName }}</td>
                        <td>{{ display_number( $product->product_bill_quantity ) }}</td>
                        <td>
                            @if ($product->sell_price_small_unit == $product->current_sell_price_in_sale_bill)
                                {{ display_number( $product->sell_price_small_unit ) }}
                            @else
                                {{ display_number( $product->current_sell_price_in_sale_bill ) }}
                            @endif
                        </td>
                        <td></td>
                        <td>{{ display_number( $product->productTotalAfter ) }}</td>
                    </tr>
                @endforeach
        </table>
        {{-- end table bill products  --}}


        <table class="table table-bordered table-striped text-center" style="font-size: 12px;">
            <thead class="bg bg-black-5">
                <tr>
                    <th class="text-center">إجمالي الفاتورة قبل</th>                    
                    @if ($saleBill[0]->extra_money)
                        <th class="text-center">مصاريف اضافية</th>
                    @endif
                    <th class="text-center">إجمالي الفاتورة بعد</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ display_number( $saleBill[0]->total_bill_before ) }} جنية</td>
                    @if ($saleBill[0]->extra_money)
                        <td>{{ display_number( $saleBill[0]->extra_money ) }} جنية</td>
                    @endif

                    <td style="font-weight: bold;">{{ display_number( $saleBill[0]->total_bill_after ) }} جنية</td>
                </tr>
            </tbody>
        </table>

        {{-- سياسة وشروط الشركة --}}
            <ol>
                <p style="font-weight: bold;margin-bottom: 5px;">سياسة وشروط الشركة</p>
                <li>الاستبدال والاسترجاع خلال 14 يوم من تاريخ استلام المنتج</li>
                <li>لا يجوز استبدال او استرجاع المنتج إذا لم يكن المنتج في نفس حالة وقت البيع</li>
                <li>لا يجوز استبدال او استرجاع المنتج الذي تم تصنيعه خصيصًا للعميل</li>
                <li>ضمان 3 سنوات على جميع منتجاتنا</li>
                <li>الضمان شامل الكهرباء واللون فقط</li>
                <li>صيانة المنتج من خلال مقرنا فقط</li>
                <li>استرجاع او استبدال المنتج من خلال مقرنا فقط وذلك للتأكد من صحة المنتج</li>
            </ol>
            <hr>
        {{-- سياسة وشروط الشركة --}}
        

        <div class="text-center" style="font-weight: bold;font-size: 11px;padding-bottom: 20px;">
            <p style="padding: 0 0 3px !important;margin: 0 !important;">للتحويل انستاباي / 01002101763</p>
            <p style="margin: 0 !important;">للتحويل فودافون كاش علي الأرقام التالية / 01014490673 / 01027453730</p>
        </div>
        
        <!-- Company Info -->
        <div class="company_info">
            <span>كيوبكس تك للبرمجيات</span>
            <span>01117903055 - 01012775704</span>
        </div>
    </div>

    <script> window.print(); </script>
</body>
</html>