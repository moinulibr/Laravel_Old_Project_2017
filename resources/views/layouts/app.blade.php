<!doctype html>
<html class="no-js" lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  
    <!----for title---->
    <title>
        EBUSi &#187; @stack('title')
    </title>
    <!----for title---->

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('links')}}/img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('links')}}/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('links')}}/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('links')}}/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('links')}}/css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('links')}}/fonts/flaticon.css">

    <link rel="stylesheet" href="{{asset('links')}}/style.css">
    
   <!----custom css link here----->
    @stack('css')
   <!----custom css link here----->
</head>
<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->

    <div id="wrapper" class="wrapper bg-ash">

       <!-- Header Menu Area Start Here -->
        @include('layouts.partials.header')
        <!-- Header Menu Area End Here -->
		

        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">


            <!-- Sidebar Area Start Here -->
            @include('layouts.partials.sidebar')
            <!-- Sidebar Area End Here -->
            
            

            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                <!------top page,page identify------->
                        @yield('page_identify')
                <!------top page,page identify------->
                </div>
                <!-- Breadcubs Area End Here --->
               
            <!------------For home page ------------->
                @yield('content')
            <!------------For home page ------------->

            </div><!-- Dashboard Content One End Here (Every Page)-->
            
    </div><!-- Page Area End Here (Side Bar)-->

            <!-- Footer Area Start Here -->
            @include('layouts.partials.footer')
            <!-- Footer Area End Here -->


</div><!-- wrapper End Here (Top Bar)-->




  

<!-- jquery-->
<script src="{{asset('links')}}/js/jquery-3.3.1.min.js"></script>
<!-- Plugins js -->
<script src="{{asset('links')}}/js/plugins.js"></script>
<!-- Popper js -->
<script src="{{asset('links')}}/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="{{asset('links')}}/js/bootstrap.min.js"></script>
<!-- Counterup Js -->
<script src="{{asset('links')}}/js/jquery.counterup.min.js"></script>
<!-- Moment Js -->
<script src="{{asset('links')}}/js/moment.min.js"></script>
<!-- Waypoints Js -->
<script src="{{asset('links')}}/js/jquery.waypoints.min.js"></script>
<!-- Scroll Up Js -->
<script src="{{asset('links')}}/js/jquery.scrollUp.min.js"></script>
<!-- Full Calender Js -->
<script src="{{asset('links')}}/js/fullcalendar.min.js"></script>
<!-- Chart Js -->
<script src="{{asset('links')}}/js/Chart.min.js"></script>
<!-- Select 2 Js -->
<script src="{{asset('links')}}/js/select2.min.js"></script>
<!-- Date Picker Js -->
<script src="{{asset('links')}}/js/datepicker.min.js"></script>
<!-- Data Table Js -->
<script src="{{asset('links')}}/js/jquery.dataTables.min.js"></script>
<!-- Smoothscroll Js -->
<script src="{{asset('links')}}/js/jquery.smoothscroll.min.html"></script>
<!-- SummerNote Js -->
<script src="{{asset('links')}}/js/summernote-bs4.min.html"></script>
<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>
<!-- Map Init js -->
<script src="{{asset('links')}}/js/google-marker-map.js"></script>
<!-- Custom Js -->
<script src="{{asset('links')}}/js/main.js"></script>
<!-- Google Donut Chart JS-->
 <script src="{{asset('links')}}/js/google-donut-chart.js"></script>

@stack('js')
<style>
  .active{
        background-color:#051f3e;
        color:#ffc107 !important;
    }

   .sub-group-menu.menu-open {
        display:block!important;
   }
</style>
<script>

    $(document).ready(function(){
       
             // get current url
            var location = window.location.href;
            // remove active class from all
            $(".nav-sidebar-menu .nav-item").removeClass('active');
            $(".nav-sidebar-menu .nav-item .nav-link").removeClass('active');
            $(".nav-sidebar-menu .sub-group-menu").removeClass('active');
            // add active class to div that matches active url
            let match_url = $(".nav-sidebar-menu .nav-item a[href='"+location+"']");

            if (match_url.length) {
                $(match_url).removeClass('active').addClass('active');
                $(match_url).parents('.sidebar-nav-item').removeClass('active').addClass('active');
                $(match_url).parents('.sub-group-menu').removeClass('menu-open').addClass('menu-open');
                $(match_url).parents('.sub-group-menu').children('.nav-link').removeClass('active').addClass('active');  
            }
       
    });

</script>
</body>
</html>




                    