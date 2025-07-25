
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')



@endsection

@section('footer') 
    <script>
        flatpickr(".datePicker", {
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

        $(document).ready(function(){
            // $('.datetimepicker').datetimepicker({ dropdownParent: $('.modal') });


            // jQuery.datetimepicker.setLocale('en');
            // jQuery('.datetimepicker').datetimepicker({
            //     dropdownParent: $('.modal'),
            //     timepicker:false,
            //     format:'d-m-Y',
            //     // theme:'dark'
            // });



            $(document).on('click', '.modal-body .datetimepicker', function() {
                $(this).datetimepicker('show');
            });

        });

    </script>

    <script>       
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
                    {data: 'action', name: 'action', orderable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'date', name: 'date'},
                    {data: 'status', name: 'status'},
                    {data: 'supervisor_1Name', name: 'supervisor_1'},
                    {data: 'supervisor_2Name', name: 'supervisor_2'},
                    {data: 'supervisor_3Name', name: 'supervisor_3'},
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
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.inventories.add')
    @include('back.inventories.edit')
    @include('back.inventories.delete')
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

        @include('back.inventories.form')


        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead class="bg bg-black-5">
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">التحكم</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">تاريخ الجرد الفعلي</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">تاريخ اخر للجرد</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 70px !important;min-width: 70px !important;">حالة الجرد</th>
                                        <th class="border-bottom-0">مشرف أول</th>
                                        <th class="border-bottom-0">مشرف تاني</th>
                                        <th class="border-bottom-0">مشرف ثالث</th>
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
        </div>
    </div>
@endsection

