<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع السلع والخدمات' }} ) - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

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
    <div style="padding: 20px; background-color: #fff; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="border: 2px solid #dee2e6; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
            <h4 class="text-center" style="font-weight: bold; color: #343a40; margin: 0;">
                🧾 {{ $pageNameAr }}
            </h4>
        </div>

            @include('back.layouts.header_report')
        </div>

        @if ($type || $from || $to)
            <div style="margin-bottom: 15px; padding: 10px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px;">
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

        <div style="margin-top: 20px;">
            <table class="table table-bordered" style="width: 100%; background: #fff; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">
                <thead>
                    <tr>
                    <th style="padding: 0 8px !important; font-size: 13px;">رقم الحركة</th>
                    <th style="padding: 0 8px !important; font-size: 13px;">تاريخ الحركة</th>
                    <th style="padding: 0 8px !important; font-size: 13px;">اسم السلعة/الخدمة</th>
                    <th style="padding: 0 8px !important; font-size: 13px;">نوع الحركة</th>
                    <th style="padding: 0 8px !important; font-size: 13px;">مستخدم</th>
                    <th style="padding: 0 8px !important; font-size: 13px;">ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                    <tr style="background: {{ $loop->even ? '#f8f9fa' : '#fff' }};">
                        <td style="padding: 0 7px !important;">{{ $result->id }}</td>
                        <td style="padding: 0 7px !important;">
                        {{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}
                        <span style="margin: 0 5px; color: #888;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i:s a') }}</span>
                        </td>
                        <td style="padding: 0 7px !important;">{{ $result->nameAr }}</td>
                        <td style="padding: 0 7px !important;">{{ $result->type }}</td>
                        <td style="padding: 0 7px !important;">{{ $result->userName }}</td>
                        <td style="padding: 0 7px !important;">{{ $result->tasweaNotes }}</td>
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
