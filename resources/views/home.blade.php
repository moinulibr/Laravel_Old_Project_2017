@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
<!----for title---->
    @push('title')
        Business Management ERP
    @endpush
<!----for title---->
<!--@@@@@@@@@@@@-->
<!----custom css link here----->
   @push('css')

   <!-- Full Calender CSS -->
   <link rel="stylesheet" href="{{asset('links')}}/css/fullcalendar.min.css">
   <!-- Animate CSS -->
   <link rel="stylesheet" href="{{asset('links')}}/css/animate.min.css">
   <!-- Select 2 CSS -->
   <link rel="stylesheet" href="{{asset('links')}}/css/select2.min.css">
   <!-- Date Picker CSS -->
   <link rel="stylesheet" href="{{asset('links')}}/css/datepicker.min.css">
   <!-- Data Table CSS -->
   <link rel="stylesheet" href="{{asset('links')}}/css/jquery.dataTables.min.css">
   <!-- SummerNote CSS -->
   <link rel="stylesheet" href="{{asset('links')}}/css/summernote-bs4.html">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="{{asset('links')}}/css/invoice.css">      

   
    <!-- Modernize js -->
    <script src="{{asset('links')}}/js/modernizr-3.6.0.min.js"></script>
    <!-- Google Donut Chart JS-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Google Donut Chart JS-->
    <script src="{{asset('links')}}/js/google-donut-chart.js"></script>
    <script src="{{asset('links')}}/js/google-3d-pie-chart.js"></script>
    <script src="{{asset('links')}}/js/google-curving-yearly-chart.js"></script>
    <script src="{{asset('links')}}/js/google-curving-monthly-chart.js"></script>
    <script src="{{asset('links')}}/js/google-combo-monthly-chart.js"></script>
    <script src="{{asset('links')}}/js/google-combo-yearly-chart.js"></script> 
   @endpush
<!----custom css link here----->
<!--- push some things from here--->
<!---#############################################-->


<!---#############################################-->
<!-- Breadcubs Area Start Here -->
    <!------top page ,page identify------->
    @section('page_identify')
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <h3>Admin Dashboard</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Admin</li>
                    <li>
                        <a href="../dashboard/index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endsection
    <!------top page ,page identify------->
    <!-- Breadcubs Area End Here -->
<!---#############################################-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
  


@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif



<!--#*********************************************************Start Page content here*****************************************************************#-->
<!-- Dashboard summery Start Here -->
<div class="row gutters-20">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="dashboard-summery-one mg-b-20">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="item-icon bg-light-green ">
                        <i class="fas fa-street-view text-green"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="item-content">
                        <div class="item-title">Clients</div>
                        <div class="item-number"><span class="counter" data-num="150000">1,50,000</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="dashboard-summery-one mg-b-20">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="item-icon bg-light-blue">
                        <i class="fas fa-user-tie text-blue"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="item-content">
                        <div class="item-title">Employee</div>
                        <div class="item-number"><span class="counter" data-num="2250">2,250</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="dashboard-summery-one mg-b-20">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="item-icon bg-light-yellow">
                        <i class="fas fa-shopping-bag text-orange"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="item-content">
                        <div class="item-title">Order</div>
                        <div class="item-number"><span class="counter" data-num="5690">5,690</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="dashboard-summery-one mg-b-20">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="item-icon bg-light-red">
                        <i class="fas fa-file-invoice-dollar text-red"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="item-content">
                        <div class="item-title">Invoice</div>
                        <div class="item-number"><span class="counter" data-num="193000">3,000</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard summery End Here -->

