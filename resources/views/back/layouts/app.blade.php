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

        <style>
        @font-face {
            font-family: "4_F4";
            src: url("{{ asset('back/fonts/4_F4.ttf') }}");
        }
        body{
            /* font-family: Arial, Helvetica, sans-serif, serif; */
            font-family: "4_F4", serif;
            {{--  font-family: Rubik;  --}}
            {{--  font-weight: 100;    --}}
        }

        input::placeholder {
            font-size: 10px !important;
            position: relative;
            top: -2px;
        }

        table.dataTable tbody th, table.dataTable tbody td{
            padding: 5px 5px 1px !important;
        }

        .breadcrumb-header .content-title{
            font-size: 16px !important;
            font-weight: bold !important;
        }

        table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{
            font-size: 11px !important;
            font-weight: bold !important;
        }

        .modal form label {
            font-size: 12px !important;
            font-weight: bold;
        }

        .modal form .text-danger{
            font-size: 11px;
            font-weight: bold;
        }

        #image_preview_form{
            display: block;
            height: 200px;
            width: 70%;
            margin: 0px auto;
            margin-top: -50px;
            border-radius: 3px;
            border: 1px solid #d7d7d7;
        }

        @media (min-width: 768px) {
            #image_preview_form{
                height: 293px;
                display: block;
                width: 100%;
                margin-top: 66px;
                border-radius: 3px;
                border: 1px solid #d7d7d7;
            }
        }

        .hor-menu .horizontalMenu>.horizontalMenu-list>li>ul.sub-menu>li>a.active {
            background: #6a9ac6;
            color: #FFF;
            font-weight: bold !important;
            font-size: 14px;
        }

        .hor-menu .horizontalMenu>.horizontalMenu-list>li>a.active{
            background: #6a9ac6;
            color: #FFF !important;
            font-weight: bold !important;
            font-size: 14px;
        }

        .horizontalMenu>.horizontalMenu-list>li>ul.sub-menu>li>a:hover, .horizontalMenu>.horizontalMenu-list>li>ul.sub-menu>li>ul.sub-menu>li>a:hover{
            color: red;
            font-weight: bold !important;
        }

        .horizontalMenu>.horizontalMenu-list>li>a i{
            margin-right: 2px !important;
            font-size: 12px !important;
        }

        .horizontalMenu>.horizontalMenu-list>li>a{
            padding: 11px 11px 10px 11px;
        }
        .horizontalMenu>.horizontalMenu-list>li{
            font-size: 13px !important;
        }

        .horizontalMenu>.horizontalMenu-list>li .slide-item{
            font-size: 11px !important;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
        .alertify .ajs-body .ajs-content {
            padding: 16px 16px 16px 24px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }


        .form-control:disabled, .form-control[readonly] {
            border: 1px solid gray !important;
        }

        div.dataTables_wrapper div.dataTables_info{
            font-size: 12px;
            font-weight: bold;
            position: relative;
            top: 3px;
        }

        .modal-header{
            padding: 10px 20px 5px !important;
        }
        .modal-footer{
            padding: 5px 0px !important;
        }
        .right-content .add{
            padding: 0 !important;
            width: 30px !important;
            height: 25px !important;
        }
        /* ////////////////////////////////////////////  top css new css edit  ///////////////////////////////////////////////// */





        .require_input{
            font-size: 7px;
            position: absolute;
            left: 15px;
            top: 11px;
            color: red;
        }

        .breadcrumb-header {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 29px !important;
        }

        .dataTables_length{
            margin-left: 10px;
        }

        table .edit, table .delete, table .show, table .crm_info, table .print{
            padding: 1px 6px;
        }

        .ajs-button {
            border: 0px;
            font-weight: bold;
        }

        .ajs-cancel {
            background: rgb(209, 56, 56) !important;
            color: #fff !important;
        }

        .ajs-success{
            font-weight: bold;
            width: 320px !important;
            background: rgb(77, 124, 91) !important;
        }

        .ajs-error{
            font-weight: bold;
            width: 320px !important;
            background: rgb(155, 56, 64) !important;
        }

        .ajs-warning{
            font-weight: bold;
            width: 320px !important;
            background: orange !important;
        }

        .modal form label{
            margin-top: 10px !important;
        }
        .modal form input::placeholder{
            font-size: 12px;
        }

        .sub-icon{
            color: rgb(37, 37, 37) !important;
            font-weight: bold !important;
        }
        .slide-item{
            font-weight: bold !important;
        }

        .spinner_request, .spinner_request2{
            width: 1.4rem;
            height: 1.4rem;
            border-width: 0.2em;
            position: relative;
            bottom: 2px;
            right: 5px;
            display: none;
        }

        .alertify{
            z-index:999999 !important;
            display: block !important;
        }

        .alertify-notifier{
            z-index:999999 !important;
        }
        .horizontalMenu>.horizontalMenu-list>li>ul.sub-menu>li>a{
            padding: 2px 30px !important;
        }
        .main-header{
            height: 35px !important;
        }
        .main-profile-menu .profile-user img{
            margin-top: 3px !important;
            width: 27px !important;
            height: 27px !important;
        }
        @media only screen and (max-width: 991px) {
            .animated-arrow {
                top: -16px !important;
            }
        }

        .form-control{
            height: 30px !important;
            color: #000 !important; 
            padding: 0px 10px;
        }
        .selectize-input{
            height: 30px !important;
            padding: 5px 8px !important
        }
        .modal form label{
            margin-top: 6px !important;
            font-size: 10px !important;
            color: #222 !important;
        }
        .form-control::placeholder {
            transform: scale(0.9);
        }
        .horizontalMenu>.horizontalMenu-list>li>a{
            font-size: 11px !important;
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
            @yield('content')
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


    <!-- selectize -->
    <script src="{{ asset('back/assets/selectize.min.js') }}"></script>


    @yield('footer')

    <!-- custom js -->
    <script src="{{ asset('back') }}/assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="{{ asset('back') }}/assets/switcher/js/switcher-rtl.js"></script>
</body>


</html>
