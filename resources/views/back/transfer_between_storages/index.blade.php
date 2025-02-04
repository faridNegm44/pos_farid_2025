
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
    </style>
@endsection

@section('footer') 
    <script>
        $(document).ready(function(){
            const transaction_from = $("#transaction_from");
            const transaction_to = $("#transaction_to");
            const value = $("#value");

            // start check if اختار نفس الخزينه ف الخزينه المحوله والخزينه المستقبله
            $(transaction_from).add(transaction_to).on("input", function(){
                if(transaction_from.val() == transaction_to.val()){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 7);
                    alertify.warning(`غير مسموح باختيار نفس الخزينة في عملية التحويل من وإلى. يُرجى تحديد خزينة مختلفة للتحويل`);

                    transaction_from.val('');
                    transaction_to.val('');
                    value.val('');
                }

                value.val('');
                $("#transaction_from_money_total").text(0);
                $("#transaction_to_money_total").text(0);

            });
            // end check if اختار نفس الخزينه ف الخزينه المحوله والخزينه المستقبله



            // start when change مبلغ التحويل
            $(value).on("input", function(){
                
                if( !transaction_from.val() || !transaction_to.val() ){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error(`اختر خزنتي التحويل أولا`);

                    $(this).val('');
                    $("#transaction_from_money_total").text(0);
                    $("#transaction_to_money_total").text(0);
                    
                }else if( $(this).val() < 1 ){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error(`يجب أن يكون مبلغ التحويل أكبر من الصفر`);

                    $(this).val('');
                    $("#transaction_from_money_total").text(0);
                    $("#transaction_to_money_total").text(0);

                }else{
                    const url = `{{ url($pageNameEn) }}/get_last_money_on_treasury/${transaction_from.val()}/${transaction_to.val()}`;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        beforeSend:function () {

                        },
                        success: function(res){

                            if( (parseFloat(res.transaction_from) < value.val()) ){
                                alertify.set('notifier','position', 'top-center');
                                alertify.set('notifier','delay', 3);
                                alertify.error(`مبلغ التحويل اكبر من المبلغ الموجود بالخزينة`);

                                $(value).val('');
                                $("#transaction_from_money_total").text(0);
                                $("#transaction_to_money_total").text(0);
                                
                                return false;

                            }else{
                                $("#transaction_from_money_total").text(
                                    ( parseFloat(res.transaction_from) - parseFloat(value.val()) ).toLocaleString() 
                                );
                                $("#transaction_to_money_total").text(
                                    ( parseFloat(res.transaction_to) + parseFloat(value.val()) ).toLocaleString() 
                                );
                            }
                        }
                    });
                }
            });
            // end when change مبلغ التحويل


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
                order: [[ 0, "desc" ]],
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
        
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.transfer_between_storages.add')
    @include('back.transfer_between_storages.edit')
    @include('back.transfer_between_storages.show_js')
    @include('back.transfer_between_storages.delete')
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

        @include('back.transfer_between_storages.form')
        @include('back.transfer_between_storages.show')


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                        <thead>
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

