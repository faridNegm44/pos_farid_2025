
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')



@endsection

@section('footer') 
    <script>       
        // cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();  
            }
        });
        
        //$(document).ready(function () {
        //    $('#example1').DataTable({
        //        processing: true,
        //        serverSide: true,
        //        ajax: `{{ url($pageNameEn.'/datatable') }}`,
        //        dataType: 'json',
        //        columns: [
        //            {data: 'id', name: 'id'},
        //            {data: 'action', name: 'action', orderable: false},
        //            {data: 'created_at', name: 'created_at'},
        //            {data: 'date', name: 'date'},
        //            {data: 'status', name: 'status'},
        //            {data: 'supervisor_1Name', name: 'supervisor_1'},
        //            {data: 'supervisor_2Name', name: 'supervisor_2'},
        //            {data: 'supervisor_3Name', name: 'supervisor_3'},
        //            {data: 'notes', name: 'notes'},
        //            {data: 'userName', name: 'userName'},
        //            {data: 'financialName', name: 'financialName'},
        //        ],
        //        dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
        //            "<'row'<'col-sm-12'tr>>" +
        //            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        //        buttons: [
        //            { extend: 'excel', text: '📊 Excel', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'} },
        //            { extend: 'print', text: '🖨️ طباعة', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'}, customize: function (win) { $(win.document.body).css('direction', 'rtl'); } },
        //            { extend: 'colvis', text: '👁️ إظهار/إخفاء الأعمدة', className: 'btn btn-outline-dark' }
        //        ],
        //        "bDestroy": true,
        //        order: [[0, 'desc']],
        //        language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
        //        lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
        //    });
        //});
    </script>
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
        </div>
        <!-- breadcrumb -->


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
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">كود الصنف</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">اسم الصنف</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 70px !important;min-width: 70px !important;">الكمية بالمخزن</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">الكمية الفعلية (عدّ يدوي)</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">لفارق (إن وجد)</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">تاريخ آخر تحديث</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 90px !important;min-width: 90px !important;">المستخدم المسؤول</th>
                                        <th class="border-bottom-0 nowrap_thead" style="width: 120px !important;min-width: 120px !important;">ملاحظات</th>
                                    </tr>
                                </thead>                                

                                <tbody>
                                    @forelse($results as $index => $res)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{--<a href="{{ url('inventories/start/'.$res->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-play"></i> بدء الجرد
                                                </a>--}}
                                            </td>
                                            <td>{{ $res->actual_inventory_date ?? '-' }}</td>
                                            <td>{{ $res->last_inventory_date ?? '-' }}</td>
                                            <td>
                                                {{--@if($res->status == 'open')
                                                    <span class="badge bg-warning">مفتوح</span>
                                                @elseif($res->status == 'closed')
                                                    <span class="badge bg-success">مغلق</span>
                                                @else
                                                    <span class="badge bg-secondary">غير محدد</span>
                                                @endif--}}
                                            </td>
                                            <td>{{ $res->supervisor_one ?? '-' }}</td>
                                            <td>{{ $res->supervisor_two ?? '-' }}</td>
                                            <td>{{ $res->supervisor_three ?? '-' }}</td>
                                            <td>{{ $res->notes ?? '-' }}</td>
                                            <td>{{ $res->user->name ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11">🚫 لا توجد بيانات جرد متاحة</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

