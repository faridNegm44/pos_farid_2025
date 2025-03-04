
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    {{-- sweetalert --}}
    <link href="{{ url('back') }}/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
    {{-- fileupload --}}
    <link href="{{ asset('back/assets/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- spotlight --}}
    <link href="{{ asset('back/assets/spotlight.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .pd-sm-40 {
            padding: 40px 40px 0 !important;
        }
    </style>
@endsection

@section('footer')  
    <script src="{{ url('back') }}/assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>
    <script src="{{ url('back') }}/assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="{{ url('back') }}/assets/js/sweet-alert.js"></script>

    {{--  <!-- spotlight -->  --}}
    <script src="{{ asset('back/assets/spotlight.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/spotlight.min.js') }}"></script>

    <!-- fileupload -->
    <script src="{{ asset('back/assets/file-upload-with-preview.min.js') }}"></script>
    <script> new FileUploadWithPreview('file_upload') </script>

    <script>       
        $(document).ready(function () {
            // selectize
            $('selectize').selectize();
            

            // show password or hide
            $('.show_pass').click(function(){
                const password = $("#password");
                const confirmed_password = $("#confirmed_password");

                if(password.attr('type') == 'password' || confirmed_password.attr('type') == 'password'){
                    password.attr('type', 'text');
                    confirmed_password.attr('type', 'text');
                    $('i.fa.fa-eye').removeClass('fa fa-eye').addClass('fa fa-eye-slash');

                }else if(password.attr('type') == 'text' || confirmed_password.attr('type') == 'text'){
                    password.attr('type', 'password');
                    confirmed_password.attr('type', 'password');
                    $('i.fa.fa-eye-slash').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                }
            });


            // DataTable
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'gender', name: 'gender'},
                    {data: 'phone', name: 'phone'},
                    {data: 'role', name: 'role'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "bDestroy": true,
                language: {
                    sUrl: '{{ asset("back/assets/js/ar_dt.json") }}',
                },
            });
        });

    </script>




    {{-- add, edit, delete => script --}}
    @include('back.users.add')
    @include('back.users.edit')
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

        @include('back.users.form')

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">الصورة</th>
                                        <th class="wd-15p border-bottom-0" style="width: 20%;">الإسم</th>
                                        <th class="wd-20p border-bottom-0" style="width: 20%;">الإيميل</th>
                                        <th class="wd-20p border-bottom-0">النوع</th>
                                        <th class="wd-15p border-bottom-0">موبايل</th>
                                        <th class="wd-15p border-bottom-0">التراخيص</th>
                                        <th class="wd-10p border-bottom-0">نشط</th>
                                        <th class="wd-25p border-bottom-0">التحكم</th>
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

