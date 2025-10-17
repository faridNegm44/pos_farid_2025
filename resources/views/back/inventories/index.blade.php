
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')



@endsection

@section('footer') 

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


        // start when click to close_inventory
        $(document).on('click', '.close_inventory', function(){
            const res_id = $(this).attr('res_id');

            alertify.confirm(
                'انتبة !! <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>',
                `<div style="text-align: center;">
                    <p style="">
                        اعتماد الجرد 📦
                        هل أنت متأكد من اعتماد هذا الجرد وإغلاقه؟ 📝<br/><span class="text-danger">لن تتمكن من تعديله بعد الإغلاق.</span>
                    </p>
                </div>`,
            function(){
                $.ajax({
                    url: `{{ url('inventories/close') }}/${res_id}`,
                    type: 'get',
                    beforeSend:function () {
                        $("#overlay_page").fadeIn();    
                    },
                    error: function(res){
                        $("#overlay_page").fadeOut();
                    },
                    success: function(res){
                        $("#overlay_page").fadeOut();
                        
                        if(res.notAuth){
                            alertify.dialog('alert')
                                .set({transition:'slide',message: `
                                    <div style="text-align: center;">
                                        <p style="color: #e67e22; font-size: 18px; margin-bottom: 10px;">
                                            صلاحية غير متوفرة 🔐⚠️
                                        </p>
                                        <p>${res.notAuth}</p>
                                    </div>
                                `, 'basic': true})
                                .show();  
                            $(".modal").modal('hide');  

                        }else{                            
                            $('#example1').DataTable().ajax.reload( null, false );
    
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 3);
                            alertify.success("✅ تم اعتماد هذا الجرد وإغلاقه بنجاح");
                        }
                    }
                });


            }, function(){

            }).set({
                labels:{
                    ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                    cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                }
            });  
        });
        // end when click to close_inventory

        
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
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-bottom-0 nowrap_thead">#</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 200px !important;min-width: 200px !important;">التحكم</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">تاريخ الجرد الفعلي</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">تاريخ اخر للجرد</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 70px !important;min-width: 70px !important;">حالة الجرد</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">مشرف أول</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">مشرف تاني</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">مشرف ثالث</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">ملاحظات</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 90px !important;min-width: 90px !important;">مستخدم</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 90px !important;min-width: 90px !important;">السنة</th>
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

