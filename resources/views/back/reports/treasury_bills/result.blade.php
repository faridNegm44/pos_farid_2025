
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
                "ordering": false, // تفعيل الترتيب (اختياري)
                "info": true, // إخفاء معلومات الصفحة (اختياري)
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
                @if ($treasury_id)
                    <span class="itemsSearch">خزينة الحركة: {{ $results[0]->treasury_name }}</span>
                @endif
                @if ($treasury_type)
                    <span class="itemsSearch">نوع الحركة: {{ $results[0]->treasury_type }}</span>
                @endif
                @if ($from)
                    <span class="itemsSearch">تاريخ من: {{ Carbon\Carbon::parse($from)->format('d-m-Y h:i:s a') }}</span>
                @endif
                @if ($to)
                    <span class="itemsSearch">تاريخ الي: {{ Carbon\Carbon::parse($to)->format('d-m-Y h:i:s a') }}</span>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">رقم الحركة</th>
                                <th class="border-bottom-0" style="width: 15%;">تاريخ الحركة</th>
                                <th class="border-bottom-0" >تاريخ اخر</th>
                                <th class="border-bottom-0">خزينة الحركة</th>
                                <th class="border-bottom-0">نوع الحركة</th>
                                <th class="border-bottom-0">قيمة الحركة</th>
                                <th class="border-bottom-0">علي الجهة / لها</th>
                                <th class="border-bottom-0">مبلغ الخزينة بعد</th>
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
                                        $type = '#ccc';
                                    }elseif($result->treasury_type == 'تحويل بين خزنتين'){
                                        $type = '#b8e757';
                                    }elseif($result->treasury_type == 'اذن توريد نقدية'){
                                        $type = '#8ae3aa';
                                    }elseif($result->treasury_type == 'اذن صرف نقدية'){
                                        $type = '#de7df0';
                                    }elseif($result->treasury_type == 'تعديل نسبة شريك'){
                                        $type = '#737576';
                                        $color = '#fff';
                                    }elseif($result->treasury_type == 'تسوية رصيد للجهة'){
                                        $type = '#f10202';
                                        $color = '#fff';
                                    }elseif($result->treasury_type == 'مرتجع مصروف'){
                                        $type = '#000';
                                        $color = '#fff';
                                    }elseif($result->treasury_type == 'رصيد اول عميل' || $result->treasury_type == 'رصيد اول مورد' || $result->treasury_type == 'رصيد اول شريك'){
                                        $type = '#87c5fd';
                                    }
                                @endphp


                                <tr style="background: {{ $type }};color: {{ $color }}">
                                    <td>{{ $result->id }}</td>
                                    {{--<td>{{ $result->num_order }}</td>--}}
                                    <td>
                                        {{ Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}
                                        <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->created_at)->format('h:i:s a') }}</span>
                                    </td>
                                    <td>
                                        @if(Carbon\Carbon::parse($result->created_at)->format('d-m-Y') != Carbon\Carbon::parse($result->date)->format('d-m-Y'))
                                            <span style="margin: 0 5px;">{{ Carbon\Carbon::parse($result->date)->format('d-m-Y') }}</span>
                                        @endif                                        
                                    </td>
                                    <td>{{ $result->treasury_name }}</td>
                                    <td>
                                        @if ($result->treasury_type === 'مصروف')
                                            {{ $result->treasury_type }}
                                            <p style="font-size: 10px;">- {{ $result->expensesTitle }}</p>
                                        @else
                                            {{ $result->treasury_type }}
                                        @endif
                                    </td>
                                    <td>{{ display_number($result->amount_money) }}</td>
                                    <td>
                                        @if ($result->treasury_type === 'رصيد اول خزنة' || $result->treasury_type === 'مصروف' || $result->treasury_type === 'تحويل بين خزنتين')
                                            لاتوجد جهة
                                        @else
                                            {{ display_number($result->remaining_money) }}
                                        @endif
                                    </td>
                                    <td>{{ display_number($result->treasury_money_after) }}</td>
                                    <td>{{ $result->user_name }}</td>
                                    <td style="font-size: 9px !important;">{{ $result->notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

