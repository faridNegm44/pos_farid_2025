<!DOCTYPE html>
<html dir="rtl">

<head>
    <title>Arabic Invoice </title>
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

    <div class="top_info">
        <p style="font-weight: bold;text-decoration: underline;font-size: 13px;margin-bottom: 4px;">{{ $settings['name'] }}</p>
        <p>{{ $settings['address'] }}</p>
        <p style="margin-bottom: 4px;">{{ $settings['phone1'] }} - {{ $settings['phone2'] }}</p>
    </div>  
    
    <div class="client_info" style="border: 1px solid #000;text-align: center;">
        <span>العميل: فريد نجم</span>
        -
        <span>تلفون: 01012775704</span>
        <br/>
        <span>العنوان: maadi nozha 9 st</span>
    </div>  
    
    <div class="bill_info">
        <div style="float: right">الأصناف: 4</div>
        <div style="float: left">رقم الفاتورة: 287897</div>
    </div>  
    
    <div class="table_info">
        <table style="width: 100%;text-align: center;">
            <thead style="background: #a8a8a8;">
                <tr>
                    <td style="width: 50%;">الصنف</td>
                    <td style="width: 20%;">الوحدة</td>
                    <td style="width: 10%;">الكمية</td>
                    <td style="width: 20%;">إجمالي السعر</td>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>بستله جي الي سي ابيض</td>
                    <td>box</td>
                    <td>1</td>
                    <td>20</td>
                </tr>              
            </tbody>

            <tfoot style="background: rgb(42, 42, 42);height: 28px;color: #fff;font-weight: bold;font-size: 17px;">
                <tr>
                    <td colspan="2">الإجمالي</td>
                    <td colspan="2">1200</td>
                </tr>    
            </tfoot>
        </table>
    </div>  

    {{-- footer_info --}}
    <div class="footer_info">
        <div style="float: right">
            <p>
                <span>الصافي: </span>
                <span style="font-weight: bold;">120.00</span>
            </p>
        
            <p>
                <span style="font-weight: bold;">المطلوب: </span>
                <span style="background: rgb(42, 42, 42);color: #fff;padding: 2px 5px;font-size: 17px;">110.00</span>
            </p>
        
        </div>
        
        <div style="float: left">
            <p>
                <span>الخصم: </span>
                <span style="font-weight: bold;">10.00</span>
            </p>        
        </div>
    </div> 
    
    
    {{-- footer_info2 --}}
    <div class="footer_info2" style="font-size: 8px;margin-top: 60px;text-align: center;font-weight: bold;">        
        <p>تاريخ الفاتورة: {{ date('h:ia') }} <span style="margin: 0px 5px;">{{ date('Y-m-d') }}</span></p>
    </div> 

    {{-- footer_info3 --}}
    <div class="footer_info3" style="font-size: 8px;border-top: 1px dashed #000;text-align: left;font-weight: bold;">        
        <p>Powered By: R-Plus For Software - 01012775704 - 0112470305 </p>
    </div> 

    
</body>

</html>