<!-- Dashboard Content Start Here -->
<div class="row gutters-20">
    <div class="col-lg-7 col-xl-7 col-7-xxxl">
        <!-- Teacher Table Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Summary (Including Tax)</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Income</th>
                                <th>Expense</th>
                                <th>Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>All Time</td>
                                <td>৳ 17,691,936.00</td>
                                <td>৳ 16,076,013.00</td>
                                <td>৳ 1,615,923.00</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td>৳ 5,817,000.00</td>
                                <td>৳ 4,763,190.00</td>
                                <td>৳ 1,053,810.00</td>
                            </tr>
                            <tr>
                                <td>This Month</td>
                                <td>৳ 200,000.00</td>
                                <td>৳ 137,500.00</td>
                                <td>৳ 62,500.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-xl-5 col-5-xxxl">
        <!-- Teacher Table Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Accounts Summary</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table display text-nowrap">
                        <tbody>
                            <tr>
                                <td>Cash</td>
                                <td>৳ 17,691,936.00</td>
                            </tr>
                            <tr>
                                <td>Cash at Bank</td>
                                <td>৳ 5,817,000.00</td>
                            </tr>
                            <tr>
                                <td>Loan</td>
                                <td>৳ 200,000.00</td>
                            </tr>
                            <tr>
                                <td>Total Balance</td>
                                <td>৳ 17,691,936.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="col-12 col-xl-12 col-12-xxxl">
        <div class="card dashboard-card-one pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Summary of Income & Expense</h5>
                    </div>
                </div>
                <div class="earning-report">
                    <!--div class="item-content">
                        <div class="single-item pseudo-bg-blue">
                            <h4>Income</h4>
                            <span>75,000</span>
                        </div>
                        <div class="single-item pseudo-bg-red">
                            <h4>Expenses</h4>
                            <span>15,000</span>
                        </div>
                    </div-->
                    <div class="dropdown">
                        <a class="date-dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">This Year</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">This Year</a>
                            <a class="dropdown-item" href="#">Last Year</a>
                            <a class="dropdown-item" href="#">This Month</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                        </div>
                    </div>
                    <div class="text-right">
                    <p class="accountingyear_traverse">
                        <a data-year="2018" data-busy="0" data-type="prev" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Prev</a>
                        <a data-year="2020" data-busy="0" data-type="next" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Next</a>
                    </p>
                </div>
                </div> 
                <!-- Tab Area Start Here -->
                <div class="earning-chart-wrap">
                    <div id="curve_month_chart" style="width: 100%; height: 100%;"></div>
                </div>
                <!--div class="earning-chart-wrap">
                    <div id="curve_year_chart" style="width: 100%; height: 100%;"></div>
                </div>
                <div class="earning-chart-wrap">
                    <div id="curve_chart" style="width: 100%; height: 100%;"></div>
                    <canvas id="earning-line-chart" width="660" height="300"></canvas>
                </div-->
            </div>
        </div>
    </div> 




    <div class="col-12 col-xl-12 col-12-xxxl">
        <div class="card dashboard-card-one pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Summary of Income & Expense</h5>
                    </div>
                </div>
                <div class="earning-report">
                    <div class="dropdown">
                        <a class="date-dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">This Year</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">This Year</a>
                            <a class="dropdown-item" href="#">Last Year</a>
                            <a class="dropdown-item" href="#">This Month</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                        </div>
                    </div>
                    <div class="text-right">
                    <p class="accountingyear_traverse">
                        <a data-year="2018" data-busy="0" data-type="prev" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Prev</a>
                        <a data-year="2020" data-busy="0" data-type="next" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Next</a>
                    </p>
                </div>
                </div> 
                <!-- Tab Area Start Here -->
                <div class="earning-chart-wrap">
                   <canvas id="bar_chart"  style="width: 100%; height: 100%;"></canvas>
                </div>
                <!--div class="earning-chart-wrap">
                    <div id="curve_year_chart" style="width: 100%; height: 100%;"></div>
                </div>
                <div class="earning-chart-wrap">
                    <div id="curve_chart" style="width: 100%; height: 100%;"></div>
                    <canvas id="earning-line-chart" width="660" height="300"></canvas>
                </div-->
            </div>
        </div>
    </div>

   
     
    <div class="col-12 col-xl-12 col-12-xxxl">
        <div class="card dashboard-card-three pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Quick Summary of Income and Expense by Category : Feb 2020</h3>
                    </div>
                </div>
                <div class="text-right">
                    <p class="accountingyear_traverse">
                        <a data-year="2018" data-busy="0" data-type="prev" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Prev</a>
                        <a data-year="2020" data-busy="0" data-type="next" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Next</a>
                    </p>
                </div>
                <div class="col-12 col-xl-12 col-12-xxxl">
                    <div class="doughnut-chart-wrap">
                        <div id="piechart_3d" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-12 col-12-xxxl">
                    <div class="doughnut-chart-wrap">
                        <div id="donutchart" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-12 col-12-xxxl">
        <div class="card dashboard-card-one pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Summary of Transaction : Feb 2020</h5>
                    </div>
                </div>
                <div class="earning-report">
                    <!--div class="item-content">
                        <div class="single-item pseudo-bg-green">
                            <h4>Income</h4>
                            <span>75,000</span>
                        </div>
                        <div class="single-item pseudo-bg-red">
                            <h4>Expenses</h4>
                            <span>15,000</span>
                        </div>
                    </div-->
                    <div class="dropdown">
                        <a class="date-dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">This Year</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">This Year</a>
                            <a class="dropdown-item" href="#">Last Year</a>
                            <a class="dropdown-item" href="#">This Month</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="accountingyear_traverse">
                            <a data-year="2019" data-busy="0" data-type="prev" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Prev</a>
                            <a data-year="2020" data-busy="0" data-type="next" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Next</a>
                        </p>
                    </div>
                </div>
                <!-- Tab Area Start Here ->
                <div class="earning-chart-wrap">
                    <div id="chart_month" style="width: 100%; height: 100%;"></div>
                </div-->
                <div class="earning-chart-wrap">
                    <div id="chart_year" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    
    <div class="col-lg-12 col-xl-12 col-12-xxxl">
        <!-- Teacher Table Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Current Month Latest Income</h3>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-11-xxxl col-xl-10 col-lg-9 col-12 form-group">
                            <input type="text" placeholder="Search by Account ..." class="form-control">
                        </div>
                        <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                            <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Account</th>
                                <th>Tax</th>
                                <th>Final Amount</th>
                                <th>Invoice</th>
                                <th>Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#01</td>
                                <td>Masum Enterprise</td>
                                <td>৳1,000.00</td>
                                <td>Pubali Bank</td>
                                <td>MARUF ENTERPRISE</td>
                                <td>৳100.00</td>
                                <td>৳1,100.00</td>
                                <td>120487</td>
                                <td>Milon Feni(2020-02-08 12:00:00)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    
    <div class="col-lg-12 col-xl-12 col-12-xxxl">
        <!-- Teacher Table Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Current Month Latest Expense</h3>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-11-xxxl col-xl-10 col-lg-9 col-12 form-group">
                            <input type="text" placeholder="Search by Account ..." class="form-control">
                        </div>
                        <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                            <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Account</th>
                                <th>Tax</th>
                                <th>Final Amount</th>
                                <th>Invoice</th>
                                <th>Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#01</td>
                                <td>Masum Enterprise</td>
                                <td>৳1,000.00</td>
                                <td>Office expenses</td>
                                <td>MARUF ENTERPRISE</td>
                                <td>৳100.00</td>
                                <td>৳1,100.00</td>
                                <td>125487</td>
                                <td>Milon Feni(2020-02-08 12:00:00)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    
</div> 
 <!-- Dashboard Content Start Here -->
<!--#*********************************************************End Page content here*****************************************************************#-->







<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--- push some things from here--->
<!----custom js link here----->
@push('js')
{{-- 
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
--}}


 <script src="{{ asset('links') }}/js/Chart.bundle.js"></script>
    <script>
        $(function () {
            new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
        });
        function getChartJs(type) {
            var config = null;

            if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: {!! $months !!},
                        datasets: [{
                            label: "Total Amount ",
                            data: {!! $month_data !!},
                            backgroundColor: 'rgba(244, 67, 54, 0.8)'
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }
            return config;
        }
    </script>


@endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
