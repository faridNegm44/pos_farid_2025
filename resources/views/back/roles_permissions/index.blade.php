
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'role_name', name: 'role_name'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>
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
            {{--@if (userPermissions()->permissions_create == 1)--}}
                <div class="d-flex my-xl-auto right-content">
                    <div class="pr-1 mb-xl-0">
                        <a href="{{ url('roles_permissions/create') }}" class="btn btn-danger btn-icon ml-2 add"><i class="mdi mdi-plus"></i></a>
                    </div>
                </div>
            {{--@endif--}}
        </div>
        <!-- breadcrumb -->

        {{--@if (userPermissions()->permissions_view == 1)--}}
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0" >#</th>
                                            <th class="border-bottom-0" >الاسم</th>
                                            <th class="border-bottom-0">التحكم</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{--@endif--}}
    </div>
@endsection

