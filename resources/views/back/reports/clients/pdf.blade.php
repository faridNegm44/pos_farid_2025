<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

    <link rel="icon" href="{{ url('back') }}/images/settings/fiv.png" type="image/x-icon"/>

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
<body style="padding: 5px 10px;">    
    <div style="padding: 5px 10px;border: 1px solid #000;">
        <div class="">
            <div class="invoice-title">
                <h4 class="text-center" style="">
                    {{ $pageNameAr }}
                </h4>
            </div>
            <hr>

            @include('back.layouts.header_report')
        </div>

        @if ($client_id || $treasury_type || $from || $to)
            <hr style="margin: 0 0 10px !important;"> 
            <div style="margin-bottom: 10px;">
                @if ($client_id)
                    <span class="itemsSearch">عميل: {{ $results[0]->clientName }}</span>
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
                <thead>
                    <tr>
                        {{--<th class="border-bottom-0">رقم الحركة</th>--}}
                        <th>تاريخ الحركة</th>
                        <th >تاريخ اخر</th>
                        <th>خزينة الحركة</th>
                        <th>نوع الحركة</th>
                        <th>قيمة الحركة</th>
                        <th>الجهة</th>
                        <th>علي الجهة / لها</th>
                        <th>مبلغ الخزينة بعد</th>
                        <th >مستخدم</th>
                        <th>ملاحظات</th>
                    </tr>
                </thead>                               
                
                <tbody>
                    @foreach ($results as $result)    
                        <tr>
                            {{--<td>{{ $result->id }}</td>--}}
                            <td>
                                {{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}
                                <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i:s a') }}</span>
                            </td>
                            <td>
                                @if(Carbon\Carbon::parse($result->created_at)->format('d-m-Y') != Carbon\Carbon::parse($result->date)->format('d-m-Y'))
                                    <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->date)->format('d-m-Y') }}</span>
                                @endif                                        
                            </td>
                            <td>{{ $result->treasury_name }}</td>
                            <td>{{ $result->treasury_type }}</td>
                            <td>{{ display_number($result->amount_money) }}</td>
                            <td>{{ $result->clientName }}</td>
                            <td>{{ display_number($result->remaining_money) }}</td>
                            <td>{{ display_number($result->treasury_money_after) }}</td>
                            <td>{{ $result->userName }}</td>
                            <td>{{ $result->notes }}</td>
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
