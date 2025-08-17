<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }}: {{ $inventory_info->id }} - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

    <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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

        @media print {
            tr:nth-child(even) {
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
            }
            
        }

        /*@media print {
            td.gray {
                background-color: gray !important;
                -webkit-print-color-adjust: exact;
            }
        }*/
    </style>
</head>
<body style=" background-color: #f9f9f9;">
    <div style="padding: 20px 20px 0; background-color: #fff; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="border: 2px solid #dee2e6; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
            <h4 class="text-center" style="font-weight: bold; color: #343a40; margin: 0;">
                🧾 {{ $pageNameAr }}: ( {{ $inventory_info->id }} ) 

                <p style="margin-top: 5px;">بتاريخ: {{ \Carbon\Carbon::parse($inventory_info->created_at)->format('Y-m-d h:i a') }}</p>
            </h4>
        </div>

            @include('back.layouts.header_report')
        </div>

        <div>
            <p class="text-center" style="font-weight: bold;text-decoration: underline;font-size: 15px;">بيانات الجرد</p>
            <table class="table-bordered table-hover" style="width: 100%;text-align: center;margin-bottom: 10px !important;">
                <thead class="thead-light">
                    <tr class="gray">
                        <th >رقم الجرد</th>
                        <th >تاريخ الجرد</th>
                        <th >تاريخ اخر</th>
                        <th >المستخدم</th>
                        <th >السنة المالية</th>
                        <th >الحالة</th>
                        <th >تاريخ الإغلاق</th>
                        <th style="width: 30%;">ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $inventory_info->id }}</td>
                        <td style="font-weight: bold;">{{ \Carbon\Carbon::parse($inventory_info->created_at)->format('d-m-Y h:i a') }}</td>
                        <td>{{ \Carbon\Carbon::parse($inventory_info->date)->format('d-m-Y') }}</td>
                        <td>{{ $inventory_info->userName }}</td>
                        <td>{{ $inventory_info->financialName }}</td>
                        <td>{{ $inventory_info->status }}</td>
                        <td style="font-weight: bold;">{{ \Carbon\Carbon::parse($inventory_info->close_date)->format('d-m-Y h:i a') }}</td>
                        <td>{{ $inventory_info->notes }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div>
            <p class="text-center" style="font-weight: bold;text-decoration: underline;font-size: 15px;">قائمة السلع / الخدمات</p>
            <table class="table-bordered table-hover" style="width: 100%;text-align: center;">
                <thead class="thead-light">
                    <tr class="gray">
                        <th>#</th>
                        <th>كود الصنف</th>
                        <th style="width: 25% !important;">اسم الصنف / الخدمة</th>
                        <th>الوحدة</th>
                        <th>سعر التكلفة</th>
                        <th>الكمية قبل الجرد</th>
                        <th>الكمية بعد الجرد</th>
                        <th>الفارق</th>
                        <th>الحالة</th>
                        <th>تكلفة الفارق</th>
                        <th>من قام بالجرد</th>
                        <th style="width: 20% !important;">ملاحظات</th>
                    </tr>

                </thead>                               
                
                <tbody>
                    @php
                        $totalLoss = 0;
                        $totalWin = 0;
                    @endphp
                    @foreach ($results as $index => $result)    
                        @php $totalCost = ( (int) $result->quantity_small_unit - (int) $result->product_bill_quantity ) * $result->last_cost_price_small_unit; @endphp
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $result->productId }}</td>
                            <td style="font-weight: bold; font-size: 11px;">{{ $result->productNameAr }}</td> 
                            <td>{{ $result->small_unit_name }}</td>
                            <td>{{ display_number( $result->last_cost_price_small_unit ) }}</td> 
                            <td style="font-size: 15px;font-weight: bold;">{{ (int) $result->product_bill_quantity }}</td>
                            <td style="font-size: 15px;font-weight: bold;">{{ (int) $result->quantity_small_unit }}</td>
                            <td style="font-size: 15px;font-weight: bold;">{{ (int) $result->quantity_small_unit - (int) $result->product_bill_quantity }}</td>
                            <td>
                                @if ((int) $result->quantity_small_unit > (int) $result->product_bill_quantity)
                                    زيادة
                                    
                                @elseif((int) $result->quantity_small_unit < (int) $result->product_bill_quantity)
                                    عجز

                                @elseif((int) $result->quantity_small_unit == (int) $result->product_bill_quantity)
                                    متساوي
                                @endif

                            </td>
                            <td>{{ display_number( $totalCost ) }}</td>
                            <td>{{ $result->userName }}</td>
                            <td>{{ $result->notes }}</td>
                        </tr>

                       <p style="display: none;">
                            @if ($totalCost > 0)
                                {{ $totalWin += $totalCost; }}
                                
                            @elseif($totalCost < 0)
                                {{ $totalLoss += $totalCost; }}
                                
                            @endif
                       </p>

                    @endforeach
                </tbody>
            </table>
            
            <div style="display: flex; justify-content: space-between; text-align: center; margin-top:30px;">
                <div style="width: 48%; border:2px solid #4caf50; border-radius:10px; background:#e8f5e9;">
                    <h3 style="color:#2e7d32;">📈 إجمالي الزيادة</h3>
                    <p style="font-size:18px; font-weight:bold; color:#1b5e20;">
                        {{ $totalWin }}
                    </p>
                </div>

                <div style="width: 48%; border:2px solid #f44336; border-radius:10px; background:#ffebee;">
                    <h3 style="color:#c62828;">📉 إجمالي العجز</h3>
                    <p style="font-size:18px; font-weight:bold; color:#b71c1c;">
                        {{ $totalLoss }}
                    </p>
                </div>
            </div>
        </div>

        @include('back.layouts.footer_report')
        {{--<script> window.print(); </script>--}}
    </div>
</body>
</html>
