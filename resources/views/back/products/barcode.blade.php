<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nameAr }}</title>
    <style>
        body {
            font-family: sans-serif !important;
        }

        #barcode{
            margin: 0px auto 2px !important;
        }
    </style>
</head>
<body>
<div class="main">
    <div style="position: relative;top: 5px;">
        <span style="font-size: 7pt;position: relative;bottom: 8px;font-weight: bold;direction: ltr">
            ( {{ display_number( $product->sell_price_small_unit ) }}  ) - {{ $product->nameAr }}
        </span>
    </div>

    <div class="text-center" id="barcode">
        {!! DNS1D::getBarcodeHTML((string) $product->natCode, "C128", 1, 40) !!}
    </div>

    <div style="position: relative;top: 3px;">
            <span style="font-size: 7pt;position: relative;bottom: 8px;font-weight: bold;">
                {{ GeneralSettingsInfo()->app_name }} -
            </span>

        <span style="font-size: 7pt;position: relative;bottom: 8px;font-weight: bold;">
            {{ GeneralSettingsInfo()->phone1 }}
        </span>
    </div>
</div>


{{-- <div>
    {!! DNS1D::getBarcodeHTML($code, 'C39', 1, 40) !!}


    <span class="price" style="font-size: 5pt;">{{$product->sell_price}}</span>
     -
    <span class="price" style="font-size: 5pt;">{{$product->name_ar}}</span>

    {!! DNS1D::getBarcodeHTML(strval( $product->id ), "EAN13", 1, 15) !!}

    <span class="price" style="font-size: 5pt;position: relative;bottom: 9px;">{{ $settings['name'] }}</span>

</div> --}}

<script src="{{ asset('back/assets/libs/jquery/jquery.min.js') }}"></script>
<script>
    //$(document).ready(function () {
    //    $("div.main div:nth-child(2)").css('margin', '200px auto !important');
    //    $("#barcode div").css('margin', '2px auto 0');
    //});

    // window.print();
</script>

</body>
</html>
