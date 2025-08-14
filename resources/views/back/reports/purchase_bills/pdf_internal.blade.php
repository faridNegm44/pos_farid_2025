<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} {{ $find[0]->id }} - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

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
    </style>
</head>
<body style=" background-color: #f9f9f9;">
    <div style="padding: 20px; background-color: #fff; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="border: 2px solid #dee2e6; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
            <h4 class="text-center" style="font-weight: bold; color: #343a40; margin: 0;">
                🧾 {{ $pageNameAr }} {{ $find[0]->id }}
            </h4>
        </div>

        @include('back.layouts.header_report')

        <div style="display: flex; flex-wrap: wrap;padding-top: 3px;">
            <ul class="invoice-info" style="flex: 1 1 33.33%; max-width: 33.33%;">
                <li><span>رقم فاتورة:</span> <span class='header_span' id="id"></span>{{ $find[0]->id }}</li>
                <li><span>رقم مخصص:</span> <span class='header_span' id="custom_bill_num"></span>{{ $find[0]->custom_bill_num }}</li>
                <li><span>اذن الخزينة:</span> <span class='header_span' id="treasury_type"></span>{{ $find[0]->treasury_type != $find[0]->bill_type ? $find[0]->treasury_type :  'لم يتم صرف مستحقات' }}</li>
                <li><span>اذن الفاتورة:</span> <span class='header_span' id="bill_type"></span>{{ $find[0]->bill_type }}</li>
                <li><span>عدد أصناف الفاتورة:</span> <span class='header_span' id="count_items"></span>{{ display_number($find[0]->count_items) }}</li>
                <li><span>مستخدم الإضافة:</span> <span class='header_span' id="userName"></span>{{ $find[0]->userName }}</li>
                <li><span>ملاحظات:</span> <span class='header_span' id="notes"></span>{{ $find[0]->notes }}</li>
            </ul>
            
            <ul class="invoice-info" style="flex: 1 1 33.33%; max-width: 33.33%;">
                <li><span>خصم الفاتورة:</span> <span class='header_span' id="bill_discount"></span>{{ display_number($find[0]->bill_discount) ?? 0 }}</li>                      
                <li style=""><span>إجمالي فاتورة قبل:</span> <span class='header_span' id="total_bill_before"></span>{{ display_number($find[0]->total_bill_before) }}</li>
                <li style=""><span>إجمالي فاتورة بعد:</span> <span class='header_span' id="total_bill_after"></span>{{ display_number($find[0]->total_bill_after) }}</li>
                <li><span>تاريخ الإنشاء:</span> <span class='header_span' id="created_at"></span>{{ Carbon\Carbon::parse($find[0]->created_at)->format('Y-m-d h:i:s a') }}</li>
                
            </ul>

            <ul class="invoice-info" style="flex: 1 1 33.33%; max-width: 33.33%;">
                <li><span>المورد:</span> <span class='header_span' id="supplierName"></span>{{ $find[0]->supplierName }}</li>
                <li><span>الخزينة:</span> <span class='header_span' id="treasuryName"></span>{{ $find[0]->treasuryName ?? 'لم يتم صرف مستحقات' }}</li>
                <li><span>مبلغ مدفوع:</span> <span class='header_span' id="amount_money"></span>{{ display_number($find[0]->amount_money) ?? 'لم يتم صرف مستحقات' }}</li>
                <li><span>رصيد المورد بعد:</span> <span class='header_span' id="remaining_money"></span>{{ $find[0]->remaining_money > 0 ? 'علية '. display_number($find[0]->remaining_money) : 'لة '. display_number($find[0]->remaining_money) }}</li>
                <li><span>رصيد الخزينة بعد:</span> <span class='header_span' id="treasury_money_after"></span>{{ display_number($find[0]->treasury_money_after) }}</li>
                <li><span>تاريخ آخر:</span> <span class='header_span' id="custom_date"></span>{{ $find[0]->custom_date }}</li>

            </ul>
        </div>

        <br>
        <div>
            <table class="table-bordered" style="width: 100%;text-align: center;">
                <thead class="thead-light">
                    <tr>
                      <th>رقم المنتج</th>
                      <th>اسم المنتج</th>
                      <th>كمية بالوحدة ك</th>
                      <th>كمية بالوحدة ص</th>
                      @if (userPermissions()->cost_price_view)
                        <th>سعر التكلفة</th>
                      @endif
                      <th>سعر البيع</th>
                      <th>الضريبة</th>
                      <th>الخصم</th>
                      <th>إجمالي السلعة/الخدمة قبل</th>
                      <th>إجمالي السلعة/الخدمة بعد</th>
                    </tr>
                  </thead>                      
                
                <tbody>
                    @foreach ($find as $product)    
                        <tr>                                    
                            <td>{{ $product->product_id }}</td>
                            <td>{{ $product->productNameAr }}</td>
                            <td>
                                {{ display_number( $product->bigUnitName ? $product->product_bill_quantity / $product->small_unit_numbers : $product->product_bill_quantity ) }} 
                                {{ $product->bigUnitName ? $product->bigUnitName : $product->smallUnitName }}
                            </td>
                            <td>{{ display_number( $product->product_bill_quantity ) }} {{ $product->smallUnitName }}</td>
                            @if (userPermissions()->cost_price_view)
                                <td>{{ display_number( $product->last_cost_price_small_unit ) }}</td>
                            @endif
                            <td>{{ display_number( $product->sell_price_small_unit ) }}</td>
                            <td>{{ display_number( $product->tax ) }}</td>
                            <td>{{ display_number( $product->discount ) }}</td>
                            <td>{{ display_number( $product->total_before ) }}</td>
                            <td>{{ display_number( $product->total_after ) }}</td>

                            {{--<td>
                                {{ Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}
                                <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($product->created_at)->format('h:i:s a') }}</span>
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->amount_money }}</td>                                    
                            <td>{{ $product->userName }}</td>
                            <td>{{ $product->notes }}</td>--}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('back.layouts.footer_report')

        <script> window.print(); </script>
    </div>
</body>
</html>
