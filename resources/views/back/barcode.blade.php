<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تصميم فاتورة صيدلية</title>
    <link rel="stylesheet" href="style.css">
    {{-- bootstrap --}}
    {{-- <link href="{{ asset('back/assets/css/bootstrap-rtl.min.css') }}" id="bootstrap-style" type="text/css" rel="stylesheet"/> --}}

    <style>
      /* @media print{
        @page{
          size: 2in 1.5in;
        }
      } */
        
      #barcode{
        /* border: 1px solid; */
        width: 3.7cm;
        height: 1.2cm;
        /* padding: 3px; */
        font-size: 8px;
        font-family: sans-serif !important;
        font-weight: bold;
        text-align: center;
        position: relative;
      }

      .price{
        position: absolute;
        right: 5px;
      }
      .product{
        position: absolute;
        left: 5px;
      }
    </style>

</head>
<body>

  <div id="barcode">
    <div>
      <span class="app_name">{{ $settings['name'] }} - {{ $settings['phone1'] }}</span>
    </div>

    <div class="barcode">
      {!! DNS1D::getBarcodeHTML(strval( $product->id ), "EAN13", 1, 17) !!}
    </div>

    <div>
      <span class="price" style="font-size: 4pt;position: absolute;top: 10px;transform: rotate(90deg);">{{$product->sell_price}}</span>
      <span class="product" style="font-size: 5pt;width: 100%;overflow: hidden;height: 10px;">( {{ $product->short_code }} ) {{ $product->name_ar }}</span>
    </div>
  </div>


  <script src="{{ asset('back/assets/libs/jquery/jquery.min.js') }}"></script>

  <script>
    // $(document).ready(function () {
    //   $('.barcode').children('div').first().css('margin', '2px auto 0');
    // });

    window.print();
  </script>

</body>
</html>
