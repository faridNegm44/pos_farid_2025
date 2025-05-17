<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageNameAr }} - {{ date('d-m-Y') }} - {{ date('h:i a') }}</title>

    <link rel="icon" href="{{ url('back') }}/images/settings/fiv.png" type="image/x-icon"/>

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
            font-weight: bold;
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
<body>
    <div class="container">
        <div class="">
            <div class="invoice-title">
                <h4 class="text-center" style="font-weight: bold;">
                    {{ $pageNameAr }}
                </h4>
            </div>
            <hr>

            @include('back.layouts.header_report')
        </div>

        <div>
            <table class="table-bordered" style="width: 100%;text-align: center;">
                <thead>
                    <tr class="gray">
                        <th class="border-bottom-0">كود الصنف</th>
                        <th class="border-bottom-0">اسم الصنف</th>
                        <th class="border-bottom-0">حد الطلب</th>
                        <th class="border-bottom-0">كمية الصنف حاليا</th>
                        <th class="border-bottom-0">المخزن</th>
                        <th class="border-bottom-0" >القسم</th>
                    </tr>
                </thead>                               
                
                <tbody>
                    @foreach ($supp_results as $result)    

                        <tr>
                            <td>{{ $result->productId }}</td>
                            <td>{{ $result->nameAr }}</td>
                            <td>{{ $result->stockAlert }}</td>                                    
                            <td>{{ $result->quantity_all }}</td>
                            <td>{{ $result->storeName }}</td>
                            <td>{{ $result->categoryName }}</td>
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
