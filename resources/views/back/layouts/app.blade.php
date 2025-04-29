<!doctype html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="dashboard, admin, bootstrap admin template, codeigniter, php, php framework, codeigniter 4, php mvc, php codeigniter, best php framework, codeigniter admin, codeigniter dashboard, admin panel template, bootstrap 4 admin template, bootstrap dashboard template"/>

        <!-- Title -->
        <title> {{ GeneralSettingsInfo()->app_name }}: @yield('title') </title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>

        <!-- Bootstrap css-->
        <link href="{{ asset('back') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- Icons css -->
        <link href="{{ asset('back') }}/assets/css-rtl/icons.css" rel="stylesheet">

        <!--  Right-sidemenu css -->
        <link href="{{ asset('back') }}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

        <!-- P-scroll bar css-->
        <link href="{{ asset('back') }}/assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

        <!-- Style css -->
        <link href="{{ asset('back') }}/assets/css-rtl/style.css" rel="stylesheet">
        <link href="{{ asset('back') }}/assets/css-rtl/style-dark.css" rel="stylesheet">

        <!-- Maps css -->
		<link href="{{ asset('back') }}/assets/plugins/jqvmap/jqvmap.min.css" rel="stylesheet">

        <!---Internal Owl Carousel css-->
		<link href="{{ url('back') }}/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">

		<!---Internal  Multislider css-->
		<link href="{{ url('back') }}/assets/plugins/multislider/multislider.css" rel="stylesheet">

        <!--- Select2 css --->
		<link href="{{ url('back') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

        <!-- Data table css -->
		<link href="{{ url('back') }}/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="{{ url('back') }}/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
		<link href="{{ url('back') }}/assets/plugins/datatable/css/responsive.bootstrap4.min.css" rel="stylesheet" />
		<link href="{{ url('back') }}/assets/plugins/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
		<link href="{{ url('back') }}/assets/plugins/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
		<link href="{{ url('back') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

        {{-- alertify --}}
        <link href="{{ asset('back/assets/css-rtl/alertify.rtl.min.css') }}" type="text/css" rel="stylesheet"/>
        <link href="{{ asset('back/assets/css-rtl/default.rtl.min.css') }}" type="text/css" rel="stylesheet"/>

        {{-- flatpickr --}}
        <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">        

        {{-- selectize --}}
        <link href="{{ asset('back/assets/selectize.css') }}" type="text/css" rel="stylesheet"/>

        @yield('header')

        <!-- Skinmodes css -->
        <link href="{{ asset('back') }}/assets/css-rtl/skin-modes.css" rel="stylesheet" />

        <!-- Animations css -->
        <link href="{{ asset('back') }}/assets/css-rtl/animate.css" rel="stylesheet">

        <!---Switcher css-->
        <link href="{{ asset('back') }}/assets/switcher/css/switcher-rtl.css" rel="stylesheet">
        <link href="{{ asset('back') }}/assets/switcher/demo.css" rel="stylesheet">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:slnt,wght@11,200..1000&family=Changa:wght@200..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">

        {{-- custom css --}}
        <link href="{{ asset('back') }}/assets/custom.css" rel="stylesheet">

        <style>
            @font-face {
                font-family: "4_F4";
                src: url("{{ asset('back/fonts/4_F4.ttf') }}");
            }
            body{
                /* font-family: Arial, Helvetica, sans-serif, serif; */
                font-family: "4_F4", serif;        
            }
            


            @media (max-width: 991px) {
               .horizontalMenucontainer .breadcrumb-header {
                    margin-top: 20px;
                    padding-top: 30px;
                }
            }
            .horizontalMenucontainer .side-header{
                background: #e0e7f8 !important;
                box-shadow: 0 6px 15px 1px #c0c0c7;
            }
        </style>
	</head>


<body class="main-body {{-- dark-theme --}}">

    <!-- Start Switcher -->
    {{--@include('back.layouts.switcher')--}}
    <!-- End Switcher -->

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('back') }}/assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->



    <!-- Page -->
    <div class="page">
        
        @include('back.layouts.header')
        @include('back.layouts.navbar')
        
        <!-- main-content opened -->
        <div class="main-content horizontal-content">
            <div id="overlay_page"></div>
            @yield('content')
            {{--@include('back.layouts.calc')--}}
        </div>

        @include('back.layouts.notification_sidebar')
        @include('back.layouts.footer')
    </div>


    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

    <!-- JQuery min js -->
    <script src="{{ asset('back') }}/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/bootstrap-rtl.js"></script>

    <!-- Ionicons js -->
    {{-- <script src="{{ asset('back') }}/assets/plugins/ionicons/ionicons.js"></script> --}}

    <!-- Moment js -->
    <script src="{{ asset('back') }}/assets/plugins/moment/moment.js"></script>

    <!-- P-scroll js -->
    <script src="{{ asset('back') }}/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/perfect-scrollbar/p-scroll-rtl.js"></script>

    <!-- eva-icons js -->
    <script src="{{ asset('back') }}/assets/js/eva-icons.min.js"></script>

    <!-- Rating js-->
    <script src="{{ asset('back') }}/assets/plugins/rating/jquery.rating-stars.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/rating/jquery.barrating.js"></script>

    <!-- Horizontalmenu js-->
    <script src="{{ asset('back') }}/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

    <!-- Sticky js -->
    <script src="{{ asset('back') }}/assets/js/sticky.js"></script>

    <!-- Right-sidebar js -->
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-rtl.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-custom.js"></script>


    <!--Internal  Chart.bundle js -->
    <script src="{{ asset('back') }}/assets/plugins/chart.js/Chart.bundle.min.js"></script>

    <!--Internal Sparkline js -->
    <script src="{{ asset('back') }}/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Raphael js -->
    <script src="{{ asset('back') }}/assets/plugins/raphael/raphael.min.js"></script>

    <!-- Internal Map -->
    <script src="{{ asset('back') }}/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <!--Internal  index js -->
    <script src="{{ asset('back') }}/assets/js/index.js"></script>
    <script src="{{ asset('back') }}/assets/js/jquery.vmap.sampledata.js"></script>

    <!--Internal  Datepicker js -->
    <script src="{{ url('back') }}/assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

    <!-- Internal Select2 js-->
    <script src="{{ url('back') }}/assets/plugins/select2/js/select2.min.js"></script>

    <!-- Internal Modal js-->
    <script src="{{ url('back') }}/assets/js/modal.js"></script>

    <!-- Data tables -->
    <script src="{{ url('back') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/dataTables.dataTables.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/responsive.dataTables.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/jquery.dataTables.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/pdfmake.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/vfs_fonts.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('back') }}/assets/plugins/datatable/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('back') }}/assets/js/table-data.js"></script>

    {{-- flatpickr --}}
    <script src="https://unpkg.com/flatpickr/dist/flatpickr.min.js"></script>

    <!-- alertify -->
    <script src="{{ asset('back/assets/js/alertify.min.js') }}"></script>

    {{-- general scripts file js --}}
    @include('back.layouts.general_scripts')

    {{-- bootstrap.bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <!-- selectize -->
    <script src="{{ asset('back/assets/selectize.min.js') }}"></script>

    @yield('footer')

    <!-- custom js -->
    <script src="{{ asset('back') }}/assets/js/custom.js"></script>
    
    <!-- Helper js -->
    <script src="{{ asset('back') }}/assets/helpers.js"></script>

    <!-- Switcher js -->
    <script src="{{ asset('back') }}/assets/switcher/js/switcher-rtl.js"></script>
</body>


</html>
