
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')



@endsection

@section('footer') 
    <script>
        $(document).ready(function(){
            $(document).on('click', '.modal-body .datetimepicker', function() {
                $(this).datetimepicker('show');
            });
        });
    </script>

    <script>       
        // open modal when click button (insert)
        document.addEventListener('keydown', function(event){
            if( event.which === 45 ){
                $('.modal').modal('show');
                $("#moneyFirstDurationSection").css('display', 'block');
                document.querySelector('.modal .modal-header .modal-title').innerText = 'إضافة';
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
                    {data: 'id', name: 'id'},
                    {data: 'treasury', name: 'treasury'},
                    {data: 'title', name: 'title'},
                    {data: 'amount_money', name: 'amount_money'},
                    //{data: 'treasury_money_after', name: 'treasury_money_after'},
                    {data: 'status', name: 'status'},
                    {data: 'notes', name: 'notes'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'user', name: 'user'},
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

    {{-- add, edit, delete => script --}}
    @include('back.expenses.add')
    @include('back.expenses.edit')
    @include('back.expenses.delete')
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

        @include('back.expenses.form')


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 nowrap_thead">#</th>
                                <th class="border-bottom-0 nowrap_thead">الخزينة</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">وصف المصروف</th>
                                <th class="border-bottom-0 nowrap_thead">م المصروف</th>
                                {{--<th class="border-bottom-0 nowrap_thead">مبلغ خزينة بعد المصروف</th>--}}
                                <th class="border-bottom-0 nowrap_thead">الحالة</th>
                                <th class="border-bottom-0 nowrap_thead">ملاحظات</th>
                                <th class="border-bottom-0 nowrap_thead" style="width: 100px !important;min-width: 100px !important;">تاريخ</th>
                                <th class="border-bottom-0 nowrap_thead">مستخدم</th>
                                <th class="border-bottom-0 nowrap_thead">التحكم</th>
                            </tr>
                        </thead>                                
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

