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
<body style=" background-color: #f9f9f9;">
    <div style="padding: 20px 20px 0; background-color: #fff; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="border: 2px solid #dee2e6; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
            <h4 class="text-center" style="font-weight: bold; color: #343a40; margin: 0;">
                🧾 {{ $pageNameAr }}
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
                        <td>جاري الجرد</td>
                        <td>ملاحظه اول جرد</td>
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
                        <th>رقم السلعة/الخدمة</th>
                        <th style="width: 33% !important;">اسم السلعة/الخدمة</th>
                        <th >الوحدة الصغري</th>
                        <th >الكمية المعدودة</th>
                        <th style="width: 33% !important;">ملاحظات</th>
                    </tr>
                </thead>                               
                
                <tbody>
                    @foreach ($results as $index => $result)    
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $result->productId }}</td>
                            <td>{{ $result->productNameAr }}</td>
                            <td>{{ $result->small_unit_name }}</td>
                            <td></td>
                            <td></td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('back.layouts.footer_report')
        {{--<script> window.print(); </script>--}}
    </div>
</body>
</html>
