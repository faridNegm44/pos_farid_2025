
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
        #showProductsModal .table-bordered td, .table-bordered th{
            font-size: 12px !important;
        }
    </style>
@endsection

@section('footer')  
    {{-- start when click to button #example1 tr .show --}}
    <script>
        $(document).on('click', '.print', function(e) {
            const res_id = $(this).attr("res_id");
            let printUrl = `{{ url('sales/report/print_receipt') }}/${res_id}`;

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
        
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'action', name: 'action', orderable: false},
                    {data: 'date', name: 'date'},
                    {data: 'clientName', name: 'clientName'},
                    {data: 'clientPhone', name: 'clientPhone'},
                    {data: 'treasuryName', name: 'treasuryName'},
                    {data: 'total_bill', name: 'total_bill'},
                    {data: 'count_items', name: 'count_items'},
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
                order: [[0, 'desc']],
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "الكل"]]
            });
        });
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.sales.show')
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
                    <a href="{{ url('sales/create') }}" type="button" class="btn btn-danger btn-icon ml-2 add"><i class="mdi mdi-plus"></i></a>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        @include('back.sales.show_form')

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 nowrap_thead">#</th>
                                <th class="border-bottom-0 nowrap_thead">التحكم</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">تاريخ</th>
                                <th class="border-bottom-0 nowrap_thead" >عميل</th>
                                <th class="border-bottom-0 nowrap_thead" >تليفون</th>
                                <th class="border-bottom-0 nowrap_thead" >خزينة</th>
                                <th class="border-bottom-0 nowrap_thead" >اجمالي الفاتورة</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 60px !important;min-width: 60px !important;">ع العناصر</th>
                                <th class="border-bottom-0 nowrap_thead" >ملاحظات</th>
                                <th class="border-bottom-0 nowrap_thead" >مستخدم</th>
                                <th class="border-bottom-0 nowrap_thead" >السنة</th>
                            </tr>
                        </thead>                                
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

