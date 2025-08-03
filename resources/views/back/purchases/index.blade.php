
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        #showProductsModal ul li:nth-child(even) {
            background-color: #f8f9fa;
        }
        #showProductsModal ul li:nth-child(odd) {
            background-color: #ffffff;
        }
        #showProductsModal .invoice-info li > span:first-child {
            color: #888;
            font-size: 10px;
            display: inline-block;
            min-width: 110px;
        }

        #showProductsModal .invoice-info li > span:last-child {
            font-size: 13px;
            
        }

        #showProductsModal .invoice-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #showProductsModal .invoice-info li {
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('footer')  
    {{-- start when click to button #example1 tr .show --}}
    <script>
        $(document).on('click', '.print', function(e) {
            const res_id = $(this).attr("res_id");
            let printUrl = `{{ url('purchases/report/result/pdf') }}/${res_id}`;

            window.open(printUrl);
        });
    </script>
    {{-- end when click to button #example1 tr .show --}}

    <script>       
        
        // cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();  
            }
        });
        

        // flatpickr
        flatpickr(".datePicker", {
            enableTime: true,
            dateFormat: "Y-m-d h:i:S K", 
            time_24hr: false
        });


        // start DataTable
        $(document).ready(function () {

            let table = $('#example1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: `{{ url($pageNameEn.'/datatable') }}`,
                        type: 'GET',
                        data: function (d) {
                            d.from = $("#from").val();
                            d.to = $("#to").val();
                            d.financial_year = $("#financial_year").val();
                        }
                    },
                    dataType: 'json',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'action', name: 'action', orderable: false},
                        {data: 'date', name: 'date'},
                        {data: 'supplierName', name: 'supplierName'},
                        {data: 'treasuryName', name: 'treasuryName'},
                        {data: 'total_bill', name: 'total_bill'},
                        {data: 'count_items', name: 'count_items'},
                        {data: 'bill_discount', name: 'bill_discount'},
                        {data: 'notes', name: 'notes'},
                        {data: 'userName', name: 'userName'},
                        {data: 'financialName', name: 'financialName'},
                    ],
                    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [
                        { extend: 'excel', text: '📊 Excel', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'} },
                        { extend: 'print', text: '🖨️ طباعة', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'}, customize: function (win) { $(win.document.body).css('direction', 'rtl'); } },
                        { extend: 'colvis', text: '👁️ إظهار/إخفاء الأعمدة', className: 'btn btn-outline-dark' }
                    ],
                    "bDestroy": true,
                    "order": [[ 0, "desc" ]],
                    language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                    lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "الكل"]]
                });

            $('#search').on('click', function (e) {
                e.preventDefault();
                $("#overlay_page").show();
                table.ajax.reload();
            });

            table.on('xhr.dt', function () {
                $('#overlay_page').hide();
            });
        });
        // end DataTable

    </script>

    {{-- add, edit, delete => script --}}
    @include('back.purchases.show')
    @include('back.purchases.delete_bill')
@endsection






@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ $pageNameAr }}</h4>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-xl-0">
                    <a href="{{ url('purchases/create') }}" type="button" class="btn btn-danger btn-icon ml-2 add"><i class="mdi mdi-plus"></i></a>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <div class="card bg" style="padding: 20px 0 !important;background-image: linear-gradient(to left, #dfe2e6, #4e9eb5) !important;" style="padding: 20px 0 !important;">
            <div class="card-body">

                <div class="row justify-content-center">
                    <div class="col-md-2" style="margin-bottom: 5px !important;">
                        <div>
                            <select name="financial_year" class="form-control" id="financial_year">
                                <option value="" selected class="text-muted">اختر سنة مالية</option>                              
                                @foreach (getAllFinancialYear() as $year)
                                  <option value="{{ $year->id }}">( {{ $year->id }} ) - {{ $year->name }}</option>                              
                                @endforeach
                            </select>
                        </div>
                        <bold class="text-danger" id="errors-treasury" style="display: none;"></bold>
                    </div> 
                                    
                    <div class="col-md-2" style="margin-bottom: 5px !important;">
                        <div> <input type="text" class="form-control datePicker" placeholder="من" id="from" name="from"> </div>
                        <bold class="text-danger" id="errors-from" style="display: none;"></bold>
                    </div>    
                    
                    <div class="col-md-2" style="margin-bottom: 5px !important;">
                        <div> <input type="text" class="form-control datePicker" placeholder="الي" id="to" name="to"> </div>
                        <bold class="text-danger" id="errors-to" style="display: none;"></bold>
                    </div>    

                    <div class="col-md-1">
                        <div> <button id="search" class="btn btn-warning-gradient btn-block" style="height: 36px;font-size: 12px;font-weight: bold;">بحث</button> </div>
                        <bold class="text-danger" id="errors-to" style="display: none;"></bold>
                    </div>    
                    
                </div>
            </div>
        </div>


        @include('back.purchases.show_form')

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                        <thead class="bg bg-black-5">
                            <tr>
                                <th class="border-bottom-0 nowrap_thead">#</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 200px !important;min-width: 200px !important;">التحكم</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 90px !important;min-width: 90px !important;">تاريخ</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 100px !important;min-width: 100px !important;">مورد</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">خزينة</th>
                                <th class="border-bottom-0 nowrap_thead" >اجمالي الفاتورة</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 60px !important;min-width: 60px !important;">ع العناصر</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">خصم فاتورة</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 100px !important;min-width: 100px !important;">ملاحظات</th>
                                <th class="border-bottom-0" >مستخدم</th>
                                <th class="border-bottom-0" >السنة</th>
                            </tr>
                        </thead>                                
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

