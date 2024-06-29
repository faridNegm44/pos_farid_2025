@extends('back.layouts.app')

@section('title')
    {{-- {{ $pageNameAr }} --}}
@endsection

@section('header')
    <style>
        #productTable tbody td{padding: 5px;}
    </style>
@endsection

@section('content')
    <div class="main-content">        
        <div class="page-content">
            <div class="container-fluid">
              {{-- style="width: 7.8cm;" --}}
                <div class="card" style="border: 1px solid;padding: 10px;width: 7.8cm;"> 
                    <div class="card-body">

                        <div class="invoice-title text-center">
                          <img src="{{ asset('back/images/settings/67.l_logo2.png') }}" alt="صيدلية هبة البكري" class="logo" height="50" />

                          <p>صيدلية هبة البكري</p>
                          <p>رقم الهاتف: 2840900554</p>
                          <p>المقطم شارع كريم بنونه</p>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <address>
                                    <strong>Billed To:</strong><br>
                                    John Smith<br>
                                    1234 Main<br>
                                    Apt. 4B<br>
                                    Springfield, ST 54321
                                </address>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <address class="mt-2 mt-sm-0">
                                    <strong>Shipped To:</strong><br>
                                    Kenny Rigdon<br>
                                    1234 Main<br>
                                    Apt. 4B<br>
                                    Springfield, ST 54321
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    Visa ending **** 4242<br>
                                    jsmith@email.com
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-end">
                                تاريخ الفاتورة: <br />
                                {{-- <strong>{{ \Carbon\Carbon::parse($billHeader->created_at)->format('d-m-Y h:i:s a') }}</strong>    --}}
                                <br><br>                                 
                            </div>
                        </div>

                        <div class="">
                            <table class="table table-responsive table-striped table-bordered text-center" id="productTable" style="font-weight: bold;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>أصناف ف</th>
                                        <th>الكمية</th>
                                        <th>سعر ق</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($count = 0; $count < 3; $count++)
                                        <tr>
                                            <td>{{$count+1 }}</td>
                                            <td>سيتال شراب</td>
                                            <td>10</td>
                                            <td>$499.00</td>
                                        </tr>
                                    @endfor
                                                                        
                                        {{-- <tr>
                                            <td>01</td>
                                            <td>بنادول اقراص</td>
                                            <td>10</td>
                                            <td>0</td>
                                            <td>9.5</td>
                                            <td>0</td>
                                            <td>2.5</td>
                                            <td>-</td>
                                            <td>$499.00</td>
                                        </tr>
                                                                            
                                        <tr>
                                            <td>01</td>
                                            <td>سيتال شراب</td>
                                            <td>10</td>
                                            <td>0</td>
                                            <td>9.5</td>
                                            <td>0</td>
                                            <td>2.5</td>
                                            <td>-</td>
                                            <td>$499.00</td>
                                        </tr> --}}
                                                                            
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none">
                            <div class="float-end">
                                <a id="printButton" class="btn btn-success waves-effect waves-light me-1 w-md"><i class="fa fa-print"></i></a>
                                {{-- <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1 w-md"><i class="fa fa-print"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Include Footer --}}
        @include('back.layouts.footer')
    </div>
@endsection



@section('footer')
    {{-- <script>
        $(document).ready(function () {
            $('#printButton').on('click', function () {
                window.print($(".card"));
            });
        });
    </script> --}}
@endsection
