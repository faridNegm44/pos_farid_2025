<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تصميم فاتورة صيدلية</title>
    <link rel="stylesheet" href="style.css">
    {{-- bootstrap --}}
    <link href="{{ asset('back/assets/css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    {{-- <style>
        /* @font-face {
            font-family: "4_F4";
            src: url("{{ asset('back/fonts/4_F4.ttf') }}");
        }
        p,div,span,a,h1,h2,h3,h4,h5,h6,label,tr,td,th,strong,button,input,textarea,caption{
            font-family: "4_F4";
        } */

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        header {
            background-color: #000000;
            color: #ffffff;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
        }

        p {
            font-size: 16px;
        }

        main {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000000;
            padding: 10px;
        }

        .items th {
            background-color: #000000;
            color: #ffffff;
        }

        .total {
            margin-top: 20px;
        }

        .payment {
            margin-top: 20px;
        }

        footer {
            background-color: #000000;
            color: #ffffff;
            padding: 20px;
        }
    </style> --}}

</head>
<body>
  <div id="bill" style="width: 7.8cm">
    <header>
      <div class="row">
        <div class="col-xs-6">
          <img src="{{ asset('back/images/settings/67.l_logo2.png') }}" alt="صيدلية هبة البكري" class="logo" style="width: 100px;height: 100px;">
        </div>
        
        <div class="col-xs-6">
          <h1>صيدلية هبة البكري</h1>
          <p>رقم الهاتف: 28409005-</p>
          <p>01111442203</p>
        </div>
      </div>
    </header>
  
    <main>
      <div class="container">
        <h2>فاتورة رقم: 297939</h2>
        <table class="items">
          <thead>
            <tr>
              <th>الإجمالي</th>
              <th>الكمية</th>
              <th>الوحدة</th>
              <th>الإسم</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>63.50</td>
              <td>1</td>
              <td>حقنة</td>
              <td>INSULIN MIXTARD 100UNIT</td>
            </tr>
            <tr>
              <td>35.75</td>
              <td>1</td>
              <td>علبة</td>
              <td>BRIMONIDINE E.D</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td>99.25</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tfoot>
        </table>
        <div class="total">
          <p>الصافي: 99.25</p>
          <p>المطلوب: 99.25</p>
        </div>
        <div class="payment">
          <p>طريقة الدفع: كاش</p>
          <p>المدفوع: 99.25</p>
        </div>
      </div>
    </main>
  
    <footer>
      <p>لا يتم الارتجاع الا من خلال الفاتورة وخلال أسبوعين واصناف الثلاجة لا ترد</p>
      <p>تم البيع بواسطة: Os</p>
      <p>تاريخ الفاتورة: 30/12/2023</p>
    </footer>
  </div>

  {{-- <script src="{{ asset('back/assets/libs/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('back/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

  <script src="{{ asset('back/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
