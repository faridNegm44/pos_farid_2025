
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        #exampleModalCenterShow li{
            padding: 4px 0;
        }

        #exampleModalCenterShow ul .data_removed{
            font-size: 13px;
            color: blue;
        }

        #stores_quantity{
            border: 2px solid #888;
            padding: 5px 0;
            display: none;
        }

        #stores_quantity b{
            display: block;
            color: red;
            font-size: 13px;
        }
    </style>
@endsection

@section('footer') 
    <script>
        $(document).ready(function(){            
            // start check if باختيار نفس المخزن في عملية التحويل
                const transfer_from = $("#transfer_from");
                const transfer_to = $("#transfer_to");
                const value = $("#value");
                
                $(transfer_from).add(transfer_to).on("input", function(){
                    if(transfer_from.val() == transfer_to.val()){
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 7);
                        alertify.warning(`غير مسموح باختيار نفس المخزن في عملية التحويل من وإلى. يُرجى تحديد مخزن مختلف للتحويل`);

                        transfer_from.val('');
                        transfer_to.val('');
                        value.val('');

                        var selectizeInstance = $('#products')[0].selectize;
                        selectizeInstance.clearOptions();
                    }

                    value.val('');
                });
            // end check if باختيار نفس المخزن في عملية التحويل



            // start get products when change transfer_from جلب الاصناف عند اختيار مخزن محول من
            $(transfer_from).on("input", function(){
                const url = `{{ url($pageNameEn) }}/get_products/${transfer_from.val()}`;
                $.ajax({
                    type: "GET",
                    url: url,
                    beforeSend:function () {
                        var selectizeInstance = $('#products')[0].selectize;
                        selectizeInstance.clearOptions();
                    },
                    success: function(res){
                    

                        if(res.length > 0){
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 4);
                            alertify.success(`تم استدعاء أصناف المخزن بنجاح`);
                        }

                        var selectizeInstance = $('#products')[0].selectize;
                        selectizeInstance.clearOptions();
                        
                        $.each(res, function(index, value) {
                            var quantity = display_number_js(value.quantity_small_unit) ?? 0;

                            selectizeInstance.addOption({
                                value: value.id,
                                text: `( ${value.id} ) - المنتج: ( ${value.nameAr} ) - الكمية: ( ${quantity} ${value.unitName} )`,
                                disabled: quantity == 0
                            });
                        });
                    }
                })
            });
            // end get products when change transfer_from جلب الاصناف عند اختيار مخزن محول من



            // start when change مبلغ التحويل
            $(value).on("input", function(){
                
                if( !transfer_from.val() || !transfer_to.val() ){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error(`اختر خزنتي التحويل أولا`);

                    $(this).val('');
                    
                    
                }else if( $(this).val() < 1 ){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error(`يجب أن يكون مبلغ التحويل أكبر من الصفر`);

                    $(this).val('');
                    

                }else{
                    const url = `{{ url($pageNameEn) }}/get_last_money_on_treasury/${transfer_from.val()}/${transfer_to.val()}`;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        beforeSend:function () {

                        },
                        success: function(res){

                            if( (parseFloat(res.transfer_from) < value.val()) ){
                                alertify.set('notifier','position', 'top-center');
                                alertify.set('notifier','delay', 3);
                                alertify.error(`مبلغ التحويل اكبر من المبلغ الموجود بالخزينة`);

                                $(value).val('');
                                
                                
                                return false;

                            }else{
                                
                            }
                        }
                    });
                }
            });
            // end when change مبلغ التحويل


            // start selectize 
            $('.selectize').selectize();
        });
    </script>


    <script>       
        // open modal when click button (insert)
        document.addEventListener('keydown', function(event){
            if( event.which === 45 ){
                $('.modal').modal('show');
                $("#moneyFirstDurationSection").css('display', 'block');
                document.querySelector('.modal .modal-header .modal-title').innerText = 'اضافة';
                document.querySelector('.modal .modal-footer #save').setAttribute('style', 'display: inline;');
                document.querySelector('.modal .modal-footer #update').setAttribute('style', 'display: none;');
                $('.dataInput').val('');
                $('#moneyFirstDuration').val(0);
            }
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
        
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'num_order', name: 'num_order'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'user', name: 'user'},
                    {data: 'notes', name: 'notes'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    { extend: 'excel', text: '📊 Excel', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'} },
                    { extend: 'print', text: '🖨️ طباعة', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'}, customize: function (win) { $(win.document.body).css('direction', 'rtl'); } },
                    { extend: 'colvis', text: '👁️ إظهار/إخفاء الأعمدة', className: 'btn btn-outline-dark' }
                ],
                order: [[ 0, "desc" ]],
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>

    <script>
        // start when change products selecize جلب المخازن المتعلقه بالسلعة/الخدمة عند تغيير السلعة/الخدمة
        $(document).on('input', '#products', function() {
            let thisVal = $(this).val();
            let selectizeInstance = $(this)[0].selectize; // الحصول على instance من selectize
            let selectedItem = selectizeInstance.getItem(thisVal);
            
            if(thisVal){
                const url = `{{ url($pageNameEn) }}/get_product_stores/${thisVal}`;
                $.ajax({
                    type: "GET",
                    url: url,
                    beforeSend:function () {
                        
                    },
                    success: function(res){
                    
    
                        if(res.length > 0){
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 4);
                            alertify.success(`تم استدعاء مخازن السلعة/الخدمة بنجاح`);
                        }
    
                        $.each(res, function(index, value) {
                            $('#stores_quantity').append(`
                                <div class="col-lg-2">
                                    <label for="products">حدايد وبويات</label>
                                    <b>10</b>
                                </div>
                            `);
                        });
                    }
                })
            }  
        });
        // end when change products selecize جلب المخازن المتعلقه بالسلعة/الخدمة عند تغيير السلعة/الخدمة
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.transfer_between_stores.add')
    @include('back.transfer_between_stores.edit')
    @include('back.transfer_between_stores.show_js')
    @include('back.transfer_between_stores.delete')
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

        @include('back.transfer_between_stores.form')
        @include('back.transfer_between_stores.show')


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">تاريخ</th>
                                <th class="border-bottom-0">مستخدم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                                <th class="border-bottom-0">التحكم</th>
                            </tr>
                        </thead>                                
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

