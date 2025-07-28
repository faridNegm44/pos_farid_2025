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

        /*@media print {
            td.gray {
                background-color: gray !important;
                -webkit-print-color-adjust: exact;
            }
        }*/
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

        @if ($treasury_id || $treasury_type || $from || $to)
            <hr style="margin: 0 0 10px !important;"> 
            <div style="margin-bottom: 10px;">
                <div>
                    @if ($treasury_id)
                        <span class="itemsSearch">خزينة الحركة: {{ $results[0]->treasury_name }}</span>
                    @endif
                    @if ($treasury_type)
                        <span class="itemsSearch">نوع الحركة: {{ $results[0]->treasury_type }}</span>
                    @endif
                    @if ($from)
                        <span class="itemsSearch">تاريخ من: <span>{{ $from }}</span></span>
                    @endif
                    @if ($to)
                        <span class="itemsSearch">تاريخ الي: <span>{{ $to }}</span></span>
                    @endif
                </div>
            </div>
        @endif

        <div>
            <table class="table-bordered" style="width: 100%;text-align: center;">
                <thead class="bg bg-black-5">
                    <tr class="gray">
                        <th>رقم الحركة</th>
                        <th >تاريخ الحركة</th>
                        <th >تاريخ اخر</th>
                        <th>خزينة الحركة</th>
                        <th>نوع الحركة</th>
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
                            <td>{{ $result->id }}</td>
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
                            <td>
                                @if ($result->treasury_type === 'مصروف')
                                    {{ $result->treasury_type }}
                                    <p>- {{ $result->expensesTitle }}</p>
                                @else
                                    {{ $result->treasury_type }}
                                @endif
                            </td>
                            <td>{{ display_number($result->amount_money) }}</td>
                            <td>
                                @if ($result->treasury_type === 'رصيد اول خزنة' || $result->treasury_type === 'مصروف' || $result->treasury_type === 'تحويل بين خزنتين')
                                    لاتوجد جهة
                                @else
                                    {{ display_number($result->remaining_money) }}
                                @endif
                            </td>
                            <td>{{ display_number($result->treasury_money_after) }}</td>
                            <td>{{ $result->user_name }}</td>
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
