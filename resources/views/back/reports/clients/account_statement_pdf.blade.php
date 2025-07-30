<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} - {{ $results[0]->clientName }} - {{ date('d-m-Y H-i-s') }}</title>

    <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap" rel="stylesheet">

    <style>
        th, td{
            text-align: center;
            padding: 1px;
            font-size: 12px;

        }

        .itemsSearch{
            margin: 0 10px;
        }
        .itemsSearch span{
            
        }

        .totals_bill_tr, .client_info_tr {
            background-color: #d0d0d0 !important;
        }

        hr {
            margin-top: 10px;
            margin-bottom: 5px;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
      
            /*tr:nth-child(even) {
                background-color: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
            }

            tr:nth-child(odd) {
                background-color: #ffffff !important;
                -webkit-print-color-adjust: exact;
            }

            tr.gray {
                background-color: #d8d8d8 !important;
                -webkit-print-color-adjust: exact;
            }*/

            .totals_bill_tr, .client_info_tr {
                background-color: #d0d0d0 !important;
            }

        }
    </style>
</head>
<body style=" background-color: #f9f9f9;">
    <div style="padding: 20px; background-color: #fff; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="border: 2px solid #dee2e6; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
            <h4 class="text-center" style="font-weight: bold; color: #343a40; margin: 0;">
                🧾 {{ $pageNameAr }}
            </h4>
        </div>

            @include('back.layouts.header_report')

            <table width="100%" border="1" cellpadding="10" cellspacing="0">
                <thead class="bg bg-black-5">
                    <tr class="client_info_tr">
                        <th>اسم العميل</th>
                        <th>رقم التليفون</th>
                        <th>العنوان</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $results[0]->clientName }}</td>
                        <td>{{ $results[0]->clientPhone }}</td>
                        <td>{{ $results[0]->clientAddress }}</td>
                    </tr>
                </tbody>
            </table>

            <br>
        </div>

        @if ($from || $to)
            <div style="border: 1px solid;padding: 5px 10px;">
                <strong style="display: block;">عناصر البحث</strong>
                <div style="margin-bottom: 10px;">
                    @if ($from)
                        <span class="itemsSearch">تاريخ من: {{ Carbon\Carbon::parse($from)->format('d-m-Y h:i:s a') }}</span>
                    @endif
                    @if ($to)
                        <span class="itemsSearch">تاريخ الي: {{ Carbon\Carbon::parse($to)->format('d-m-Y h:i:s a') }}</span>
                    @endif
                </div>
            </div>
        @endif

        <div>
            @foreach ($results as $bill)
                {{----------------------------- start رصيد اول عميل  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}
                @if ($bill->treasury_type === 'رصيد اول عميل')
                    <div class="bill-container" style="padding: 0 10px;">
                    <p style="font-size: 15px;">
                        رقم الحركة: {{ $bill->id }}
                        - ( {{ $bill->treasury_type }} )
                    </p>
                    <span style="margin: 3px 10px;"><strong>تاريخ المعاملة:</strong>
                        {{ Carbon\Carbon::parse($bill->created_at)->format('d-m-Y') }}
                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($bill->created_at)->format('h:i:s a') }}</span>
                    </span>
                    <span style="margin: 3px 10px;"><strong>المبلغ:</strong> {{ display_number($bill->remaining_money) }}</span>
                    <span style="margin: 3px 10px;"><strong>المستخدم:</strong> {{ $bill->userName }}</span>
                    <span style="margin: 3px 10px;"><strong>ملاحظات:</strong> {{ $bill->notes ?? 'لايوجد' }}</span>
                    </div>
                {{----------------------------- end رصيد اول عميل  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}




                {{----------------------------- start اذن توريد نقدية  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}                
                @elseif ($bill->treasury_type == 'اذن توريد نقدية' && $bill->bill_type == 0)
                    <div class="bill-container" style="padding: 10px;">
                    <p style="font-size: 15px;">
                        رقم الحركة: {{ $bill->id }}
                        - ( {{ $bill->treasury_type }} )
                    </p>
                    <span style="margin: 3px 10px;"><strong>تاريخ المعاملة:</strong>
                        {{ Carbon\Carbon::parse($bill->created_at)->format('d-m-Y') }}
                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($bill->created_at)->format('h:i:s a') }}</span>
                    </span>
                    
                    <span style="margin: 3px 10px;"><strong>خزينة المعاملة:</strong> {{ $bill->treasury_name }}</span>

                    <span style="margin: 3px 10px;">
                        <strong>المبلغ المدفوع</strong>: {{ display_number($bill->amount_money) }}
                    </span>
                    <span style="margin: 3px 10px;"><strong>المستخدم:</strong> {{ $bill->userName }}</span>
                    <span style="margin: 3px 10px;"><strong>ملاحظات:</strong> {{ $bill->notes ?? 'لايوجد' }}</span>
                    </div>
                {{----------------------------- end اذن توريد نقدية  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}          

            



                {{----------------------------- start اذن صرف نقدية  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}                
                @elseif ($bill->treasury_type === 'اذن صرف نقدية')
                    <div class="bill-container" style="padding: 10px;">
                    <p style="font-size: 15px;">
                        رقم الحركة: {{ $bill->id }}
                        - ( {{ $bill->treasury_type }} )
                    </p>
                    <span style="margin: 3px 10px;"><strong>تاريخ المعاملة:</strong>
                        {{ Carbon\Carbon::parse($bill->created_at)->format('d-m-Y') }}
                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($bill->created_at)->format('h:i:s a') }}</span>
                    </span>
                    
                    <span style="margin: 3px 10px;"><strong>خزينة المعاملة:</strong> {{ $bill->treasury_name }}</span>

                    <span style="margin: 3px 10px;">
                        <strong>المبلغ المصروف</strong>: {{ display_number($bill->amount_money) }}
                    </span>
                    <span style="margin: 3px 10px;"><strong>المستخدم:</strong> {{ $bill->userName }}</span>
                    <span style="margin: 3px 10px;"><strong>ملاحظات:</strong> {{ $bill->notes ?? 'لايوجد' }}</span>
                    </div>
                {{----------------------------- end اذن صرف نقدية  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}          





                {{----------------------------- start تسوية رصيد للجهة  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}                
                @elseif ($bill->treasury_type === 'تسوية رصيد للجهة')
                    <div class="bill-container" style="padding: 10px;">
                    <p style="font-size: 15px;">
                        رقم الحركة: {{ $bill->id }}
                        - ( {{ $bill->treasury_type }} )
                    </p>
                    <span style="margin: 3px 10px;"><strong>تاريخ المعاملة:</strong>
                        {{ Carbon\Carbon::parse($bill->created_at)->format('d-m-Y') }}
                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($bill->created_at)->format('h:i:s a') }}</span>
                    </span>
                    
                    <span style="margin: 3px 10px;">
                        <strong>الرصيد بعد التسوية</strong>: {{ display_number($bill->remaining_money) }}
                    </span>
                    <span style="margin: 3px 10px;"><strong>المستخدم:</strong> {{ $bill->userName }}</span>
                    <span style="margin: 3px 10px;"><strong>ملاحظات:</strong> {{ $bill->notes ?? 'لايوجد' }}</span>
                    </div>
                {{----------------------------- end تسوية رصيد للجهة  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}          





                {{----------------------------- start اذن مرتجع نقدية لعميل  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}
                @elseif ($bill->treasury_type === 'اذن مرتجع نقدية لعميل')
                    <div class="bill-container" style="padding: 10px; background-color: #f5f7fa; border: 1px solid #b6d4fe; border-radius: 8px; margin-bottom: 10px;">
                    <p style="font-size: 15px; color: #0d6efd;">
                        رقم الحركة: {{ $bill->id }}
                        - ( {{ $bill->treasury_type }} )
                    </p>
                    <span style="margin: 3px 10px;"><strong>تاريخ المعاملة:</strong>
                        {{ Carbon\Carbon::parse($bill->created_at)->format('d-m-Y') }}
                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($bill->created_at)->format('h:i:s a') }}</span>
                    </span>
                    <span style="margin: 3px 10px;"><strong>خزينة المعاملة:</strong> {{ $bill->treasury_name }}</span>
                    <span style="margin: 3px 10px;">
                        <strong>المبلغ المرتجع</strong>: - {{ display_number($bill->amount_money) }}
                    </span>
                    <span style="margin: 3px 10px;"><strong>المستخدم:</strong> {{ $bill->userName }}</span>
                    <span style="margin: 3px 10px;"><strong>ملاحظات:</strong> {{ $bill->notes ?? 'لايوجد' }}</span>
                    </div>
                {{----------------------------- end اذن مرتجع نقدية لعميل  ------------------------------------}}
                {{----------------------------------------------------------------------------------------}}




                {{----------------------------- start $bill->treasury_type === 'اذن توريد نقدية' && $bill->bill_type === 'اضافة فاتورة مبيعات'  ------------------------------------}}
                {{-----------------------------------------------------------------------------------------------}}          
                @elseif ($bill->treasury_type == 'اذن توريد نقدية' && $bill->bill_type == 'اضافة فاتورة مبيعات')
                    <div class="bill-container" style="padding: 10px;">
                        <p style="font-size: 15px;">
                            رقم الحركة: {{ $bill->id }}
                            - ( {{ $bill->treasury_type }} ) - ( {{ $bill->bill_type }} )
                        </p>
                        <span style="margin: 3px 10px;"><strong>تاريخ المعاملة:</strong>
                            {{ Carbon\Carbon::parse($bill->created_at)->format('d-m-Y') }}
                            <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($bill->created_at)->format('h:i:s a') }}</span>
                        </span>
                        <span style="margin: 3px 10px;"><strong>خزينة المعاملة:</strong> {{ $bill->treasury_name }}</span>
                        <span style="margin: 3px 10px;">
                            <strong>المبلغ المدفوع</strong>: {{ display_number($bill->amount_money) }}
                        </span>
                        <span style="margin: 3px 10px;"><strong>مستخدم الإضافة:</strong> {{ $bill->userName }}</span>
                        <span style="margin: 3px 10px;"><strong>السنة المالية:</strong> {{ $bill->financialYearName }}</span>
                        <span style="margin: 3px 10px;"><strong>ملاحظات:</strong> {{ $bill->notes ?? 'لايوجد' }}</span>

                        <table border="1" width="100%" style="border-collapse: collapse;margin-top: 10px;">
                            <thead class="bg bg-black-5">
                            <tr>
                                <th>كود المنتج</th>
                                <th>اسم المنتج</th>
                                <th>الكمية</th>
                                <th>السعر قبل الخصم</th>
                                <th>السعر بعد الخصم</th>
                                <th>الخصم</th>
                                <th>ضريبة القيمة المضافة</th>
                                <th>الإجمالي قبل </th>
                                <th>الإجمالي بعد </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bill->products as $product)
                                <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->nameAr }}</td>
                                <td>{{ display_number($product->product_bill_quantity) }}</td>
                                <td>{{ display_number($product->sell_price_small_unit) }}</td>
                                <td>{{ display_number($product->sell_price_small_unit) }}</td>
                                <td>{{ display_number($product->discount) ?? 0 }}</td>
                                <td>{{ display_number($product->tax) ?? 0 }}</td>
                                <td>{{ display_number($product->total_before) }}</td>
                                <td>{{ display_number($product->total_after) }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr class="totals_bill_tr">
                                <th colspan="8">الإجمالي</th>
                                <th>{{ display_number( $bill->total_bill_after ) }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                {{-------------------------------- end $bill->treasury_type === 'اذن توريد نقدية' && $bill->bill_type === 'اضافة فاتورة مبيعات'  ------------------------------------}}
                {{-----------------------------------------------------------------------------------------------}}  




                {{----------------------------- start $bill->treasury_type === $bill->bill_type =>   ------------------------------------}}
                {{-----------------------------------------------------------------------------------------------}}          
                @elseif ($bill->treasury_type == $bill->bill_type)
                    <div class="bill-container" style="padding: 10px;">
                        <p style="font-size: 15px;">
                            رقم الحركة: {{ $bill->id }}
                            - ( {{ $bill->treasury_type }} )
                        </p>
                        <span style="margin: 3px 10px;"><strong>تاريخ المعاملة:</strong>
                            {{ Carbon\Carbon::parse($bill->created_at)->format('d-m-Y') }}
                            <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($bill->created_at)->format('h:i:s a') }}</span>
                        </span>
                        
                        <span style="margin: 3px 10px;"><strong>مستخدم الإضافة:</strong> {{ $bill->userName }}</span>
                        <span style="margin: 3px 10px;"><strong>السنة المالية:</strong> {{ $bill->financialYearName }}</span>
                        <span style="margin: 3px 10px;"><strong>ملاحظات:</strong> {{ $bill->notes ?? 'لايوجد' }}</span>

                        <table border="1" width="100%" style="border-collapse: collapse;margin-top: 10px;">
                            <thead class="bg bg-black-5">
                            <tr>
                                <th>كود المنتج</th>
                                <th>اسم المنتج</th>
                                <th>الكمية</th>
                                <th>السعر قبل الخصم</th>
                                <th>السعر بعد الخصم</th>
                                <th>الخصم</th>
                                <th>ضريبة القيمة المضافة</th>
                                <th>الإجمالي قبل </th>
                                <th>الإجمالي بعد </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bill->products as $product)
                                <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->nameAr }}</td>
                                <td>{{ display_number($product->product_bill_quantity) }}</td>
                                <td>{{ display_number($product->sell_price_small_unit) }}</td>
                                <td>{{ display_number($product->sell_price_small_unit) }}</td>
                                <td>{{ display_number($product->discount) ?? 0 }}</td>
                                <td>{{ display_number($product->tax) ?? 0 }}</td>
                                <td>{{ display_number($product->total_before) }}</td>
                                <td>{{ display_number($product->total_after) }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr class="totals_bill_tr">
                                <th colspan="8">الإجمالي</th>
                                <th>{{ display_number( $bill->total_bill_after ) }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{----------------------------- end $bill->treasury_type === $bill->bill_type =>   ------------------------------------}}
                    {{-----------------------------------------------------------------------------------------------}}  

            @endif
            
                <p style="margin: 0 auto;text-align: center;border: 1px dotted #000;width: 35%;">
                    <strong>حالة العميل بعد الفاتورة:</strong> 
                    @if ($bill->remaining_money > 0)
                    عليه: {{ display_number( $bill->remaining_money ) }} 

                    @elseif ($bill->remaining_money < 0)
                    لة: {{ display_number( $bill->remaining_money ) }}

                    @else
                    {{ display_number( $bill->remaining_money ) }}
                    @endif
                </p>

                <hr style="border: 1px solid;">
            @endforeach
        </div>

        <div class="text-center" style="margin-top: 30px;">
            <h3 style="padding-top: 15px;">
            @foreach ($results as $bill)
                @if ($loop->last)
                @if($bill->remaining_money === 0)
                    لا توجد أي مستحقات مالية

                @elseif($bill->remaining_money > 0)
                    الرصيد الحالي للعميل (علية):
                    {{ display_number( $bill->remaining_money ) }}

                @else
                    الرصيد الحالي للعميل (لة):
                    {{ display_number( $bill->remaining_money ) }}
                @endif
                @endif
            @endforeach
            </h3>
        </div>

        @include('back.layouts.footer_report')
        <script> window.print(); </script>
    </div>
</body>
</html>
