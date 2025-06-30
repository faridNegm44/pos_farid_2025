
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
                "order": [[0, 'asc']]
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
                @if ($partner_id)
                    <span class="itemsSearch">شريك: {{ $results[0]->partnerName }}</span>
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
                                {{--<th class="border-bottom-0">رقم الحركة</th>--}}
                                <th class="border-bottom-0" >تاريخ الحركة</th>
                                <th class="border-bottom-0" >تاريخ اخر</th>
                                <th class="border-bottom-0">خزينة الحركة</th>
                                <th class="border-bottom-0">نوع الحركة</th>
                                <th class="border-bottom-0">قيمة الحركة</th>
                                <th class="border-bottom-0" style="width: 12%;">الجهة</th>
                                <th class="border-bottom-0">نسبة الجهة</th>
                                <th class="border-bottom-0">علي الجهة / لها</th>
                                {{--<th class="border-bottom-0">مبلغ الخزينة بعد</th>--}}
                                <th class="border-bottom-0" >مستخدم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                            </tr>
                        </thead>                               
                        
                        <tbody>
                            @foreach ($results as $result)    
                                @php
                                    $type = '';

                                    if($result->treasury_type == 'اذن توريد نقدية'){
                                        $type = '#8ae3aa';
                                    }elseif($result->treasury_type == 'اذن صرف نقدية'){
                                        $type = '#de7df0';
                                    }elseif($result->treasury_type == 'رصيد اول شريك'){
                                        $type = '#7bbdf3';
                                    }elseif($result->treasury_type == 'تعديل نسبة شريك'){
                                        $type = '#c7a98d';
                                    }elseif($result->treasury_type == 'تسوية رصيد للجهة'){
                                        $type = '#f76d6d';
                                    }
                                @endphp


                                <tr style="background: {{ $type }};">
                                    {{--<td>{{ $result->id }}</td>--}}
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
                                    <td>{{ $result->treasury_type }}</td>
                                    <td>{{ display_number($result->amount_money) }}</td>
                                    <td>( {{ $result->partner_id }} ) {{ $result->partnerName }}</td>
                                    <td>{{ display_number($result->commission_percentage) }} %</td>
                                    <td>{{ display_number($result->remaining_money) }}</td>
                                    {{--<td>{{ display_number($result->treasury_money_after) }}</td>--}}
                                    <td>{{ $result->userName }}</td>
                                    <td>{{ $result->notes }}</td>
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

