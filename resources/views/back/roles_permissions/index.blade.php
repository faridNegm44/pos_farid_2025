@extends('back.layouts.app')

@section('title')
    الأذونات والتراخيص
@endsection

@section('header')
    <link href="{{ url('back') }}/assets/css/semantic.min.css" rel="stylesheet" type="text/css" />
    {{-- dataTables --}}
	<link href="{{ url('back') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.f0" rel="stylesheet" type="text/css" />
    <link href="{{ url('back') }}/assets/libs/datatables.net-buttons-bs4/c/buttons.bootstrap4.min" rel="stylesheet" type="text/css" />
	<link href="{{ url('back') }}/assets/libs/datatables.net-responsive-bs/responsive.bootstrap4.m" rel="stylesheet" type="text/css" />
@endsection

@section('footer')
    {{-- Datatable --}}
	<script src="{{ url('back') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="{{ url('back') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.f3.d"></script>
	<!-- Buttons examples -->
	<script src="{{ url('back') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.14e"></script>
	<script src="{{ url('back') }}/assets/libs/datatables.net-buttons-bs4/j/buttons.bootstrap4.min"></script>
	<script src="{{ url('back') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.153.dela"></script>
	<script src="{{ url('back') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.154.dela"></script>
	<script src="{{ url('back') }}/assets/libs/datatables.net-buttons/js/buttons.colVis.min.155.del"></script>

    <script>
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
            ajax: "{{ url('admin/roles_permissions/datatable_roles_permissions') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'role_name', name: 'role_name'},
                {data: 'action', name: 'action'},
            ],
        });
    </script>


    @include('back.roles_permissions.delete')

@endsection

@section('content')

    <div class="main-content">

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"></h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h4 class="text-center" style="margin: 100px auto;">@lang('app.loading') ...</h4>
            </div>
        </div>


        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">الأذونات والتراخيص</h4>
                        </div>
                    </div>
                </div>

                <div class="card">
                    @if (auth()->user()->role_relation->permissions_view === 1 )
                        <div class="card-body">

                            <h4 class="card-title" style="margin-bottom: 30px;">
                                <span style="position: relative;top: -7px;">
                                    <a type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2" href="{{ url('admin/roles_permissions/create') }}">
                                        <i class="mdi mdi-plus me-1"></i>
                                        @lang('app.add')
                                    </a>
                                </span>
                            </h4>

                            <table id="datatable" class="table table-hover dt-responsive nowrap w-100 table-striped table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>@lang('action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @else
                        <h4 class="text-center" style="margin: 100px auto;">
                            لاتمتلك الصلاحيات لرؤيه محتوي الصفحة
                            <img src="{{ url('back/images/rej2.png') }}" style="width: 80px;height: 78px;position: relative;bottom: 7px;bo"/>
                        </h4>
                    @endif    
                </div>

            </div>
        </div>


        {{-- Include Footer --}}
        @include('back.layouts.footer')
    </div>
@endsection
