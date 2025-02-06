
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        table.dataTable tbody td.sorting_1{
            background: transparent !important;
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
                "info": false // إخفاء معلومات الصفحة (اختياري)
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


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">رقم الحركة</th>
                                <th class="border-bottom-0" >تاريخ الحركة</th>
                                <th class="border-bottom-0">خزينة الحركة</th>
                                <th class="border-bottom-0">نوع الحركة</th>
                                <th class="border-bottom-0">قيمة الحركة</th>
                                <th class="border-bottom-0" >مستخدم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                            </tr>
                        </thead>                               
                        
                        <tbody>
                            @foreach ($results as $result)    

                                @php
                                    $type = '';
                                    $color = '#000';

                                    if($result->treasury_type == 'مصروف'){
                                        $type = '#FF748B';
                                    }elseif($result->treasury_type == 'رصيد اول خزنة'){
                                        $type = '#ddd';
                                    }elseif($result->treasury_type == 'تحويل'){
                                        $type = '#3D3BF3';
                                        $color = '#fff';
                                    }elseif($result->treasury_type == 'اذن اضافة نقدية'){
                                        $type = '#A1EEBD';
                                    }elseif($result->treasury_type == 'اذن صرف نقدية'){
                                        $type = '#7BD3EA';
                                    }
                                @endphp


                                <tr style="background: {{ $type }}; color: {{ $color }};">
                                    <td>{{ $result->num_order }}</td>
                                    <td>
                                        {{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}
                                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i:s a') }}</span>
                                    </td>
                                    <td>{{ $result->treasury_name }}</td>
                                    <td>{{ $result->treasury_type }}</td>
                                    <td>{{ number_format($result->value) }}</td>
                                    <td>{{ $result->user_name }}</td>
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

