
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
            font-weight: bold;
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
        
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'supplierName', name: 'supplierName'},
                    {data: 'treasuryName', name: 'treasuryName'},
                    {data: 'count_items', name: 'count_items'},
                    {data: 'date', name: 'date'},
                    {data: 'notes', name: 'notes'},
                    {data: 'userName', name: 'userName'},
                    {data: 'financialName', name: 'financialName'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "bDestroy": true,
                order: [[0, 'desc']],
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.purchases_return.show')
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
                    <a href="{{ url('purchases_return/create') }}" type="button" class="btn btn-danger btn-icon ml-2 add"><i class="mdi mdi-plus"></i></a>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        @include('back.purchases_return.show_form')

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0" >مورد</th>
                                <th class="border-bottom-0" >خزينة</th>
                                <th class="border-bottom-0" >ع الأصناف</th>
                                <th class="border-bottom-0" >تاريخ</th>
                                <th class="border-bottom-0" >ملاحظات</th>
                                <th class="border-bottom-0" >مستخدم</th>
                                <th class="border-bottom-0" >السنة</th>
                                <th class="border-bottom-0">التحكم</th>
                            </tr>
                        </thead>                                
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

