
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
            enableTime: true,
            //enableSeconds: true,
            time_24hr: false,
            dateFormat: "d-m-Y       h:i K"
        });
    </script>

    
    {{-- start when click to button #print_report --}}
    <script>
        $('#print_report').on('click', function (e) {
            const from = $('#from').val();
            const to = $('#to').val();

            if(!from || !to){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 4);
                alertify.error('⚠️ حدد تاريخ البداية 📅 والنهاية قبل عرض التقرير 📄');

                return false;
            }else{
                e.preventDefault();
                let formData = $("form").serialize();
                let printUrl = "{{ url('report/profits/result/pdf') }}?" + formData;

                window.open(printUrl);
            }
        });
    </script>
    {{-- end when click to button #print_report --}}

@endsection


@section('content')
    <div style="padding: 10px;">
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
                <form method="get" action="">
                    @csrf
                    <div class="row justify-content-center">                        
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
                            <label for="to">تقرير الربحية</label>
                            <div>
                                <a id="print_report" target="_blank" class="btn btn-dark-gradient btn-block" style="height: 30px;padding: 4px 20px !important;margin: 0 5px;color: #fff;">
                                    تقرير الربحية                                    
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

