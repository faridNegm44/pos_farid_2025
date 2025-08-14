
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
        flatpickr(".datePicker", {
            enableTime: false,
            dateFormat: "Y-m-d", 
            time_24hr: false
        });
    </script>

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
                    {data: 'action', name: 'action'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'receipt_date', name: 'receipt_date'},
                    {data: 'clientSupplierName', name: 'clientSupplierName'},
                    {data: 'clientSupplierStatus', name: 'clientSupplierStatus'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},
                    {data: 'userName', name: 'userName'},
                    {data: 'notes', name: 'notes'},
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
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>



    {{-- start when change #payer_type الجهه --}}
    <script>
        $("#payer_type").on('change', function(){
            const thisVal = $(this).val();
            $("#payer_id")[0].selectize.clearOptions();

            $.ajax({
                url: `{{ url($pageNameEn) }}/getCurrentRemainingMoney/${thisVal}`,
                type: 'get',
                processData: false,
                contentType: false,
                beforeSend:function () {
                    $('#current_remaining_money, #amount').val();
                    $("#current_remaining_money, #amount").val('');
                    $("#clientSupplierStatus").text('');
                    $("#payer_id")[0].selectize.clearOptions();
                    $("#hide_section").slideUp();
                },
                success: function(res){
                    $.each(res, function(index, value){
                        $("#payer_id")[0].selectize.addOption({
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
    {{-- end when change #payer_type الجهه --}}


    {{--  start select payer_id anf get current_remaining_money --}}
    <script>
        $(document).ready(function() {
            $('#payer_id').selectize();

            $('#payer_id').change(function() {
                var payer_id = $(this).val();
                var selectizeInstance = $(this)[0].selectize;

                if (payer_id) {
                    var clientSupplierData = selectizeInstance.options[payer_id]; 
                    var current_remaining_money = display_number_js(clientSupplierData.remaining_money); 

                    $("#current_remaining_money").val(current_remaining_money);
                    
                    if(current_remaining_money >= 0){
                        $("#clientSupplierStatus").text(`علية: ${current_remaining_money}`);

                    }else{
                        $("#clientSupplierStatus").text(`لة: ${current_remaining_money}`);
                    }
                        
                    $("#amount").val('');

                    alertify.set('notifier', 'position', 'top-center');
                    alertify.set('notifier', 'delay', 3);
                    alertify.success("✅ تم استدعاء الرصيد الحالي للجهة بنجاح 💰. في انتظار مبلغ المطالبة 🔄");
                }else{
                    $("#current_remaining_money, #amount").val('');
                    $("#clientSupplierStatus").text('');
                }
            });
        });
    </script>
    {{--  end select payer_id anf get current_remaining_money --}}


    {{-- start when click to button #example1 tr .show --}}
    <script>
        $(document).on('click', '.print', function(e) {
            const res_id = $(this).attr("res_id");
            let printUrl = `{{ url('receipts/print_receipt') }}/${res_id}`;

            window.open(printUrl);
        });
    </script>
    {{-- end when click to button #example1 tr .show --}}
    
    {{-- add, edit, delete => script --}}
    @include('back.receipts.add')
    @include('back.receipts.edit')
    @include('back.receipts.delete')
    @include('back.receipts.take_money_js')
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

        @include('back.receipts.takeMoneyModal')
        @include('back.receipts.form')

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-bottom-0 nowrap_thead">#</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 100px !important;min-width: 100px !important;">التحكم</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">تاريخ الإيصال</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 70px !important;min-width: 70px !important;">تاريخ اخر</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 150px !important;min-width: 150px !important;">اسم الجهة</th>
                                        <th class="border-bottom-0 nowrap_thead">نوع الجهة</th>
                                        <th class="border-bottom-0 nowrap_thead">مبلغ الايصال</th>
                                        <th class="border-bottom-0 nowrap_thead">حالة الايصال</th>
                                        <th class="border-bottom-0 nowrap_thead">المستخدم</th>
                                        <th class="border-bottom-0 nowrap_thead">ملاحظات</th>
                                        <th class="border-bottom-0 nowrap_thead">السنة المالية</th>
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

