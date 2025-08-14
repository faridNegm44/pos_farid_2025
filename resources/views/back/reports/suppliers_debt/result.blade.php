
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
        $('#example1').DataTable().destroy(); // تدمير الجدول القديم إن وجد

        $('#example1').DataTable({
            paging: true,          // إلغاء التقسيم
            pageLength: 50,
            lengthMenu: [ [50, 100, 200, -1], [50, 100, 200, "الكل"] ],
            searching: true,        // تفعيل البحث
            ordering: false,        // إلغاء الترتيب
            info: true,             // تفعيل معلومات الجدول
            order: [[0, 'asc']],    // ترتيب حسب أول عمود

            // ✅ شكل توزيع الأدوات داخل الصفحة
            dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 text-center'B><'col-sm-12 col-md-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            // ✅ أزرار التصدير والطباعة
            buttons: [
                {
                    extend: 'excel',
                    text: '📊 Excel',
                    className: 'btn btn-outline-dark',
                    exportOptions: { columns: ':visible' }
                },
                {
                    extend: 'print',
                    text: '🖨️ طباعة',
                    className: 'btn btn-outline-dark',
                    exportOptions: { columns: ':visible' },
                    customize: function (win) {
                        $(win.document.body).css('direction', 'rtl'); // جعل الطباعة من اليمين
                    }
                },
                {
                    extend: 'colvis',
                    text: '👁️ إظهار/إخفاء الأعمدة',
                    className: 'btn btn-outline-dark'
                }
            ]
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
                @if ($balance_type)
                    @if ($balance_type == 'debtor')
                        <span class="itemsSearch text-primary">نوع الرصيد: 🟩 عليهم فلوس (مدينين)</span>
                    @else
                        <span class="itemsSearch text-danger">نوع الرصيد: 🟥 لهم فلوس (دائنين)</span>
                    @endif
                @endif
                @if ($from)
                    <span class="itemsSearch">تاريخ من: {{ Carbon\Carbon::parse($from)->format('Y-m-d h:i:s a') }}</span>
                @endif
                @if ($to)
                    <span class="itemsSearch">تاريخ الي: {{ Carbon\Carbon::parse($to)->format('Y-m-d h:i:s a') }}</span>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center text-md-nowrap" id="example1">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-bottom-0">المورد</th>
                                <th class="border-bottom-0">الهاتف</th>
                                <th class="border-bottom-0">الرصيد المتبقي</th>
                                <th class="border-bottom-0">آخر معاملة</th>
                            </tr>
                        </thead>                               
                        
                        <tbody>
                            @php $sumTotal = 0; @endphp
                        
                            @forelse($results as $row)
                                @php
                                    $query = http_build_query([
                                        'supplier_id' => $row->client_supplier_id,
                                        'treasury_type' => '',
                                        'from' => '',
                                        'to' => ''
                                    ]);
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ url('suppliers/report/account_statement/pdf') . '?' . $query }}" target="_blank">
                                            {{ $row->supplierName }}
                                        </a>
                                    </td>
                                    <td>{{ $row->supplierPhone }}</td>
                                    <td class="{{ $row->remaining_money < 0 ? 'text-danger' : 'text-primary' }}">
                                        {{ display_number($row->remaining_money) }} جنيه
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}
                                        <span style="margin: 0 2px;color: red;">
                                            {{ \Carbon\Carbon::parse($row->created_at)->format('h:i:s a') }}
                                        </span>
                                    </td>
                                </tr>
                                @php $sumTotal += $row->remaining_money; @endphp
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endforelse
                            @if($results->count() > 0)
                                <tr style="height: 24px !important;">
                                    <td></td><td></td><td></td><td></td>
                                </tr>
                                <tr style="font-weight: bold;">
                                    <td class="text-center">إجمالي الرصيد</td><td></td>
                                    <td class="{{ $sumTotal < 0 ? 'text-danger' : 'text-primary' }}" style="font-size: 18px !important;">
                                        {{ display_number($sumTotal) }} جنيه
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        
                            
                        </tbody>
                        
                    </table>

                </div>
            </div>
        </div>
        
    </div>
@endsection

