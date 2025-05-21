
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        .ajs-success, .ajs-error{
            min-width: 450px !important;
        }
    </style>
@endsection

@section('footer')
    <script>
        // focus first input when open modal
        $('.modal').on('shown.bs.modal', function(){
            $('.dataInput:first').focus();
        });

        // remove all errors when close modal
        $('.modal').on('hidden.bs.modal', function(){
            $('form [id^=errors]').text('');
        });

        // cancel enter button
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();
            }
        }); 

        
        // start check if new quantity > 0 and not null
        $(document).on('input', '#quantity', function(){
            const thisVal = $(this);
            if(!thisVal.val() || thisVal.val() < 0 ){
                thisVal.val('');
            }
        })
        // end check if new quantity > 0 and not null




        // start check if new quantity big than current quantity
        //$("#quantity").on('blur', function(){
        //    const newQuantity = $(this).val();
        //    const currentQuantity = $('#current_quantity').val();

        //    if(newQuantity > currentQuantity){
        //        $(this).val('');

        //        alertify.set('notifier','position', 'top-center');
        //        alertify.set('notifier','delay', 3);
        //        alertify.error("كمية المنتج المسواه اكبر من كمية المخزن");
        //    }
        //});


        // start Datatable
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'product_id', name: 'product_id'},
                    {data: 'productName', name: 'productName'},
                    {data: 'quantityBefore', name: 'quantityBefore'},
                    {data: 'quantityAfter', name: 'quantityAfter'},
                    {data: 'status', name: 'status'},
                    {data: 'reasonName', name: 'reasonName'},
                    {data: 'tasweaCreatedAt', name: 'tasweaCreatedAt'},
                    {data: 'userName', name: 'userName'},
                    {data: 'tasweaNotes', name: 'tasweaNotes'},
                    {data: 'financialName', name: 'financialName'},
                ],
                "bDestroy": true,
                order: [[0, 'desc']],
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>



    {{--  start search products by selectize #products_selectize --}}
    <script>
        $(document).ready(function() {
            // بدايه الجزء الخاص بالبحث وعرض العملاء في selectize
            $('#products_selectize').selectize({
                valueField: 'id',  // القيمة المخزنة عند الاختيار
                labelField: 'nameAr', // النص الظاهر للمستخدم
                searchField: ['id', 'nameAr', 'nameEn'], // البحث في كل الحقول
                loadThrottle: 300, // تقليل عدد الطلبات عند البحث
                maxItems: 1, // اختيار عنصر واحد فقط
                create: false, // منع إضافة عناصر جديدة
                preload: 'focus', // تحميل البيانات عند التركيز على الحقل
                render: {
                    option: function(item, escape) {
                        const quantity = escape(item.quantity_small_unit);
                        const disabled = quantity == 0 ? 'style="background:#f8d7da; color:#721c24;"' : '';                        

                        return `<option ${disabled}>
                                    كود: ${escape(item.id)} - 
                                    الصنف: ${escape(item.nameAr)} - 
                                    كمية ص: ${ display_number_js( escape(item.quantity_small_unit) ) } ${ escape(item.smallUnitName) }
                                </option>`;
                    },
                    item: function(item, escape) {
                        return `<div>
                                    كود: ${escape(item.id)} - 
                                    الصنف: ${escape(item.nameAr)} - 
                                    كمية ص: ${ display_number_js( escape(item.quantity_small_unit) ) } ${ escape(item.smallUnitName) }
                                </div>`;
                    }
                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: `{{ url('search_products_by_selectize') }}`, // رابط البحث
                        type: 'GET',
                        dataType: 'json',
                        data: { data_input_search: query },
                        success: function(response) {
                            if (response.items && Array.isArray(response.items)) {
                                callback(response.items);
                            } else {
                                console.error("البيانات غير صحيحة:", response);
                                callback([]);
                            }
                        },
                        error: function(error) {
                            console.error("خطأ في جلب البيانات:", error);
                            callback([]);
                        }
                    });
                }
            });
            // نهاية الجزء الخاص بالبحث وعرض العملاء في selectize



            // بدايه اختيار صنف من selectize واضافته في في جدول العملاء
            $('#products_selectize').change(function() {
                
                var productId = $(this).val();
                var selectizeInstance = $(this)[0].selectize; // الحصول على instance من selectize

                if (productId) {
                    var productData = selectizeInstance.options[productId]; // بيانات العنصر المحدد
                    var quantity_all = display_number_js(productData.quantity_small_unit); // كميه المخزن


                    $("#current_quantity").val(quantity_all);
                    $("#quantity").val('');

                    alertify.set('notifier', 'position', 'top-center');
                    alertify.set('notifier', 'delay', 3);
                    alertify.success("تم استدعاء الرصيد الحالي للمنتج بنجاح. في انتظار التسوية");
                }else{
                    $("#current_quantity, #quantity").val('');
                }
            });
            // نهاية اختيار صنف من selectize واضافته في في جدول العملاء
        });
    </script>
    {{--  end search products by selectize #products_selectize --}}

    {{-- add, edit, delete => script --}}
    @include('back.taswea_products.add')
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
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-xl-0">
                    <button type="button" class="btn btn-danger btn-icon ml-2 add" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter"><i class="mdi mdi-plus"></i></button>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        @include('back.taswea_products.form')

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">كود الصنف</th>
                                        <th class="border-bottom-0" >إسم الصنف</th>
                                        <th class="border-bottom-0">الكمية قبل</th>
                                        <th class="border-bottom-0">الكمية بعد</th>
                                        <th class="border-bottom-0">حالة التسوية</th>
                                        <th class="border-bottom-0">سبب التسوية</th>
                                        <th class="border-bottom-0">تاريخ التسوية</th>
                                        <th class="border-bottom-0">مستخدم</th>
                                        <th class="border-bottom-0">ملاحظات</th>
                                        <th class="border-bottom-0" >السنة</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

