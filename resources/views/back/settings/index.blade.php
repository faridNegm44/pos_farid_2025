@extends('back.layouts.app')

@section('title')
   {{$pageNameAr}} 
@endsection

@section('header')
    <style>
        @media screen and (min-width: 481px) and (max-width: 768px) { 
            .main-content .offcanvas {
                width: 90%;
            }
        }
       @media (min-width: 768px) { /* Tablet */
            .main-content .offcanvas {
                width: 90%;
            }
        }
        @media (min-width: 992px){ /* Large Screen */
            .main-content .offcanvas {
                width: 80%;
            }
        }
    </style>
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
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title" style="margin-bottom: 30px;">
                            @lang('app.Settings')
                        </h4>

                        {{-- @if (auth()->user()->role_relation->settings_view == 1 ) --}}
                        {{-- table --}}
                        <div id="div_datatable">
                            <table id="datatable" class="table table-hover dt-responsive w-100 table-striped table-bordered text-center">
                                <thead class="table-light">                                
                                    <tr>
                                        <th>@lang('app.app_name')</th>
                                        <th>@lang('app.phone')</th>
                                        <th>@lang('app.address')</th>
                                        <th>لوجو البرنامج</th>
                                        <th>Fav Icon</th>
                                        <th>@lang('app.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>    
                        {{-- @else   
                            <h4 class="text-center" style="margin: 100px auto;">
                                لاتمتلك الصلاحيات لرؤيه محتوي الصفحة
                                <img src="{{ url('back/images/rej2.png') }}" style="width: 80px;height: 78px;position: relative;bottom: 7px;bo"/>
                            </h4>
                        @endif     --}}
                    </div>
                </div>
            </div>  
        </div>


        {{-- Include Footer --}}
        @include('back.layouts.footer')
    </div>
@endsection

@section('footer')
    <script>
        $(document).on('click', '.bt_modal', function (e) {
            e.preventDefault();
            let act = $(this).attr('act');
            $('.offcanvas-body').load(act);
        });
    </script>

    <script>
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url($pageNameEn.'/datatable_settings') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'address', name: 'address'},
                {data: 'logo', name: 'logo'},
                {data: 'fav_icon', name: 'fav_icon'},
                {data: 'action', name: 'action'},
            ],
            language: {
                sUrl: '{{ asset("back/assets/js/ar_dt.json") }}',
            }
        });
    </script>
@endsection
