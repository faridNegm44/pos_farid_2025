
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        table.dataTable tbody td.sorting_1{
            background: transparent !important;
        }
        .itemsSearch{
            margin: 0 10px;
        }
    </style>
@endsection

@section('footer')  
    <script>
        $(document).ready(function() {
            $('#example1').DataTable().destroy();
            $('#example1').DataTable({
                "paging": false, // تعطيل التقسيم
                "searching": true, // تفعيل البحث (اختياري)
                "ordering": true, // تفعيل الترتيب (اختياري)
                "info": false, // إخفاء معلومات الصفحة (اختياري)
                "order": [[0, 'desc']]
            });
        });
    </script>
@endsection


@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header text-danger" style="display: block !important;text-align: center;margin-bottom: 15px;">
            <h4 class="content-title mb-5 my-auto">{{ $pageNameAr }}</h4>
        </div>
        <!-- breadcrumb -->

        <div style="margin-bottom: 10px;">
            <div>
                @if ($treasury)
                    <span class="itemsSearch">الخزينة: {{ $results[0]->treasury_name }}</span>
                @endif
                @if ($from)
                    <span class="itemsSearch">تاريخ من: {{ $from }}</span>
                @endif
                @if ($to)
                    <span class="itemsSearch">تاريخ الي: {{ $to }}</span>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">تاريخ المصروف</th>
                                <th class="border-bottom-0" >الخزينة</th>
                                <th class="border-bottom-0">وصف المصروف</th>
                                <th class="border-bottom-0">مبلغ المصروف</th>
                                <th class="border-bottom-0" >مستخدم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                            </tr>
                        </thead>                               
                        
                        <tbody>
                            @foreach ($results as $result)    
                                <tr>                                    
                                    <td>
                                        {{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}
                                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i:s a') }}</span>
                                    </td>
                                    <td>{{ $result->treasury_name }}</td>
                                    <td>{{ $result->title }}</td>
                                    <td>{{ $result->amount_money }}</td>                                    
                                    <td>{{ $result->userName }}</td>
                                    <td>{{ $result->notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection

