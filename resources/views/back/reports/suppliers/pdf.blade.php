<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

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

        @if ($supplier_id || $treasury_type || $from || $to)
            <div style="margin-bottom: 15px; padding: 10px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px;">
                @if ($supplier_id)
                    <span class="itemsSearch">عميل: {{ $results[0]->supplierName }}</span>
                @endif
                @if ($treasury_type)
                    <span class="itemsSearch">نوع الحركة: {{ $results[0]->treasury_type }}</span>
                @endif
                @if ($from)
                    <span class="itemsSearch">تاريخ من: {{ Carbon\Carbon::parse($from)->format('d-m-Y h:i:s a') }}</span>
                @endif
                @if ($to)
                    <span class="itemsSearch">تاريخ الي: {{ Carbon\Carbon::parse($to)->format('d-m-Y h:i:s a') }}</span>
                @endif
            </div>
        @endif

        <div>
            <table class="table-bordered" style="width: 100%;text-align: center;">
                <thead class="thead-light">
                    <tr>
                        {{--<th class="border-bottom-0">رقم الحركة</th>--}}
                        <th>تاريخ الحركة</th>
                        <th >تاريخ اخر</th>
                        <th>خزينة الحركة</th>
                        <th>نوع الحركة</th>
                        <th>الجهة</th>
                        <th>قيمة الحركة</th>
                        <th>علية / لية</th>
                        <th>مبلغ الخزينة بعد</th>
                        <th >مستخدم</th>
                        <th>ملاحظات</th>
                    </tr>
                </thead>                               
                
                <tbody>
                    @foreach ($results as $result)    
                        <tr>
                            {{--<td>{{ $result->id }}</td>--}}
                            <td style="padding:2px 4px;">
                                <span>{{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}</span>
                                <small style="color:#888;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i a') }}</small>
                            </td>
                            <td style="padding:2px 4px;">
                                @if(Carbon\Carbon::parse($result->created_at)->format('d-m-Y') != Carbon\Carbon::parse($result->date)->format('d-m-Y'))
                                    <span>{{ Carbon\Carbon::parse($result->date)->format('d-m-Y') }}</span>
                                @else
                                    <span style="color:#bbb;">-</span>
                                @endif
                            </td>
                            <td style="padding:2px 4px;">{{ $result->treasury_name }}</td>
                            <td style="padding:2px 4px;font-weight: bold;">
                                {{ $result->treasury_type }}
                            </td>                            
                            <td style="padding:2px 4px;">{{ $result->supplierName }}</td>
                            <td style="padding:2px 4px;">
                                <span style="font-weight:bold; color:#007bff;">
                                    {{ display_number($result->amount_money) }}
                                </span>
                            </td>


                            
                            
                            <td style="padding:2px 4px;font-weight:bold;">
                                <span style="color:{{ $result->remaining_money < 0 ? '#d9534f' : '#5cb85c' }};">
                                    {{ display_number($result->remaining_money) }}
                                </span>
                            </td>
                            <td style="padding:2px 4px;">
                                <span style="font-weight:bold;">
                                    {{ display_number($result->treasury_money_after) }}
                                </span>
                            </td>
                            <td style="padding:2px 4px;">{{ $result->userName }}</td>
                            <td style="padding:2px 4px;font-size: 10px;">
                                <span style="white-space: pre-line;">{{ $result->notes }}</span>
                            </td>
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
