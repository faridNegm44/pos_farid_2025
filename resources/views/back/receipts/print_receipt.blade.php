<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<title>{{ $pageNameAr }} {{ $receiptBill[0]->id }} - {{ $receiptBill[0]->clientSupplierName }} - {{ $receiptBill[0]->created_at }}</title>--}}

    <link rel="icon" href="{{ url('back') }}/images/settings/fiv.png" type="image/x-icon"/>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
          font-family: 'Arial', sans-serif;
          margin: 30px;
          direction: rtl;
        }
        .receipt-container {
          border: 2px solid black;
          padding: 20px;
          width: 700px;
          margin: auto;
          position: relative;
          background-image: url("{{ asset('back/images/settings/'.GeneralSettingsInfo()->logo) }}");
          background-repeat: no-repeat;
          background-position: center;
          background-size: 300px;
          opacity: 1;
        }
    
        .receipt-container::before {
          content: "";
          position: absolute;
          top: 0; right: 0; bottom: 0; left: 0;
          background: rgba(255, 255, 255, 0.9);
          z-index: 0;
        }
    
        .receipt-content {
          position: relative;
          z-index: 1;
        }
    
        .header {
          text-align: center;
          margin-bottom: 20px;
        }
    
        .header h2, .header h3 {
          margin: 5px 0;
        }
    
        .row {
          margin: 10px 0;
        }
    
        .bold {
          font-weight: bold;
        }
    
        .signature {
          margin-top: 50px;
          text-align: left;
        }
    
        .line {
          border-bottom: 1px dashed #000;
          display: inline-block;
          width: 200px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact; /* Chrome, Safari */
                print-color-adjust: exact;         /* Firefox */
            }

            .receipt-container {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background-image: url("{{ asset('back/images/settings/' . GeneralSettingsInfo()->logo) }}") !important;
                background-repeat: no-repeat !important;
                background-position: center !important;
                background-size: 300px !important;
            }
        }

    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-content">
            <div class="header">
            <h2>{{ GeneralSettingsInfo()->app_name }}</h2>
            <h3>إيصال استلام نقدية / شيكات</h3>
            </div>
    
            <div class="row"><span class="bold">إيصال رقم:</span> {{ $receiptBill->id }}</div>
            <div class="row"><span class="bold">تحريرًا في:</span> {{ Carbon\Carbon::parse($receiptBill->created_at)->format('Y / m / d') }}</div>
    
            <div class="row"><span class="bold">استلمنا من السادة:</span> {{ $receiptBill->clientSupplierName }}</div>
            <div class="row"><span class="bold">مبلغ وقدره فقط:</span> 
                <span style="font-size: 16px;border: 1px solid;padding: 2px 13px;border-radius: 2px">{{ display_number($receiptBill->amount) }}</span>
            </div>
            <div class="row">
            <span class="bold">نقدًا / شيك رقم:</span> ........................................ 
            <span class="bold">بتاريخ:</span> .... / .... / ........ 
            <span class="bold">مسحوب على بنك:</span> ........................................
            </div>
    
            <div class="row"><span class="bold">وذلك قيمة:</span> .............................................................................................................................................
            </div>
    
            {{--<div class="row"><span class="bold">المبلغ بالأرقام:</span> ........................................ قرش / جنيه</div>--}}
    
            <div class="signature">
            <span class="bold">أمين الخزينة:</span> <span class="line"></span>
            </div>
        </div>
        </div>

    {{--<script> window.print(); </script>--}}
</body>
</html>