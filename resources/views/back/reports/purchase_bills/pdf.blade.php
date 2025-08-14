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

        @if ($treasury || $from || $to)
           <div style="margin-bottom: 15px; padding: 10px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px;">
                @if ($treasury)
                    <span class="itemsSearch">الخزينة: {{ $results[0]->treasury_name }}</span>
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
                        <th>تاريخ المصروف</th>
                        <th >الخزينة</th>
                        <th>وصف المصروف</th>
                        <th>مبلغ المصروف</th>
                        <th >مستخدم</th>
                        <th>ملاحظات</th>
                    </tr>
                </thead>                               
                
                <tbody>
                    @foreach ($results as $result)    
                        <tr>                                    
                            <td>
                                {{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}
                                <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i:s a') }}</span>
                            </td>
                            <td>{{ $result->treasury_name }}</td>
                            <td>{{ $result->title }}</td>
                            <td>{{ $result->amount_money }}</td>                                    
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
