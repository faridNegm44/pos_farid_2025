
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    {{-- fileupload --}}
    <link href="{{ asset('back/assets/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('footer')
    {{--  <!-- fileupload -->  --}}
    <script src="{{ asset('back/assets/file-upload-with-preview.min.js') }}"></script>
    <script> new FileUploadWithPreview('file_upload') </script>

    <script>       
        // cancel enter button 
        //$(document).keypress(function (e) {
        //    if(e.which == 13){
        //        e.preventDefault();  
        //    }
        //});





        $(document).on("click", "#checkAllBtn", function() {
            let allChecked = $(".table-checkbox:checked").length === $(".table-checkbox").length;

            if (allChecked) {
                // إلغاء تحديد الكل
                $(".table-checkbox").prop("checked", false);
                $(this).text("تحديد الكل");
            } else {
                // تحديد الكل
                $(".table-checkbox").prop("checked", true);
                $(this).text("إلغاء الكل");
            }
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("click", "#clearBtn", function() {
            let password = prompt("ادخل الرقم السري");

            if (password !== "@@##01012775704") {
                alert("الرقم السري غير صحيح");
                return;
            }

            let formData = $("#clearForm").serialize();

            $.ajax({
                url: `{{ url('/'.$pageNameEn) }}/clearTables`,
                method: "POST",
                data: formData,
                success: function(res) {
                    if (res.status === "success") {
                        alert(`${res.message}`);
                        location.reload(); 
                    } else {
                        $("#result").html('<span class="text-danger">'+res.message+'</span>');
                    }
                },
                error: function() {
                    $("#result").html('<span class="text-danger">حدث خطأ أثناء العملية</span>');
                }
            });
        });







        
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url('/settings/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'app_name', name: 'app_name', orderable: false},
                    {data: 'description', name: 'description', orderable: false},
                    {data: 'phone', name: 'phone', orderable: false},
                    {data: 'address', name: 'address', orderable: false},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
            });
        });
    </script>

    {{-- edit => script --}}
    @include('back.settings.edit')
@endsection




@section('content')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ $pageNameAr }}</h4>
                </div>
            </div>
        </div>

        @include('back.settings.form')


        @if ( auth()->user()->email === 'farid@gmail.com' )
            <div class="panel-group1" id="accordion11">
                <div class="panel panel-default  mb-4">
                    <div class="panel-heading1 bg-dark ">
                        <h4 class="panel-title1">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#collapseFour1" aria-expanded="false">
                                تفريغ قواعد البيانات
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour1" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="">
                        <div class="panel-body border">
                            <form id="clearForm">
                                @csrf
                                <button type="button" id="checkAllBtn" class="btn btn-sm btn-primary mb-3">تحديد الكل</button>

                                <div class="row">
                                    @php $tables = [
                                        'products', 
                                        'store_dets', 
                                        'clients_and_suppliers', 
                                        'partners', 
                                        'treasury_bill_dets', 
                                        'financial_treasuries', 
                                        'expenses', 

                                        'sale_bills',
                                        'purchase_bills', 
                                        
                                        'inventories', 
                                        'product_categoys', 
                                        'product_sub_categories', 
                                        'receipts', 
                                        'stores', 
                                        'companies', 
                                        'extra_expenses', 
                                        'taswea_client_supplier', 
                                        'taswea_partners', 
                                        'taswea_products', 
                                        'units'
                                    ]; 
                                    @endphp

                                    @foreach($tables as $table)
                                        <div class="col-lg-3 col-6">
                                            <label style="font-size: 14px !important; font-weight: 500;">
                                                <input type="checkbox" name="tables[]" value="{{ $table }}" class="table-checkbox" style="width: 20px; height: 20px; margin-right: 8px;">
                                                {{ $table }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" id="clearBtn" class="btn btn-dark mt-3" style="width: 100%;">تفريغ البيانات</button>
                            </form>
                            <div id="result" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-bottom-0" >إسم البرنامج</th>
                                        <th class="border-bottom-0" >الوصف</th>
                                        <th class="border-bottom-0" >التلفونات</th>
                                        <th class="border-bottom-0" >العنوان</th>
                                        <th class="border-bottom-0">التحكم</th>
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

