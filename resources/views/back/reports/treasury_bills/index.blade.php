
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')

@endsection

@section('footer')  
    <script>       
        // open modal when click button (insert)
        document.addEventListener('keydown', function(event){
            if( event.which === 45 ){
                $('.modal').modal('show');
                document.querySelector('.modal .modal-header .modal-title').innerText = 'إضافة';
                document.querySelector('.modal .modal-footer #save').setAttribute('style', 'display: inline;');
                document.querySelector('.modal .modal-footer #update').setAttribute('style', 'display: none;');
                $('.dataInput').val('');
            }
        });



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

        // selectize
        $('.selectize').selectize({
            hideSelected: true
        });
    </script>

    <script>
        flatpickr(".datePicker", {
            yearSelectorType: 'dropdown',
            enableTime: false,
            dateFormat: "Y-m-d",
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
                <form method="post" action="{{ url('reports/treasury_bills/result') }}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                            <label for="treasury_id">الخزن المالية</label>
                            <div>
                                <select  name="treasury_id" class="treasury_id selectize" id="treasury_id">
                                    <option value="" selected>الخزن المالية</option>                              
                                    @foreach ($treasuries as $treasury)
                                      <option value="{{ $treasury->id }}">{{ $treasury->name }}</option>                              
                                    @endforeach
                                  </select>
                            </div>
                            <bold class="text-danger" id="errors-treasury_id" style="display: none;"></bold>
                        </div>    
                        
                        <div class="col-md-2">
                            <label for="treasury_type">أنواع الأذونات</label>
                            <div>
                                <select  name="treasury_type" class="treasury_type selectize" id="treasury_type">
                                    <option value="" selected>أنواع الأذونات</option>                              
                                    <option value="اذن توريد نقدية">اذن توريد نقدية</option>                              
                                    <option value="اذن صرف نقدية">اذن صرف نقدية</option>                              
                                    <option value="رصيد اول خزنة">رصيد اول خزنة</option>                              
                                    <option value="مصروف">مصروف</option>                              
                                    <option value="تحويل">تحويل</option>                              
                                   
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
                                <a target="_blank" href="{{ url('reports/treasury_bills/result/pdf') }}" type="submit" class="btn btn-dark-gradient btn-block" style="height: 30px;padding: 6px 20px !important;margin: 0 5px;">
                                    طباعة <i class="mdi mdi-file-pdf"></i>                                    
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

