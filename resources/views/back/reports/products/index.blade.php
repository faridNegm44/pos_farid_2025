
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
                        alertify.success("تمت جلب الأصناف المتعلقة بالمخزن بنجاح");
    
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
    
@endsection






@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header text-danger" style="display: block !important;text-align: center;margin-bottom: 15px;">
            <h4 class="content-title mb-5 my-auto">{{ $pageNameAr }}</h4>
        </div>
        <!-- breadcrumb -->


        <div class="card bg bg-warning-gradient" style="padding: 20px 0 !important;">
            <div class="card-body">
                <form method="post" action="{{ url('products/report/result') }}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <label for="store_id">المخازن</label>
                            <div>
                                <select  name="store_id" class="store_id selectize" id="store_id">
                                    <option value="" selected>اختر مخزن</option>                              
                                    @foreach ($stores as $store)
                                      <option value="{{ $store->id }}">{{ $store->id }} - {{ $store->name }}</option>                              
                                    @endforeach
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-store_id" style="display: none;"></bold>
                        </div>    
                        
                        <div class="col-md-3">
                            <label for="products">الأصناف</label>
                            <div>
                                <select  name="products" class="products selectize" id="products">
                                    <option value="" selected>اختر صنف</option>                                    
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-products" style="display: none;"></bold>
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
                                <a target="_blank" href="{{ url('/products/report/result/pdf') }}" type="submit" class="btn btn-dark-gradient btn-block" style="height: 30px;padding: 4px 20px !important;margin: 0 5px;">
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

