
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع السلع والخدمات' }} )
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
                "info": false // إخفاء معلومات الصفحة (اختياري)
            });
        });
    </script>
@endsection


@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header text-danger" style="display: block !important;text-align: center;margin-bottom: 15px;">
            <h4 class="content-title mb-5 my-auto">{{ $pageNameAr }} ( {{ $product ? $results[0]->nameAr : 'جميع السلع والخدمات' }} )</h4>
        </div>
        <!-- breadcrumb -->

        <div style="margin-bottom: 10px;">
            <div>
                @if ($type)
                    <span class="itemsSearch">نوع الحركة: {{ $type }}</span>
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
                                <th class="border-bottom-0" >تاريخ الحركة</th>
                                <th class="border-bottom-0">اسم السلعة/الخدمة</th>
                                <th class="border-bottom-0">نوع الحركة</th>
                                {{--<th class="border-bottom-0">تفاصيل الحركة</th>--}}
                                <th class="border-bottom-0" >مستخدم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                            </tr>
                        </thead>                               
                        
                        <tbody>
                            @foreach ($results as $result)    

                                @php
                                    $type = '';
                                    $color = '#000';

                                    if($result->type == 'تسوية سلعة/خدمة'){
                                        $type = '#FF748B';
                                    }elseif($result->type == 'رصيد اول مدة للسلعة/خدمة'){
                                        $type = '#ccc';
                                    }elseif($result->type == 'تحويل بين مخزنين'){
                                        $type = '#3D3BF3';
                                        $color = '#fff';
                                    }elseif($result->type == 'تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة'){
                                        $type = '#ffd300';
                                    }elseif($result->type == 'اضافة فاتورة مشتريات'){
                                        $type = '#f39be3';
                                    }elseif($result->type == 'اضافة فاتورة مبيعات'){
                                        $type = '#88D3EA';
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
                                    {{--<td>
                                        @if ($result->type == 'تسوية سلعة/خدمة')
                                            <span style="margin: 0 5px;">الكمية قبل: {{ display_number($result->product_bill_quantity) }}</span> -
                                            <span style="margin: 0 5px;">الكمية بعد: {{ display_number($result->quantity_small_unit) }}</span> -

                                            @if ($result->quantity_small_unit > $result->product_bill_quantity)
                                                <span>زيادة {{ $result->quantity_small_unit - $result->product_bill_quantity }}</span>            
                                            @else
                                                <span>عجز {{ $result->product_bill_quantity - $result->quantity_small_unit }}</span>            
                                            @endif

                                        @elseif($result->type == 'تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة')
                                            <span style="margin: 0 5px;">س التكلفة: {{ $result->last_cost_price_small_unit ? display_number($result->last_cost_price_small_unit) : '' }}</span> -

                                            <span style="margin: 0 5px;">س البيع: {{ $result->sell_price_small_unit ? display_number($result->sell_price_small_unit) : '' }}</span> -

                                            <span style="margin: 0 5px;">الضريبة : {{ $result->tax ? display_number($result->tax) : '' }}</span> -

                                            <span style="margin: 0 5px;"> الخصم : {{ $result->discount ? display_number($result->discount) : '' }}</span>

                                        @elseif($result->type == 'رصيد اول مدة للسلعة/خدمة')
                                            <span style="margin: 0 5px;">س التكلفة: {{ $result->last_cost_price_small_unit ? display_number($result->last_cost_price_small_unit) : '' }}</span> -

                                            <span style="margin: 0 5px;">س البيع: {{ $result->sell_price_small_unit ? display_number($result->sell_price_small_unit) : '' }}</span> -

                                            <span style="margin: 0 5px;">الضريبة : {{ $result->tax ? display_number($result->tax) : '' }}</span> -

                                            <span style="margin: 0 5px;"> الخصم : {{ $result->discount ? display_number($result->discount) : '' }}</span>
                                        @endif
                                    </td>--}}
                                    <td>{{ $result->userName }}</td>
                                    <td>{{ $result->tasweaNotes }}</td>
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

