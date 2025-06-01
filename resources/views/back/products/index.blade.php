
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
                    {data: 'sell_price_small_unit', name: 'sell_price_small_unit'},
                    {data: 'last_cost_price_small_unit', name: 'last_cost_price_small_unit'},
                    {data: 'units', name: 'units'},
                    {data: 'store_name', name: 'store_name'},
                    {data: 'category', name: 'category'},
                    {data: 'quantity_small_unit', name: 'quantity_small_unit'},
                    {data: 'image', name: 'image'},
                    {data: 'status', name: 'status'},
                ],
                order: [[ 0, 'desc' ]],
                fixedColumns: {
                    leftColumns: 2
                },
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
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
            <div class="card-body table-responsive">                        
                <table class="table table-bordered table-striped table-hover text-center nowrap" id="example1">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">كود</th>
                            <th class="border-bottom-0">التحكم</th>
                            <th class="border-bottom-0" style="width: 30%;">اسم الصنف</th>
                            <th class="border-bottom-0">سعر البيع</th>
                            <th class="border-bottom-0">سعر الشراء</th>
                            <th class="border-bottom-0">الوحدات</th>
                            <th class="border-bottom-0" >المخزن</th>
                            <th class="border-bottom-0" >القسم</th>
                            <th class="border-bottom-0" >كمية الصنف</th>
                            <th class="border-bottom-0" >صورة</th>
                            <th class="border-bottom-0" >الحالة</th>
                        </tr>
                    </thead>                                
                </table>
            </div>
        </div>
        
    </div>
@endsection

