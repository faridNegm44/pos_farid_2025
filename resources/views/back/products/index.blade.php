
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    {{-- spotlight --}}
    <link href="{{ asset('back/assets/spotlight.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 95%;
            }
        }
        hr{
            border-top: 2px solid #4d5276;
            margin: 32px 0px 24px;
        }
        .ajs-warning{width: 400px !important;min-width: 400px !important;}
    </style>

@endsection

@section('footer')  
    {{--  <!-- spotlight -->  --}}
    <script src="{{ asset('back/assets/spotlight.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/spotlight.min.js') }}"></script>

    <script>
        flatpickr(".datePicker", {
            yearSelectorType: 'dropdown',
            enableTime: false,
            dateFormat: "Y-m-d",
        });
    </script>

    <script>       
        // open modal when click button (insert)
        document.addEventListener('keydown', function(event){
            if( event.which === 45 ){
                $('.modal').modal('show');
                document.querySelector('.modal .modal-header .modal-title').innerText = 'إضافة';
                document.querySelector('.modal .modal-footer #save').setAttribute('style', 'display: inline;');
                document.querySelector('.modal .modal-footer #update').setAttribute('style', 'display: none;');
                $('.dataInput').val('');
            }
        });


        // focus first input when open modal
        $('.modal').on('shown.bs.modal', function(){
            $('.dataInput:eq(0)').focus();                
        });

        // remove all errors when close modal
        $('.modal').on('hidden.bs.modal', function(){
            $('form [id^=errors]').text('');
            $('#firstPeriodCountSection :input').prop('readonly', false);
            $('#small_unit_numbers_section :input').prop('readonly', false);
        });
        


        // cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();  
            }
        });
        
        $(document).ready(function () {
            // selectize
            $('.selectize').selectize({
                hideSelected: true
            });

            // DataTable
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'action', name: 'action', orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'last_cost_price_small_unit', name: 'last_cost_price_small_unit'},
                    {data: 'sell_price_small_unit', name: 'sell_price_small_unit'},
                    {data: 'prod_discount', name: 'prod_discount'},
                    //{data: 'prod_tax', name: 'prod_tax'},
                    {data: 'units', name: 'units'},
                    {data: 'store_name', name: 'store_name'},
                    {data: 'category', name: 'category'},
                    {data: 'quantity_small_unit', name: 'quantity_small_unit'},
                    {data: 'status', name: 'status'},
                    {data: 'image', name: 'image'},
                ],
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    { extend: 'excel', text: '📊 Excel', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'} },
                    { extend: 'print', text: '🖨️ طباعة', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'}, customize: function (win) { $(win.document.body).css('direction', 'rtl'); } },
                    { extend: 'colvis', text: '👁️ إظهار/إخفاء الأعمدة', className: 'btn btn-outline-dark' }
                ],
                order: [[ 0, 'desc' ]],
                "bDestroy": true,
                language: {
                    sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'
                },
                lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "الكل"]]
            });
        });



        // start when change main_category => get sub categories 
        $("#category").on('change', function(){
            const thisVal = $(this).val();

            $.ajax({
                url: `{{ url($pageNameEn) }}/get_sub_categories/${thisVal}`,
                type: 'GET',
                beforeSend:function(){
                    $(`form #sub_category option`).remove();
                },
                success: function(res){  
                    
                    if(res){
                        $(`form #sub_category`).append(`<option value="" selected>اختر قسم فرعي</option>`);
                        $.each(res, function (index , value) {
                            $(`form #sub_category`).append(`
                                <option value="${value.id}">${value.name_sub_category}</option>
                            `);
                        });    

                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 3);
                        alertify.success("تم استدعاء الأقسام الفرعية بنجاح");
                    }
                }
            });
        });
        // end when change main_category => get sub categories 

    </script>

    {{-- add, edit, delete => script --}}
    @include('back.products.add')
    @include('back.products.edit')
    @include('back.products.delete')
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
                    <button type="button" class="btn btn-danger btn-icon ml-2 add" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter"><i class="mdi mdi-plus"></i></button>
                </div>


                {{--@if ($products == 0)--}}

                    <div class="pr-1 mb-xl-0">
                        <button type="button" class="btn btn-primary btn-icon attach" data-toggle="modal" data-target="#excelModal" data-toggle="tooltip" title="إرفاق ملف Excel">
                            <i class="mdi mdi-file-excel"></i>
                        </button>
                    </div>

                    {{-- start modal attach file excel --}}
                    <div class="modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="excelModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">تنزيل وإرفاق ملف Excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="{{ url('excel.attach') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body pd-30 pd-sm-40 bg-gray-100">
                                        <div class="mb-3 text-center">
                                            <p>اضغط على الزر أدناه لتنزيل نموذج Excel.</p>
                                            <a href="{{ url('path/to/template.xlsx') }}" class="btn btn-success" download>
                                                <i class="mdi mdi-download"></i> تنزيل نموذج Excel
                                            </a>
                                        </div>

                                        <div class="form-group">
                                            <label for="excel_file">أرفق الملف بعد تعبئة النموذج:</label>
                                            <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xlsx,.xls" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">إرفاق الملف</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    {{-- end modal attach file excel --}}
                    
                {{--@endif--}}
            </div>
        </div>
        <!-- breadcrumb -->

        @include('back.products.form')


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center nowrap" id="example1">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-bottom-0 nowrap_thead">كود</th>
                                <th class="border-bottom-0 nowrap_thead">التحكم</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">اسم السلعة/الخدمة</th>
                                <th class="border-bottom-0 nowrap_thead">سعر التكلفة</th>
                                <th class="border-bottom-0 nowrap_thead">سعر البيع</th>
                                <th class="border-bottom-0 nowrap_thead">خصم</th>
                                {{--<th class="border-bottom-0 nowrap_thead">ضريبة</th>--}}
                                <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">الوحدات</th>
                                <th class="border-bottom-0 nowrap_thead" >المخزن</th>
                                <th class="border-bottom-0 nowrap_thead" >القسم</th>
                                <th class="border-bottom-0 nowrap_thead" >كمية السلعة/الخدمة</th>
                                <th class="border-bottom-0 nowrap_thead" >الحالة</th>
                                <th class="border-bottom-0 nowrap_thead" >صورة</th>
                            </tr>
                        </thead>                                
                    </table>    
                </div>                        
            </div>
        </div>
        
    </div>
@endsection

