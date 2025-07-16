
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
            dateFormat: "Y-m-d h:i:S K", 
            time_24hr: false
        });
    </script>


    {{-- start when click to button #print_report --}}
    <script>
        $(document).on('click', '#print_report', function(e) {
            e.preventDefault();
            let formData = $("form").serialize();
            let printUrl = "{{ url('clients/report/clients_debt/result/pdf') }}?" + formData;

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
        
        <div class="card bg bg-warning-gradient" style="padding: 20px 0 !important;">
            <div class="card-body">
                <form method="get" action="{{ url('suppliers/report/suppliers_debt/result') }}">
                    @csrf
                    <div class="row justify-content-center">
                        
                        <div class="col-md-2">
                            <label for="balance_type">نوع الرصيد</label>
                            <div>
                                <select name="balance_type" id="balance_type" class="form-control">
                                    <option value="creditor">🟥 لهم فلوس (دائنين)</option>
                                    <option value="debtor">🟩 عليهم فلوس (مدينين)</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-balance_type" style="display: none;"></bold>
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
                            <label for="to">عرض التقرير</label>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block" style="height: 30px;padding: 0 20px !important;">عرض التقرير 🔍</button>
                            </div>
                            <bold class="text-danger" id="errors-to" style="display: none;"></bold>
                        </div>    
                        
                        {{--<div class="col-md-1">
                            <label for="to">طباعة</label>
                            <div>
                                <a id="print_report" target="_blank" class="btn btn-dark-gradient btn-block" style="height: 30px;padding: 4px 20px !important;margin: 0 5px;color: #fff;">
                                    طباعة                                    
                                </a>
                            </div>
                            <bold class="text-danger" id="errors-to" style="display: none;"></bold>
                        </div>    --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

