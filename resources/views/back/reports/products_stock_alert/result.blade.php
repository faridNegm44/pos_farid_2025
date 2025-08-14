
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
                        <thead class="thead-light">
                            <tr>
                                <th class="border-bottom-0">كود السلعة/الخدمة</th>
                                <th class="border-bottom-0">اسم السلعة/الخدمة</th>
                                <th class="border-bottom-0">حد الطلب</th>
                                <th class="border-bottom-0">كمية السلعة/الخدمة حاليا</th>
                                <th class="border-bottom-0">المخزن</th>
                                <th class="border-bottom-0" >القسم</th>
                            </tr>
                        </thead>                               
                        
                        <tbody>
                            @foreach ($supp_results as $result)    

                                <tr>
                                    <td>{{ $result->productId }}</td>
                                    <td>{{ $result->nameAr }}</td>
                                    <td>{{ $result->stockAlert ? display_number($result->stockAlert) : '' }}</td>                                    
                                    <td style="font-size: 15px !important;">{{ $result->quantity_small_unit ? display_number($result->quantity_small_unit) : '' }}</td>
                                    <td>{{ $result->storeName }}</td>
                                    <td>{{ $result->categoryName }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $supp_results->links() }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

