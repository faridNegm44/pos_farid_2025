
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

        
        // datatable
        $(document).ready(function () {
            $('#example1').DataTable().destroy();
            
            $('#example1').DataTable({
                "pageLength": 50, 
                "lengthMenu": [ [10, 50, 100, 300, 500, -1], [10, 50, 100, 300, 500, "الكل"] ], 
                "ordering": true,      
                "searching": true,
                "info": true,     
                "paging": true,
                "language": {
                    "lengthMenu": "عرض _MENU_ صف في الصفحة",
                    "zeroRecords": "لا توجد بيانات",
                    "info": "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    "infoEmpty": "لا توجد سجلات متاحة",
                    "infoFiltered": "(تمت التصفية من إجمالي _MAX_ سجل)",
                    "search": "بحث:",
                    "paginate": {
                        "first": "الأول",
                        "last": "الأخير",
                        "next": "التالي",
                        "previous": "السابق"
                    }
                }
            });
        });



        // start when change current_quantity
        $(".current_quantity").on('input', function() {
            let rawVal = $(this).val();  
            const stockQuantity = parseFloat($(this).closest('tr').find('.stockQuantity').text()) || 0;
            const diffElement = $(this).closest('tr').find('.diff');

            diffElement.removeClass('bg bg-primary bg-danger bg-success bg-light text-white text-dark');

            if (rawVal === '' || rawVal === null) {
                diffElement.text('0');
                return;

            }else if(rawVal < 0){
                $(this).val('');
                return;
            }

            const thisval = parseFloat(rawVal);
            const diff = thisval - stockQuantity;

            if (thisval > stockQuantity) {
                diffElement.addClass('bg bg-primary text-white').text(`زيادة ( ${diff} )`);
            } else if (thisval < stockQuantity) {
                diffElement.addClass('bg bg-danger text-white').text(`عجز ( ${diff} )`);
            } else {
                diffElement.addClass('bg bg-success text-white').text(`متساوي ( ${diff} )`);
            }
        });
        // end when change current_quantity


        // start when click submit form
        $(document).ready(function () {
            const inventoryId = @json($inventory_info->id);

            $('#form').on('submit', function(e) {
                e.preventDefault();

                alertify.confirm(
                    'انتبة !! <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>',
                    `<div style="text-align: center;">
                        <p style="">
                            هل تريد حفظ بيانات الجرد الحالية؟ 📝  
                            <br />
                            <span class="text-danger">⚠️ تأكد من مطابقة العد الفعلي قبل الحفظ.</span>
                        </p>
                    </div>`,
                function(){
                    $.ajax({
                        url: `{{ url('inventories/update') }}/${inventoryId}`,
                        type: 'post',
                        processData: false,
                        contentType: false,
                        data: new FormData($('form')[0]),
                        beforeSend:function () {
                            $("#overlay_page").fadeIn();    
                        },
                        error: function(res){
                            $("#overlay_page").fadeOut();
                        },
                        success: function(res){
                            
                            $("#overlay_page").fadeOut();

                            alertify.confirm(
                                'رائع <i class="fas fa-check-double text-success" style="margin: 0px 3px;"></i>', 
                                `<span class="text-center">
                                    <p class="text-success">✅ تم حفظ بيانات الجرد بنجاح</p>  
                                    <p class="text-primary">🔒 إذا انتهيت، يمكنك التوجه لإغلاق الجرد واعتماده.</p>                                
                                </span>`, 
                            function(){                                
                                window.location.href = "{{ url('inventories') }}";
                                
                            }, function(){ 
                                location.reload();
                            }).set({
                                labels:{
                                    ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                                    cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                                }
                            });
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
        });
        // end when click submit form
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
                            <form action="" id="form">
                                @csrf
                                <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 15px !important;min-width: 15px !important;">#</th>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 40px !important;min-width: 40px !important;">كود</th>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 200px !important;min-width:200px !important;">اسم السلعة/الخدمة</th>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 70px !important;min-width: 70px !important;">الوحدة ص</th>
                                            @if((userPermissions()->cost_price_view))
                                                <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">س تكلفة</th>
                                            @endif
                                            <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">س بيع</th>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">ك دفترية</th>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 80px !important;min-width: 80px !important;">ك معدودة</th>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 70px !important;min-width: 70px !important;">الفارق</th>
                                            <th class="border-bottom-0 nowrap_thead" style="width: 130px !important;min-width: 130px !important;">ملاحظات</th>
                                        </tr>
                                    </thead>                                

                                   <tbody>
                                        @forelse($results as $index => $result)
                                            @php
                                                $isExist = collect($checkInventorybefore)->contains(fn($r) => $r->product_id == $result->productId);
                                            @endphp

                                            <tr class="{{ $isExist ? 'bg bg-info text-dark' : '' }}">
                                                <td>{{ $index+1 }}</td>
                                                <td>
                                                    {{ $result->productId }}
                                                    <input type="hidden" name="product_id[]" value="{{ $result->productId }}" />
                                                </td>
                                                <td style="font-size: 10px !important;">{{ $result->productNameAr }}</td> 
                                                <td>{{ $result->small_unit_name }}</td>
                                                @if((userPermissions()->cost_price_view))                                                
                                                    <td>{{ display_number($result->last_cost_price_small_unit) }}</td> 
                                                @endif
                                                <td>{{ display_number($result->sell_price_small_unit) }}</td> 
                                                <td style="font-size: 15px;font-weight: bold;" class="stockQuantity">{{ (int) $result->quantity_small_unit }}</td>
                                                <td>
                                                    <input type="number" class="form-control text-center focused current_quantity" 
                                                        name="current_quantity[]" 
                                                        style="height: 20px !important;border: 1px solid #ccc;width: 60%;margin: auto;" 
                                                        min="0" />
                                                </td>

                                                <td>
                                                    @if ($isExist)
                                                        @if ((int) $result->quantity_small_unit > (int) $result->product_bill_quantity)
                                                            <span class="diff bg bg-primary text-white" style="display: block;padding: 1px 3px;">
                                                                زيادة ( {{ (int) $result->quantity_small_unit - (int) $result->product_bill_quantity  }} )
                                                            </span>
                                                            
                                                        @elseif ((int) $result->quantity_small_unit < (int) $result->product_bill_quantity)
                                                            <span class="diff bg bg-danger text-white" style="display: block;padding: 1px 3px;">
                                                                عجز ( {{ (int) $result->quantity_small_unit - (int) $result->product_bill_quantity  }} )
                                                            </span>

                                                        @elseif ((int) $result->quantity_small_unit == (int) $result->product_bill_quantity)
                                                            <span class="diff bg bg-success text-white" style="display: block;padding: 1px 3px;">
                                                                متساوي ( {{ (int) $result->quantity_small_unit - (int) $result->product_bill_quantity  }} )
                                                            </span>
                                                        @endif                        
                                                    @else
                                                        <span class="diff" style="display: block;padding: 1px 3px;">0</span>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    <input type="text" class="form-control text-center focused" 
                                                        name="notes[]" 
                                                        style="height: 20px !important;border: 1px solid #ccc;font-size: 9px !important;" 
                                                        placeholder="ملاحظة (إن وجدت)" />
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11">🚫 لا توجد بيانات جرد متاحة</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>

                                <input type="submit" class="btn btn-success" style="display: block; width: 100%;border-radius: 50px;margin: 20px 0;" value="حفظ الجرد">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

