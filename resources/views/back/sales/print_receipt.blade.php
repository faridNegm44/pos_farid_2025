<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<title>{{ $nameAr }} - {{ $find[0]->first_name }} {{ $find[0]->last_name }} - {{ \Carbon\Carbon::parse($find[0]->orderCreatedAt)->format('d-m-Y h:i a') }}</title>--}}
    <title>
        {{ $pageNameAr }} 
        {{ $saleBill[0]->id }} 
        {{ $saleBill[0]->status == 'فاتورة ملغاة' ? ' - ' .$saleBill[0]->status : '' }} - 
        {{ $saleBill[0]->clientName }} - 
        {{ $saleBill[0]->created_at }}
    </title>

    <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>
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
        th, td {
            padding: 0 !important;
        }

        #total_tr{
            font-size: 18px;
            background: #00000030 !important;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            /*@page {
                margin: 5px;
            }*/
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
            #total_tr {
                background-color: #999 !important;
                color: white !important;
                font-weight: bold;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
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
                    @php
                        $bill_status_raw = $saleBill[0]->status;
                        $bill_status = $bill_status_raw;
                        $status_color = '';
                        $status_style = '';
                        
                        if($bill_status_raw == 'فاتورة ملغاة') {
                            $status_color = 'danger';
                            $status_style = 'background: linear-gradient(90deg,#ffbcbc 0%,#ffeded 100%); color:#b30000; font-weight:bold; padding:2px 8px; border-radius:6px;';
                        } elseif($bill_status_raw == 'فاتورة نشطة') {
                            $status_color = 'success';
                            $status_style = 'background: linear-gradient(90deg,#c6f7d4 0%,#eafff2 100%); color:#008c3c; font-weight:bold; padding:2px 8px; border-radius:6px;';
                        } elseif($bill_status_raw == 'فاتورة معلقة') {
                            $status_color = 'warning';
                            $status_style = 'background: linear-gradient(90deg,#fff3cd 0%,#fffbe6 100%); color:#b8860b; font-weight:bold; padding:2px 8px; border-radius:6px;';
                        } else {
                            $status_color = 'info';
                            $status_style = 'background: linear-gradient(90deg,#d1ecf1 0%,#f8f9fa 100%); color:#0c5460; font-weight:bold; padding:2px 8px; border-radius:6px;';
                        }
                        $bill_status = '<span class="text-' . $status_color . '" style="' . $status_style . '">' . $bill_status_raw . '</span>';
                    @endphp
                    رقم الفاتورة: {{ $saleBill[0]->id }} {!! $bill_status_raw == 'فاتورة ملغاة' ? ' - '. $bill_status : '' !!}
                </h4>
            </div>
            <br>
            
            <div class="row">
                <div class="col-xs-5 text-right">       
                    <ul style="font-size: 12px;">             
                        <li>اسم البائع: <b>{{ auth()->user()->name  }}</b></li>
                        <li>رقم فني التركيب: <b>01002101763</b></li>
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
        <thead style="background: linear-gradient(90deg,#f8f9fa 0%,#e9ecef 100%);">
            <tr>
                <th class="text-center" style="font-size:15px;color:#333;border-right:2px solid #bbb;">الإسم</th>
                <th class="text-center" style="font-size:15px;color:#333;border-right:2px solid #bbb;">العنوان</th>
                <th class="text-center" style="font-size:15px;color:#333;border-right:2px solid #bbb;">الهاتف</th>
                <th class="text-center" style="font-size:15px;color:#333;">عدد الأصناف</th>
            </tr>
        </thead>
        <tbody>
            <tr style="background-color:#f7f7f7;">
                <td class="text-center" style="font-weight: bold;font-size:14px;">{{ $saleBill[0]->clientName }}</td>
                <td class="text-center" style="font-size:13px;">{{ $saleBill[0]->clientAddress }}</td>
                <td class="text-center" style="font-size:13px;">{{ $saleBill[0]->clientPhone }}</td>
                <td class="text-center" style="font-size:13px;">{{ display_number( $saleBill[0]->count_items ) }}</td>
            </tr>
        </tbody>
        </table>
        {{-- end table client info --}}


        {{-- start table bill products  --}}
        <table class="table table-bordered table-striped text-center" style="font-size: 12px;">
            <thead class="thead-light">
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
                        <td>
                            @php
                                $price = $product->current_sell_price_in_sale_bill;
                                $discountPercent = $product->discount;
                                $taxPercent = $product->tax;

                                $discountValue = $price * ($discountPercent / 100);
                                $priceAfterDiscount = $price - $discountValue;

                                $taxValue = $priceAfterDiscount * ($taxPercent / 100);
                                $finalPrice = $priceAfterDiscount + $taxValue;
                            @endphp

                            {{ $finalPrice }}
                        </td>
                        <td>{{ display_number( $product->productTotalAfter ) }}</td>
                    </tr>
                @endforeach
        </table>
        {{-- end table bill products  --}}

        <table class="table table-bordered w-50 m-auto">
            <tbody>
                <tr>
                    <th class="text-right" style="padding-right: 10px !important;">إجمالي الأصناف قبل</th>
                    <td class="text-right" style="padding-right: 10px !important;">
                        @php
                            $total_bill_before = display_number( $saleBill[0]->total_bill_before ); 
                            $extra_money = $saleBill[0]->extra_money ? display_number( $saleBill[0]->extra_money ) : 0; 
                        @endphp

                        {{ $total_bill_before }} جنيه
                    </td>
                </tr>
                @if ($saleBill[0]->total_bill_before != $saleBill[0]->total_bill_after)
                    <tr>
                        <th class="text-right" style="padding-right: 10px !important;">قيمة خصم الأصناف</th>
                        <td class="text-right" style="padding-right: 10px !important;"> - 

                            {{ display_number( ($saleBill[0]->total_bill_before) - ( $saleBill[0]->total_bill_after) - ($saleBill[0]->bill_discount) ) }} جنية
                        </td>
                    </tr>
                    @if ($saleBill[0]->bill_discount)
                        <tr>
                            <th class="text-right" style="padding-right: 10px !important;">خصم إضافي علي الفاتورة</th>
                            <td class="text-right" style="padding-right: 10px !important;"> - 

                                {{ display_number( $saleBill[0]->bill_discount ) }} جنية
                            </td>
                        </tr>
                    @endif
                @endif
                @if ($saleBill[0]->extra_money)
                    @php
                        $checkExtraMoney = $saleBill[0]->extraExpensesName ? ' ( ' .$saleBill[0]->extraExpensesName . ' )' : '';
                    @endphp
                    @if ($saleBill[0]->extra_money > 0)
                        <tr>
                            <th class="text-right" style="padding-right: 10px !important;">مصاريف أخري {{ $checkExtraMoney }}</th>
                            <td class="text-right" style="padding-right: 10px !important;">{{ display_number( $saleBill[0]->extra_money ) }} جنيه</td>
                        </tr>
                    @endif
                @endif
                <tr id="total_tr">
                    <th class="text-right" style="padding-right: 10px !important;">إجمالي الفاتورة بعد</th>
                    <td class="text-right" style="padding-right: 10px !important;font-weight: bold;">
                        {{ display_number( $saleBill[0]->total_bill_after + $saleBill[0]->extra_money ) }} جنيه
                    </td>
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
            <p style="margin: 0 !important;">للتحويل فودافون كاش علي الأرقام التالية / 01014490673</p>
        </div>
        
        <!-- Company Info -->
        <div class="company_info" style="margin-top: 15px;text-align: left;font-size: 7px;padding: 4px 0 0 !important;">
            <span>كيوبكس تك للبرمجيات</span>
            <span>01117903055 - 01012775704</span>
        </div>
    </div>


    <script>
        let $saleBill = @json($saleBill[0]->status);
        if($saleBill == 'فاتورة ملغاة') {
            alert('⚠️ لا يمكن تنفيذ عملية الطباعة، حيث أن هذه الفاتورة تم إلغاؤها سابقًا.');
            window.close();
        }
    </script>

    <script> window.print(); </script>
</body>
</html>