
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

