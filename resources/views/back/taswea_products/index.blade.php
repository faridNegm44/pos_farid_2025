
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')

@endsection

@section('footer')
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


        // selectize
        $('.selectize').selectize({
            hideSelected: true
        });


        // focus first input when open modal
        $('.modal').on('shown.bs.modal', function(){
            $('.dataInput:first').focus();
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


        // when change product_id
        $("#product_id").on('input', function(){
            const thisVal = $(this).val();
            
            $.ajax({
                type: 'GET',
                beforeSend: function (){
                    $('#current_quantity').val('');
                },
                url: `{{ url($pageNameEn) }}/getCurrentProductQuantity/${thisVal}`,
                success: function(res){
                    $('#current_quantity').val(res.quantity_all);

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.success("تمت جلب كمية المنتج الحالية بنجاح");
                }
            });
        });


        // start check if new quantity big than current quantity
        //$("#quantity").on('blur', function(){
        //    const newQuantity = $(this).val();
        //    const currentQuantity = $('#current_quantity').val();

        //    if(newQuantity > currentQuantity){
        //        $(this).val('');

        //        alertify.set('notifier','position', 'top-center');
        //        alertify.set('notifier','delay', 3);
        //        alertify.error("كمية المنتج المسواه اكبر من كمية المخزن");
        //    }
        //});


        // start Datatable
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'productId', name: 'productId'},
                    {data: 'productName', name: 'productName'},
                    {data: 'quantityBefore', name: 'quantityBefore'},
                    {data: 'quantityAfterEdit', name: 'quantityAfterEdit'},
                    {data: 'status', name: 'status'},
                    {data: 'quantityAfter', name: 'quantityAfter'},
                    {data: 'reasonName', name: 'reasonName'},
                    {data: 'tasweaCreatedAt', name: 'tasweaCreatedAt'},
                    {data: 'tasweaNotes', name: 'tasweaNotes'},
                ],
                "bDestroy": true,
                order: [[0, 'desc']],
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.taswea_products.add')
    @include('back.taswea_products.edit')
    @include('back.taswea_products.delete')
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

        @include('back.taswea_products.form')

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0" >إسم الصنف</th>
                                        <th class="border-bottom-0">الكمية قبل</th>
                                        <th class="border-bottom-0">الكمية المسواة</th>
                                        <th class="border-bottom-0">حالة التسوية</th>
                                        <th class="border-bottom-0">الكمية بعد</th>
                                        <th class="border-bottom-0">سبب التسوية</th>
                                        <th class="border-bottom-0">تاريخ التسوية</th>
                                        <th class="border-bottom-0">ملاحظات</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

