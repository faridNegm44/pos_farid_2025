
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    {{-- sweetalert --}}
    <link href="{{ url('back') }}/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
    {{-- fileupload --}}
    <link href="{{ asset('back/assets/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        input[type="radio"] {
            width: 18px;
            height: 18px;
            position: relative;
            top: 4px;
            left: 3px;
        }

        @media (min-width: 700px) {
            .modal-xl {
                max-width: 95%;
            }
        }
        .ajs-warning, .ajs-error{
            width: 600px !important;
            max-width: 600px !important;
            min-width: 600px !important;
        }

    </style>
@endsection

@section('footer')  
    <script src="{{ url('back') }}/assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>
    <script src="{{ url('back') }}/assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="{{ url('back') }}/assets/js/sweet-alert.js"></script>
    <!-- fileupload -->
    <script src="{{ asset('back/assets/file-upload-with-preview.min.js') }}"></script>
    <script> new FileUploadWithPreview('file_upload') </script>


    @if (session()->has('notAuth'))
		<script>
			$(document).ready(function () {
				alertify.dialog('alert')
						.set({transition:'slide',message: `
							<div style="text-align: center;">
								<p style="color: #e67e22; font-size: 18px; margin-bottom: 10px;">
									صلاحية غير متوفرة 🔐⚠️
								</p>
								<p>{{ session()->get('notAuth') }}</p>
							</div>
						`, 'basic': true})
						.show();  

			});
		</script>
	@endif

    <script>
        // open modal when click button (insert)
        document.addEventListener('keydown', function(event){
            if( event.which === 45 ){
                $('#exampleModalCenter').modal('show');
                document.querySelector('#exampleModalCenter .modal-header .modal-title').innerText = 'إضافة';
                document.querySelector('#exampleModalCenter .modal-footer #save').setAttribute('style', 'display: inline;');
                document.querySelector('#exampleModalCenter .modal-footer #update').setAttribute('style', 'display: none;');
                $('.dataInput').val('');
            }
        });
    </script>
    
    <script>
        // start hide all data like #hide_cash when change type_patment to كاش
        $('#type_payment').on('input', function(){
            const thisVal = $(this).val();
            
            if(thisVal === 'كاش'){
                $('#hide_cash').hide();
                $('input[name="debit_limit"], input[name="money_on_him"], input[name="money_for_him"]').val('');
            }else if(thisVal === 'آجل'){
                $('#hide_cash').show();
            }
        });
        // end hide all data like #hide_cash when change type_patment to كاش


        // remove all errors and inputs data when close modal
        $('.modal').on('hidden.bs.modal', function(){
            $('form [id^=errors]').text('');
            $(this).find("input").not("[name='_token']").val('');
        });

        // start reset value to 0
        $("#money_on_him").on('input', function(){
            if($(this).val() !== ''){
                $('#money_for_him').val('');
            }
        });

        $("#money_for_him").on('input', function(){
            if($(this).val() !== ''){
                $('#money_on_him').val('');
            }
        });
        // end reset value to 0
    </script>

    <script>
        // when click on add button
        $(".add").on('click', function(){
            $("#debtor_value").css('display', 'block');
            $("#creditor_value").css('display', 'block');
            $('.dataInput').val('');

            document.querySelector("#image_preview_form").src = `{{ url('back/images/df_image.png') }}`;
            document.querySelector("#image_hidden").value = '';
        });        
    </script>


    <script>       
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'code', name: 'code'},
                    {data: 'action', name: 'action', orderable: false},
                    {data: 'status', name: 'status'},
                    {data: 'name', name: 'name'},
                    {data: 'type_name', name: 'type_name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'type_payment', name: 'type_payment'},
                    {data: 'address', name: 'address'},
                    {data: 'notes', name: 'notes'},
                    {data: 'created_at', name: 'created_at'},
                ],
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    { extend: 'excel', text: '📊 Excel', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'} },
                    { extend: 'print', text: '🖨️ طباعة', className: 'btn btn-outline-dark', exportOptions: { columns: ':visible'}, customize: function (win) { $(win.document.body).css('direction', 'rtl'); } },
                    { extend: 'colvis', text: '👁️ إظهار/إخفاء الأعمدة', className: 'btn btn-outline-dark' }
                ],
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "الكل"]],
                order: [[0, 'desc']],
                fixedColumns: {
                    leftColumns: 2
                }
            });


            // focus first input when open modal
            $('.modal').on('shown.bs.modal', function(){
                $('.dataInput:eq(0)').focus();                
            });
        });
    </script>

    {{-- add, edit, delete => script --}}
    @include('back.clients.add')
    @include('back.clients.edit')
    @include('back.clients.delete')
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

        @include('back.clients.form')

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">كود العميل</th>
                                <th class="border-bottom-0">التحكم</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0" style="width: 15%;max-width: 15%;">الإسم</th>
                                <th class="border-bottom-0">نوع العميل</th>
                                <th class="border-bottom-0">موبايل</th>
                                <th class="border-bottom-0">طريقة التعامل</th>
                                <th class="border-bottom-0" style="width: 10%;max-width: 10%;">العنوان</th>
                                <th class="border-bottom-0" style="width: 10%;max-width: 10%;">ملاحظات</th>
                                <th class="border-bottom-0" style="width: 15%;max-width: 15%;">تاريخ الإنشاء</th>
                                {{--<th class="border-bottom-0">افتتاحي دائن</th>
                                <th class="border-bottom-0">افتتاحي مدين</th>
                                <th class="border-bottom-0">أقصي قيمة للمسحوبات</th>--}}
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

