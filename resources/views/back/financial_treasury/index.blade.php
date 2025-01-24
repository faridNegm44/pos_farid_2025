
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')



@endsection

@section('footer') 
    <script>
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

        // show moneyFirstDurationSection whenn click on add button
        $(".add").on('click', function(){
            $("#moneyFirstDurationSection").css('display', 'block');
            $('.dataInput').val('');
            $('#moneyFirstDuration').val(0);
        });


        // focus first input when open modal
        $('.modal').on('shown.bs.modal', function(){
            $('.dataInput:first').focus();                
        });

        // remove all errors when close modal
        $('.modal').on('hidden.bs.modal', function(){
            $('form [id^=errors]').text('');
        });
        
        // selectize
        $('.selectize').selectize({
            hideSelected: true
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
                    {data: 'name', name: 'name'},
                    {data: 'moneyFirstDuration', name: 'moneyFirstDuration'},
                    {data: 'status', name: 'status'},
                    {data: 'notes', name: 'notes'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[ 0, "desc" ]],
                //fixedColumns: {
                //    leftColumns: 4
                //},
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.financial_treasury.add')
    @include('back.financial_treasury.edit')
    @include('back.financial_treasury.delete')
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

        @include('back.financial_treasury.form')


        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">الإسم</th>
                                        <th class="wd-15p border-bottom-0">رصيد أول المدة</th>
                                        <th class="wd-10p border-bottom-0">الحالة</th>
                                        <th class="wd-15p border-bottom-0">ملاحظات</th>
                                        <th class="wd-25p border-bottom-0">التحكم</th>
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

