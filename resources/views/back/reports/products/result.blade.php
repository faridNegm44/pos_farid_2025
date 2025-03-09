
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع الأصناف' }} )
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
            <h4 class="content-title mb-5 my-auto">{{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع الأصناف' }} )</h4>
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
                                <th class="border-bottom-0">اسم الصنف</th>
                                <th class="border-bottom-0">نوع الحركة</th>
                                <th class="border-bottom-0">تفاصيل الحركة</th>
                                <th class="border-bottom-0" >مستخدم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                            </tr>
                        </thead>                               
                        
                        <tbody>
                            @foreach ($results as $result)    

                                @php
                                    $type = '';
                                    $color = '#000';

                                    if($result->type == 'تسوية صنف'){
                                        $type = '#FF748B';
                                    }elseif($result->type == 'رصيد اول'){
                                        $type = '#ccc';
                                    }elseif($result->type == 'تحويل'){
                                        $type = '#3D3BF3';
                                        $color = '#fff';
                                    }elseif($result->type == 'اذن اضافة نقدية'){
                                        $type = '#A1EEBD';
                                    }elseif($result->type == 'اذن صرف نقدية'){
                                        $type = '#7BD3EA';
                                    }
                                @endphp


                                <tr style="background: {{ $type }}; color: {{ $color }};">
                                    <td>{{ $result->id }}</td>
                                    <td>
                                        {{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}
                                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i:s a') }}</span>
                                    </td>
                                    <td>{{ $result->nameAr }}</td>
                                    <td>{{ $result->type }}</td>
                                    <td>
                                        @if ($result->type == 'تسوية صنف')
                                            <span style="margin: 0 5px;">الكمية قبل: {{ $result->quantity }}</span> -
                                            <span style="margin: 0 5px;">الكمية بعد: {{ $result->quantity_all }}</span> -

                                            @if ($result->quantity_all > $result->quantity)
                                                <span>زيادة {{ $result->quantity_all - $result->quantity }}</span>            
                                            @else
                                                <span>عجز {{ $result->quantity - $result->quantity_all }}</span>            
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $result->userName }}</td>
                                    <td>{{ $result->tasweaNotes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection

