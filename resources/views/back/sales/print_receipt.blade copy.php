<!DOCTYPE html>
<html dir="rtl">

<head>
    {{--<title>{{ $pageNameAr }}-{{ $SalesHeader['id'] }}</title>--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-size: 11px;
            font-family: 'DejaVu Sans', 'Roboto', 'Montserrat', 'Open Sans', sans-serif;
            padding: 0px;
            margin: 0px;

        }

        body {
            text-align: right;
        }

        .top_info{
            text-align: center;
        }
        .top_info p{
            margin: 2px;
        }
        .client_info{
            text-align: right;
            border: 1px solid #000;
            padding: 3px;
            margin-bottom: 6px;
        }
        .bill_info div{
            margin-bottom: 3px;
        }

        table tbody tr td{
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>
    <div id="bill">
        <div class="top_info">
            {{ GeneralSettingsInfo()->app_name }}
            {{--<p style="font-weight: bold;text-decoration: underline;font-size: 13px;margin-bottom: 4px;">{{ $settings['name'] }}</p>
            <p>{{ $settings['address'] }}</p>
            <p style="margin-bottom: 4px;">{{ $settings['phone1'] }} - {{ $settings['phone2'] }}</p>--}}
        </div>

        {{--<div class="client_info" style="border: 1px solid #000;text-align: center;">
            <span>العميل: {{ $SalesHeader->ClientRelSalesHeader['name'] }}</span>
            -
            <span>تليفون: {{ $SalesHeader->ClientRelSalesHeader['phone'] == null ? '---' : $SalesHeader->ClientRelSalesHeader['phone'] }}</span>
            <br/>
            <span>العنوان: {{ $SalesHeader->ClientRelSalesHeader['address'] == null ? '---' : $SalesHeader->ClientRelSalesHeader['address'] }}</span>
        </div>--}}

        <div class="bill_info">
            {{--<div style="float: right" style="font-weight: bold;">الأصناف: {{ $SalesContentCount }}</div>
            <div style="float: left" style="font-weight: bold;">رقم الفاتورة: {{ $SalesHeader['id'] }}</div>--}}
        </div>

        <div class="table_info">
            <table style="width: 100%;text-align: center;">
                <thead>
                    <tr>
                        <td style="width: 50%;font-weight: bold;border-bottom: 2px solid #000;">الصنف</td>
                        <td style="width: 20%;font-weight: bold;border-bottom: 2px solid #000;">الوحدة</td>
                        <td style="width: 10%;font-weight: bold;border-bottom: 2px solid #000;">الكمية</td>
                        <td style="width: 20%;font-weight: bold;border-bottom: 2px solid #000;">إجمالي السعر</td>
                    </tr>
                </thead>

                {{--<tbody>
                    @foreach($SalesHeader->SalesHeaderRelSalesContent as $item)
                        <tr>
                            <td>{{ $item->SalesContentRelProduct['name_ar'] }}</td>
                            <td>{{ $item->SalesContentRelProduct->unitRelProducts['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ ($item['quantity'] * $item['sales_price']) }}</td>
                        </tr>
                    @endforeach
                </tbody>--}}

                <tfoot style="height: 28px;font-weight: bold;font-size: 17px;">
                    <tr>
                        <td colspan="2" style="border-bottom: 2px solid #000;">الإجمالي</td>
                        {{--<td colspan="2" style="border-bottom: 2px solid #000;">{{ $TotalBefore }}</td>--}}
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- footer_info --}}
        <div class="footer_info">
            <div style="float: right">
                <p>
                    <span style="font-weight: bold;">المطلوب: </span>
                    {{--<span style="padding: 2px 10px;font-size: 20px;border: 2px solid #000;font-weight: bold;">{{ $TotalBefore }}</span>--}}
                </p>

            </div>

        </div>


        {{-- footer_info2 --}}
        <div class="footer_info2" style="font-size: 8px;margin-top: 60px;text-align: center;font-weight: bold;">
            <p>تاريخ الفاتورة: {{ date('h:ia') }} <span style="margin: 0px 5px;">{{ date('Y-m-d') }}</span></p>
        </div>

        {{-- footer_info3 --}}
        <div class="footer_info3" style="font-size: 7px;border-top: 1px dashed #000;text-align: left;font-weight: bold;line-height: 0px;">
            <p>Powered By: R-Plus For Software - 01012775704 - 01124700305 </p>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
