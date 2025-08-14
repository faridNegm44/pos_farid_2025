
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')

@endsection

@section('footer')  
    <script>       
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

        // selectize
        $('.selectize').selectize({
            hideSelected: true
        });
    </script>


    <script>
        flatpickr(".datePicker", {
            enableTime: true,
            dateFormat: "d-m-Y       h:i K", 
            time_24hr: false
        });
    </script>
    
    <script>
        $("#store_id").on('input', function(){
            const thisVal = $(this).val();

            $.ajax({
                type: "GET",
                url: `{{ url('products/getProductsByStore') }}/${thisVal}`,
                beforeSend: function(){
                    $("#products")[0].selectize.clearOptions();
                },
                success: function (res) {
                    if(res.length > 0){
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 3);
                        alertify.success("تمت جلب السلع والخدمات المتعلقة بالمخزن بنجاح");
    
                        $.each(res, function(index, value){
                            $("#products")[0].selectize.addOption({
                                value: value.id,
                                text: value.nameAr
                            });
                        });
                    }else{
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 3);
                        alertify.warning("لاتوجد أصناف متعلقة بالمخزن في الوقت الحالي");
                    }
                }
            });
        });
    </script>


    {{-- start when click to button #print_report --}}
    <script>
        $(document).on('click', '#print_report', function(e) {
            e.preventDefault();
            let formData = $("form").serialize();
            let printUrl = "{{ url('products/report/result/pdf') }}?" + formData;

            window.open(printUrl);
        });
    </script>
    {{-- end when click to button #print_report --}}

@endsection


@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header text-danger" style="display: block !important;text-align: center;margin-bottom: 15px;">
            <h4 class="content-title mb-5 my-auto">{{ $pageNameAr }}</h4>
        </div>
        <!-- breadcrumb -->

        @if (session('notFound'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('notFound') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="float: left;font-size: 30px;">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="card bg" style="padding: 20px 0 !important;background-image: linear-gradient(to left, #dfe2e6, #4e9eb5) !important;" style="padding: 20px 0 !important;">
            <div class="card-body">
                <form method="get" action="{{ url('products/report/result') }}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                            <label for="store_id">المخازن</label>
                            <div>
                                <select  name="store_id" class="store_id selectize" id="store_id">
                                    <option value="" selected>اختر مخزن</option>                              
                                    <option value="all">الكل</option>                              
                                    @foreach ($stores as $store)
                                      <option value="{{ $store->id }}">{{ $store->id }} - {{ $store->name }}</option>                              
                                    @endforeach
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-store_id" style="display: none;"></bold>
                        </div>    
                        
                        <div class="col-md-2">
                            <label for="products">السلع والخدمات</label>
                            <div>
                                <select  name="products" class="products selectize" id="products">
                                    <option value="" selected>اختر مخزن أولا ثم سلعة/خدمة</option>                                    
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-products" style="display: none;"></bold>
                        </div>                                                
                        
                        <div class="col-md-2">
                            <label for="type">أنواع الحركات علي السلع والخدمات</label>
                            <div>
                                <select  name="type" class="type form-control" id="type">
                                    <option value="" selected class="text-muted">أنواع الحركات علي السلع والخدمات</option>                                    
                                    <option value="رصيد اول مدة للسلعة/خدمة">رصيد اول مدة للسلعة/خدمة</option>                                    
                                    <option value="تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة">تعديل سعر تكلفة او سعر بيع او خصم او ضريبة للسلعة/للخدمة</option>                                    
                                    <option value="تسوية سلعة/خدمة" class="text-danger">تسوية سلعة/خدمة</option>                                    
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-type" style="display: none;"></bold>
                        </div>                                                
                        
                        <div class="col-md-2">
                            <label for="from">من</label>
                            <div>
                                <input type="text" class="form-control dataInput datePicker" placeholder="من" id="from" name="from">
                            </div>
                            <bold class="text-danger" id="errors-from" style="display: none;"></bold>
                        </div>    
                        
                        <div class="col-md-2">
                            <label for="to">الي</label>
                            <div>
                                <input type="text" class="form-control dataInput datePicker" placeholder="الي" id="to" name="to">
                            </div>
                            <bold class="text-danger" id="errors-to" style="display: none;"></bold>
                        </div>    

                        <div class="col-md-1">
                            <label for="to">عرض</label>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block" style="height: 30px;padding: 0 20px !important;">عرض</button>
                            </div>
                            <bold class="text-danger" id="errors-to" style="display: none;"></bold>
                        </div>    
                        
                        <div class="col-md-1">
                            <label for="to">طباعة</label>
                            <div>
                                <a id="print_report" class="btn btn-dark-gradient btn-block" style="height: 30px;padding: 4px 20px !important;margin: 0 5px;color: #fff;">
                                    طباعة                                    
                                </a>
                            </div>
                            <bold class="text-danger" id="errors-to" style="display: none;"></bold>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

