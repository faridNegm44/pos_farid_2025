
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        .ajs-success, .ajs-error{
            min-width: 500px !important;
        }
    </style>
@endsection

@section('footer')
    <script>
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

        
        // start check if new quantity > 0 and not null
        $(document).on('input', '#quantity', function(){
            const thisVal = $(this);
            if(!thisVal.val() || thisVal.val() < 0 ){
                thisVal.val('');
            }
        })
        // end check if new quantity > 0 and not null




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
                    {data: 'id', name: 'id'},
                    {data: 'client_supplier_id', name: 'client_supplier_id'},
                    {data: 'clientSupplierName', name: 'clientSupplierName'},
                    {data: 'clientSupplierStatus', name: 'clientSupplierStatus'},
                    {data: 'old_money', name: 'old_money'},
                    {data: 'new_money', name: 'new_money'},
                    //{data: 'status', name: 'status'},
                    {data: 'reasonName', name: 'reasonName'},
                    {data: 'tasweaCreatedAt', name: 'tasweaCreatedAt'},
                    {data: 'userName', name: 'userName'},
                    {data: 'tasweaNotes', name: 'tasweaNotes'},
                    {data: 'financialName', name: 'financialName'},
                ],
                "bDestroy": true,
                order: [[0, 'desc']],
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>



    {{-- start when change #client_supplier الجهه --}}
    <script>
        $("#client_supplier").on('change', function(){
            const thisVal = $(this).val();
            $("#client_supplier_id")[0].selectize.clearOptions();

            $.ajax({
                url: `{{ url($pageNameEn) }}/getCurrentRemainingMoney/${thisVal}`,
                type: 'get',
                processData: false,
                contentType: false,
                beforeSend:function () {
                    $('#current_remaining_money, #new_remaining_money').val();
                    $("#current_remaining_money, #new_remaining_money").val('');
                    $("#clientSupplierStatus").text('');
                    $("#client_supplier_id")[0].selectize.clearOptions();
                    $("#hide_section").slideUp();
                },
                success: function(res){
                    $.each(res, function(index, value){
                        $("#client_supplier_id")[0].selectize.addOption({
                            value: value.id,
                            text: `${value.name} ( ${ value.remaining_money ? display_number_js(value.remaining_money) : 0 } )`,
                            remaining_money: value.remaining_money
                        });
                    });

                    $("#hide_section").slideDown();

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.success("✅ تم استدعاء جميع الأشخاص المسندين إلى الجهة بنجاح 👥");
                }
            });
        });
    </script>
    {{-- end when change #client_supplier الجهه --}}


    {{--  start select client_supplier_id anf get current_remaining_money --}}
    <script>
        $(document).ready(function() {
            $('#client_supplier_id').selectize();

            $('#client_supplier_id').change(function() {
                var client_supplier_id = $(this).val();
                var selectizeInstance = $(this)[0].selectize;

                if (client_supplier_id) {
                    var clientSupplierData = selectizeInstance.options[client_supplier_id]; 
                    var current_remaining_money = display_number_js(clientSupplierData.remaining_money); 

                    $("#current_remaining_money").val(current_remaining_money);
                    
                    if(current_remaining_money >= 0){
                        $("#clientSupplierStatus").text(`علية: ${current_remaining_money}`);

                    }else{
                        $("#clientSupplierStatus").text(`لة: ${current_remaining_money}`);
                    }
                        
                    $("#new_remaining_money").val('');

                    alertify.set('notifier', 'position', 'top-center');
                    alertify.set('notifier', 'delay', 3);
                    alertify.success("✅ تم استدعاء الرصيد الحالي للجهة بنجاح 💰. في انتظار تنفيذ التسوية 🔄");
                }else{
                    $("#current_remaining_money, #new_remaining_money").val('');
                    $("#clientSupplierStatus").text('');
                }
            });
        });
    </script>
    {{--  end select client_supplier_id anf get current_remaining_money --}}

    
    
    {{-- add, edit, delete => script --}}
    @include('back.taswea_client_supplier.add')
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

        @include('back.taswea_client_supplier.form')

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">كود</th>
                                        <th class="border-bottom-0" >إسم</th>
                                        <th class="border-bottom-0">حالة الجهة</th>
                                        <th class="border-bottom-0">الرصيد قبل</th>
                                        <th class="border-bottom-0">الرصيد بعد</th>
                                        {{--<th class="border-bottom-0">مبلغ التسوية</th>--}}
                                        <th class="border-bottom-0">سبب التسوية</th>
                                        <th class="border-bottom-0">تاريخ التسوية</th>
                                        <th class="border-bottom-0">مستخدم</th>
                                        <th class="border-bottom-0">ملاحظات</th>
                                        <th class="border-bottom-0">السنة</th>
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

