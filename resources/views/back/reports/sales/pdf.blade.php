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

        @if ($from || $to)
            <div style="margin-bottom: 15px; padding: 10px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px;">
                <strong style="color: #333;">الفترة المختارة:</strong>
                @if ($from)
                    <span style="margin-right: 20px; color: #007bff;">
                        من: {{ \Carbon\Carbon::parse($from)->format('Y-m-d h:i:s a') }}
                    </span>
                @endif
                @if ($to)
                    <span style="color: #28a745;">
                        إلى: {{ \Carbon\Carbon::parse($to)->format('Y-m-d h:i:s a') }}
                    </span>
                @endif
            </div>
        @else
            <div style="margin-bottom: 15px; padding: 10px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px;">
                <strong style="color: #333;">الفترة المختارة:</strong>
                <span style="color: #dc3545;">لم يتم تحديد فترة زمنية</span>
            </div>
        @endif


        {{-- كروت الإحصائيات --}}
        <div class="row text-center" style="margin-bottom: 20px;">            
            <div class="col-xs-6">
                <div style="border-radius: 8px; border: 1px solid #d6c1ff; padding: 12px; background: #f2e5ff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="font-size: 13px; color: #663399;">إجمالي المبيعات</div>
                    <div style="font-size: 20px; font-weight: bold; color: #4b0082;">{{ display_number( $saleBills->sum('total_bill_after') ) }}</div>
                </div>
            </div>

            <div class="col-xs-6">
                <div style="border-radius: 8px; border: 1px solid #a1d99b; padding: 12px; background: #dff0d8; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="font-size: 13px; color: #3c763d;">عدد الفواتير</div>
                    <div style="font-size: 20px; font-weight: bold; color: #2b542c;">{{ count($saleBills) }}</div>
                </div>
            </div>
        </div>


        {{-- جدول الفواتير --}}
        @if ($print_products == true)
            <div class="panel panel-default">
                <div class="panel-heading" style="font-weight: bold; font-size: 16px;">تفاصيل الفواتير</div>
                @if(count($saleBills) > 0)
                    <div class="panel-body">
                        <table class="table table-bordered table-striped" style="font-size: 14px;">
                            <thead style="background-color: #f1f1f1;">
                                <tr>
                                    <th style="padding: 5px;">رقم الفاتورة</th>
                                    <th style="padding: 5px;">ع أصناف الفتورة</th>
                                    <th style="padding: 5px;">التاريخ</th>
                                    <th style="padding: 5px;">اسم العميل</th>
                                    <th style="padding: 5px;">مستخدم</th>
                                    <th style="padding: 5px;">الإجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($saleBills as $bill)
                                    <tr style="height: 25px;">
                                        <td style="padding: 5px 0 2px;">{{$bill->id}}</td>
                                        <td style="padding: 5px 0 2px;">{{ number_format($bill->count_items) }}</td>
                                        <td style="padding: 5px 0 2px;">{{ \Carbon\Carbon::parse($bill->created_at)->format('d-m-Y h:i:s a') }}</td>
                                        <td style="padding: 5px 0 2px;">{{$bill->clientName}}</td>
                                        <td style="padding: 5px 0 2px;">{{$bill->userName}}</td>
                                        <td style="padding: 5px 0 2px;">{{ display_number($bill->total_bill_after) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="panel-body" style="text-align:center; font-size:16px; color:#c0180c; padding:20px;font-weight: bold;">
                        لا توجد فواتير بيعت في الفترة المحددة <span style="font-size:22px;">😕📄</span>
                    </div>
                @endif
            </div>
        @endif


        @include('back.layouts.footer_report')
        {{--<script> window.print(); </script>--}}
    </div>
</body>
</html>
