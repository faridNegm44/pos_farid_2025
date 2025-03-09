<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع الأصناف' }} ) - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

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
<body>
    <div class="container">
        <div class="">
            <div class="invoice-title">
                <h4 class="text-center" style="font-weight: bold;">
                    {{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع الأصناف' }} )
                </h4>
            </div>
            <hr>

            @include('back.layouts.header_report')
        </div>

        <div>
            <table class="table-bordered" style="width: 100%;text-align: center;">
                <thead>
                    <tr class="gray">
                        <th>رقم الحركة</th>
                        <th>تاريخ الحركة</th>
                        <th>اسم الصنف</th>
                        <th>نوع الحركة</th>
                        <th>تفاصيل الحركة</th>
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
                            <td style="font-weight: bold;">{{ $result->nameAr }}</td>
                            <td>{{ $result->type }}</td>
                            <td>
                                @if ($result->type == 'تسوية صنف')
                                    <span style="margin: 0 5px;">الكمية قبل: {{ $result->quantity }}</span> -
                                    <span style="margin: 0 5px;">الكمية بعد: {{ $result->quantity_all }}</span> -

                                    @if ($result->quantity_all > $result->quantity)
                                        <span>زيادة {{ $result->quantity_all - $result->quantity }}</span>            
                                    @else
                                        <span>عجز {{ $result->quantity - $result->quantity_all }}</span>            
                                    @endif
                                @endif
                            </td>
                            <td>{{ $result->userName }}</td>
                            <td>{{ $result->tasweaNotes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('back.layouts.footer_report')
    </div>
</body>
</html>
