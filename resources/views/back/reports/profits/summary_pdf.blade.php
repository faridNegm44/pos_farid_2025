<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير الربحية - {{ date('d-m-Y H:i:s') }}</title>
    <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background: #fff; }
        .summary-cards { display: flex; justify-content: space-between; margin: 20px 0 30px 0; gap: 10px; flex-wrap: wrap; }
        .card {
            flex: 1 1 18%;
            background: #f7f7f7;
            border-radius: 8px;
            box-shadow: 0 2px 6px #0001;
            padding: 18px 10px 10px 10px;
            text-align: center;
            min-width: 150px;
            margin-bottom: 10px;
        }
        .card .icon { font-size: 28px; margin-bottom: 5px; display: block; }
        .card.sales { border-top: 4px solid #4caf50; }
        .card.purchases { border-top: 4px solid #2196f3; }
        .card.expenses { border-top: 4px solid #ff9800; }
        .card.returns { border-top: 4px solid #9c27b0; }
        .card.net-profit { border-top: 4px solid #e91e63; }
        .card.net-profit.positive { background: #e8f5e9; }
        .card.net-profit.negative { background: #ffebee; }
        .summary-table th, .summary-table td { text-align: center; font-size: 14px; }
        .summary-table { margin-top: 20px; }
        .notes-box { background: #f1f8e9; border: 1px solid #cddc39; border-radius: 6px; padding: 10px 15px; margin: 20px 0; font-size: 15px; }
        @media print { .summary-cards { flex-wrap: wrap; } }
    </style>
</head>
<body style="padding: 5px 10px;">
<div class="container" style="padding: 5px 10px; border: 1px solid #000;">
    @include('back.layouts.header_report')
    <h3 class="text-center" style="margin: 10px 0 0 0; font-weight: bold; letter-spacing: 1px;">تقرير الربحية</h3>
    <hr>
    @if($from || $to)
        <div style="border: 1px solid #2196f3; background: #e3f2fd; border-radius: 6px; padding: 8px 15px; margin-bottom: 15px;">
            <strong>الفترة:</strong>
            @if($from) من: {{ $from }} @endif
            @if($to) إلى: {{ $to }} @endif
        </div>
    @else
        <div style="border: 1px solid #bdbdbd; background: #f5f5f5; border-radius: 6px; padding: 8px 15px; margin-bottom: 15px;">
            <strong>تقرير عام (كل الفترات)</strong>
        </div>
    @endif
    <div class="summary-cards">
        <div class="card sales">
            <span class="icon">💰</span>
            <div>إجمالي المبيعات</div>
            <div style="font-size: 18px; font-weight: bold;">{{ display_number($total_sales) }}</div>
        </div>
        <div class="card purchases">
            <span class="icon">🛒</span>
            <div>إجمالي المشتريات</div>
            <div style="font-size: 18px; font-weight: bold;">{{ display_number($total_purchases ?? 0) }}</div>
        </div>
        <div class="card expenses">
            <span class="icon">💸</span>
            <div>إجمالي المصروفات</div>
            <div style="font-size: 18px; font-weight: bold;">{{ display_number($total_expenses) }}</div>
        </div>
        <div class="card returns">
            <span class="icon">↩️</span>
            <div>إجمالي المرتجعات</div>
            <div style="font-size: 18px; font-weight: bold;">{{ display_number($total_returns) }}</div>
        </div>
        <div class="card net-profit {{ $net_profit >= 0 ? 'positive' : 'negative' }}">
            <span class="icon">📈</span>
            <div>صافي الربح</div>
            <div style="font-size: 20px; font-weight: bold; color: {{ $net_profit >= 0 ? '#388e3c' : '#c62828' }};">
                {{ display_number($net_profit) }}
            </div>
        </div>
    </div>
    <table class="table table-bordered summary-table">
        <thead>
            <tr style="background: #d0d0d0;">
                <th>البند</th>
                <th>القيمة</th>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>إجمالي المبيعات</td>
                <td>{{ display_number($total_sales) }}</td>
                <td>كل الفواتير المباعة خلال الفترة</td>
            </tr>
            <tr>
                <td>إجمالي المشتريات</td>
                <td>{{ display_number($total_purchases ?? 0) }}</td>
                <td>كل فواتير الشراء خلال الفترة</td>
            </tr>
            <tr>
                <td>إجمالي المصروفات</td>
                <td>{{ display_number($total_expenses) }}</td>
                <td>جميع المصروفات المسجلة</td>
            </tr>
            <tr>
                <td>إجمالي المرتجعات</td>
                <td>{{ display_number($total_returns) }}</td>
                <td>مرتجعات المبيعات والمشتريات</td>
            </tr>
            <tr style="background: #f3e5f5; font-weight: bold;">
                <td>صافي الربح</td>
                <td style="color: {{ $net_profit >= 0 ? '#388e3c' : '#c62828' }};">{{ display_number($net_profit) }}</td>
                <td>{{ $net_profit >= 0 ? 'ربح' : 'خسارة' }}</td>
            </tr>
        </tbody>
    </table>
    @if(isset($notes) && $notes)
        <div class="notes-box">
            <strong>ملاحظات:</strong> {{ $notes }}
        </div>
    @endif
    @include('back.layouts.footer_report')
    <script>window.print();</script>
</div>
</body>
</html> 