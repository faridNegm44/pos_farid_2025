<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Display</title>
    <style>
        body{
            font-family: sans-serif !important;
        }
    </style>
</head>
<body>
    {{-- <div style="width: 7cm; height: 1.2cm;">
        {!! DNS1D::getBarcodeHTML($code, 'C39', 1, 50) !!}
    </div> --}}



    <div class="main" style="width: 4cm; height: 2.5cm; margin-bottom: 0.5cm;text-align: center;">
        <div style="position: relative;top: 5px;">
            
            <span style="font-size: 7pt;position: relative;bottom: 8px;font-weight: bold;">
                {{ $product->name_ar }}
            </span>          

            <div style="font-size: 8pt;position: relative;bottom: 8px;margin-left: 3px;font-weight: bold;">
                سعر: {{ $product->sell_price }} - كود: {{ $product->short_code }}
            </div>
        </div>

        {!! DNS1D::getBarcodeHTML(strval( $product->short_code ), "C128", 1, 40) !!}

        <div style="position: relative;top: 3px;">
            <span style="font-size: 7pt;position: relative;bottom: 8px;font-weight: bold;">
                {{ $settings['name'] }} - 
            </span>
            
            <span style="font-size: 7pt;position: relative;bottom: 8px;font-weight: bold;">
                {{ $settings['phone1'] }} 
            </span>

            <div style="position: relative;bottom: 18px;text-align: left;left: 7px;">
                <span style="font-size: 6pt;font-weight: bold;">
                    (1200)
                </span>
            </div>
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
        $(document).ready(function () {
            $("div.main div:nth-child(2)").css('margin', '2px auto 0');
        });

        // window.print();
    </script>
    
</body>
</html>