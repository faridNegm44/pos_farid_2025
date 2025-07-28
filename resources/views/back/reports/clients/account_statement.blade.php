
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
            dateFormat: "Y-m-d h:i:S K", 
            time_24hr: false
        });
    </script>

    
    
    
    {{-- start when click to button #account_statement كشف حساب--}}
    <script>
        $(document).on('click', '#account_statement', function(e) {
            e.preventDefault();

            const clientVal = $('#client_id').val();
            if(!clientVal){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 4);
                alertify.error('⚠️ من فضلك اختر عميل أولاً قبل محاولة إخراج كشف الحساب 📄');

            }else{
                $("form").find('input[name="_token"]').remove();
                let formData = $("form").serialize();
                let printUrl = "{{ url('clients/report/account_statement/pdf') }}?" + formData;
    
                window.open(printUrl);
            }
        });
    </script>
    {{-- end when click to button #account_statement كشف حساب --}}

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
                <form>
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <label for="client_id">العملاء</label>
                            <div>
                                <select  name="client_id" class="client_id selectize" id="client_id">
                                    <option value="" selected>العملاء</option>                              
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">
                                            {{ $client->id }} - {{ $client->name }} {{ $client->phone ? '- '.$client->phone : '' }}
                                        </option>                              
                                    @endforeach
                                  </select>
                            </div>
                            <bold class="text-danger" id="errors-client_id" style="display: none;"></bold>
                        </div>    
                        
                        <div class="col-md-2">
                            <label for="treasury_type">أنواع الأذونات</label>
                            <div>
                                <select  name="treasury_type" class="treasury_type selectize" id="treasury_type">
                                    <option value="" selected>أنواع الأذونات</option>                              
                                    <option value="رصيد اول عميل">رصيد اول مدة</option>                                                                 
                                    <option value="اذن توريد نقدية">اذن توريد نقدية</option>                              
                                    <option value="اذن صرف نقدية">اذن صرف نقدية</option>                              
                                    <option value="اضافة فاتورة مبيعات">اضافة فاتورة مبيعات</option>                                                                 
                                    <option value="مرتجع فاتورة مبيعات">مرتجع فاتورة مبيعات</option>                                                                 
                                    <option value="تسوية رصيد للجهة">تسوية رصيد للجهة</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-treasury_type" style="display: none;"></bold>
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
                            
                        <div class="col-md-2">
                            <label for="to">كشف حساب</label>
                            <div>
                                <a id="account_statement" target="_blank" class="btn btn-primary btn-block" style="height: 30px;padding: 4px 20px !important;margin: 0 5px;color: #fff;">
                                    كشف حساب                                    
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

