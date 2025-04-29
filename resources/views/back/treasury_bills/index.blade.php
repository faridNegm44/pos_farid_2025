
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
                    {data: 'date', name: 'date'},
                    {data: 'client_supplier', name: 'client_supplier'},
                    {data: 'treasury_type', name: 'treasury_type'},
                    {data: 'treasury', name: 'treasury'},
                    {data: 'amount_money', name: 'amount_money'},
                    {data: 'remaining_money', name: 'remaining_money'},
                    {data: 'treasury_money_after', name: 'treasury_money_after'},
                    {data: 'user', name: 'user'},
                    {data: 'notes', name: 'notes'},
                ],
                "bDestroy": true,
                order: [[ 1, "desc" ]],
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>

    {{-- add, edit, delete => script --}}
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
                    <a type="button" href="{{ url('treasury_bills/create') }}" class="btn btn-danger btn-icon ml-2 add"><i class="mdi mdi-plus"></i></a>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->


        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0" >تاريخ المعاملة</th>
                                        <th class="border-bottom-0" >تاريخ اخر</th>
                                        <th class="border-bottom-0">الجهة</th>
                                        <th class="border-bottom-0">نوع المعاملة</th>
                                        <th class="border-bottom-0">خزينة المعاملة</th>
                                        <th class="border-bottom-0">مبلغ المعاملة</th>
                                        <th class="border-bottom-0">علي الجهة / لها</th>
                                        <th class="border-bottom-0">مبلغ الخزينة بعد</th>
                                        <th class="border-bottom-0">موظف</th>
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

