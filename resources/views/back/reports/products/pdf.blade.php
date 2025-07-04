<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع السلع والخدمات' }} ) - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

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
                    {{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع السلع والخدمات' }} )
                </h4>
            </div>
            <hr>

            @include('back.layouts.header_report')
        </div>

        @if ($type || $from || $to)
            <hr style="margin: 0 0 10px !important;"> 
            <div style="margin-bottom: 10px;">
                <div>
                    @if ($type)
                        <span class="itemsSearch">نوع الحركة: <span>{{ $type }}</span></span>
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
                <thead>
                    <tr class="gray">
                        <th>رقم الحركة</th>
                        <th>تاريخ الحركة</th>
                        <th>اسم السلعة/الخدمة</th>
                        <th>نوع الحركة</th>
                        <th>مستخدم</th>
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
                            <td style="">{{ $result->nameAr }}</td>
                            <td>{{ $result->type }}</td>                            
                            <td>{{ $result->userName }}</td>
                            <td>{{ $result->tasweaNotes }}</td>
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
