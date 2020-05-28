@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       Account Show
    @endpush
    <!----for title---->
<!--@@@@@@@@@@@@@-->
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
   @endpush
<!----custom css link here----->
<!--@@@@@@@@@@@@@-->
<!--- push some things from here--->
<!---#############################################-->


<!---#############################################-->
<!-- Breadcubs Area Start Here -->
    <!------top page ,page identify------->
    @section('page_identify')
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <h3>Account Show</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Admin</li>
                    @if(check_menu_button('accounts','view'))
                   <li>
                        <a href="{{route('admin.account.index')}}">Account View</a>
                    </li>
                    @endif
                    @if(check_menu_button('accounts','create'))
                    <li>
                        <a href="{{route('admin.account.create')}}">Account Create</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('home')}}">Home</a>
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
  






<!--===================================================================================================================================================-->
<!--#*********************************************************Start Page content here*****************************************************************#-->  
<!--===================================================================================================================================================-->
<!-- page content  Start Here -->

    <!-- Student Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h5>Account Details</h5>
                </div>
            </div>
            <div class="single-info-details">
                <!--div class="item-img">
                    <img src="../img/figure/student1.jpg" alt="student">
                </div-->
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">-</h3>
                        <div class="header-elements">
                            <ul>
                                @if(check_menu_button('accounts','edit'))
                                <li><a href="{{route('admin.account.edit',$account->id)}}"><i class="far fa-edit"></i></a></li>
                                @endif
                                @if(check_menu_button('accounts','print_all'))
                                <li><a href="{{ route('admin.account.print-all',$account->id) }}" class="btnPrint"><i class="fas fa-print"></i></a></li>
                                @endif
                                {{--<li><ahref="route('admin.account.download-all',$account->id)"><i class="fas fa-download"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <!--p>Aliquam erat volutpat. Curabiene natis massa sedde lacu stiquen sodale 
               word moun taiery.Aliquam erat volutpaturabiene natis massa sedde  sodale 
               word moun taiery.
            </p-->
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                {{-- 
                                <tr>
                                    <td>Account For :</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ $account->account_for_users->name }}
                                    </td>
                                </tr>
                                --}}
                                <tr>
                                    <td>Payment method/Account Type :</td>
                                    <td class="font-medium text-dark-medium">
                                        @if ($account->payment_method_id == 'mobile banking')
                                        <span style="color:green;">
                                            {{ ucfirst($account->mobile_payment_types->name) }}
                                        </span>
                                            @else
                                            {{ ucfirst($account->payment_methods->name) }}
                                        @endif
                                    </td>
                                </tr>

                                @if ($account->payment_method_id != 1)
                                <tr>
                                    <td>Account Name:</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ ucfirst($account->account_name) }}
                                    </td>
                                </tr>
                                <tr>
                                    <tr>
                                        <td>Account No :</td>
                                        <td class="font-medium text-dark-medium">
                                            {{ ucfirst($account->account_no) }}
                                        </td>
                                    </tr>
                                    <td>Bank Name :</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ ucfirst($account->bank_name) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bank Address :</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ ucfirst($account->bank_address) }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Opening Balance :</td>
                                    <td class="font-medium text-dark-medium">
                                        ৳ {{ $account->amount }}
                                    </td>
                                </tr>
                                <tr style="border-top: none; background-color:lawngreen;">
                                    <th>Available Balance :</th>
                                    <th class="font-medium text-dark-medium">
                                        ৳ 
                                        {{ number_format((float)($account->amount + $saleTotal + $incomeTotal) - ( $purchaseTotal+$expensTotal), 2, '.', '') }}
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table text-nowrap table-bordered" style="border-top: none; background-color:gainsboro;">
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <th style="text-align: center" colspan=6">Summary</th>
                            </tr>
                            <tr style="background-color:cyan;">
                                <th style="with:10%;">Total Sale</th>
                                <th> ৳
                                    {{ number_format((float)($saleTotal), 2, '.', '') }}
                                </th>
                                <th style="with:15%;">Others Income</th>
                                <th> ৳ 
                                    {{ number_format((float)($incomeTotal), 2, '.', '') }}
                                </th>
                                <th style="with:15%;">Total</th>
                                <th> ৳
                                    {{ number_format((float)($saleTotal + $incomeTotal), 2, '.', '') }}
                                </th>
                            </tr>
                            <tr style="background-color:gold;">
                                <th style="with:15%;">Total Purchase</th>
                                <th> ৳ 
                                    {{ number_format((float)($purchaseTotal), 2, '.', '') }}
                                </th>
                                <th style="with:15%;">Total Expense</th>
                                <th> ৳
                                    {{ number_format((float)($expensTotal), 2, '.', '') }}
                                </th>
                                <th style="with:10%;">Total</th>
                                <th> ৳
                                    {{ number_format((float)($expensTotal + $purchaseTotal), 2, '.', '') }}
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card height-auto mg-t-30"  id="toprintSale">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Details (Sale)</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Invoice No.</th>
                                <th>Date</th>
                                <th>Receive from</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saleDetails as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">#{{$loop->index +1}}</label>
                                    </div>
                                </td>
                                <td>{{ $item->order_no }}</td>
                                <td>
                                    @if ($item->client_id)
                                    {{ date('d/m/Y',strtotime($item->final_sales->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->client_id)
                                        {{ $item->final_sales->users->name }} <span style="color:green"></span>
                                        @else
                                        {{ $item->final_sales->users->name }} <span style="color:red"></span>
                                    @endif
                                </td>
                                <td>৳ 
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Income</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Sale</td>
                                <td>৳
                                    {{ number_format((float)($saleTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>


            <div class="card height-auto mg-t-30">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Income (Others)</h5>
                    </div>
                </div>
                <div class="table-responsive"  id="toprintDetails">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Reference No.</th>
                                <th>Date</th>
                                <th>Income Category</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomeDetails as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">#{{$loop->index +1}}</label>
                                    </div>
                                </td>
                                <td>{{ $item->reference_no }}</td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ date('d/m/Y',strtotime($item->final_expenses->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ $item->final_expenses->categories->name }}
                                    @endif
                                </td>
                                <td>৳ 
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Cash In</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Expense</td>
                                <td>৳
                                    {{ number_format((float)($incomeTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>


            <div class="card height-auto mg-t-30" >
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Details (Purchase)</h5>
                    </div>
                </div>
                <div class="table-responsive" id="toprint">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Reference No.</th>
                                <th>Date</th>
                                <th>Pay to</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseDettail as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">#{{$loop->index +1}}</label>
                                    </div>
                                </td>
                                <td>{{ $item->substr_invoice() }}</td>
                                <td>
                                    @if ($item->supplier_id)
                                    {{ date('d/m/Y',strtotime($item->final_purchases->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->supplier_id)
                                        {{ $item->final_purchases->users->name }} <span style="color:green"></span>
                                        @else
                                        {{ $item->final_purchases->users->name }} <span style="color:red"></span>
                                    @endif
                                </td>
                                <td>৳
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Cash Out</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Purchase</td>
                                <td>৳
                                    {{ number_format((float)($purchaseTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>



            <div class="card height-auto mg-t-30">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Details (Expense)</h5>
                    </div>
                </div>
                <div class="table-responsive"  id="toprintDetails">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Reference No.</th>
                                <th>Date</th>
                                <th>Expense Category</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expensDetails as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">#{{$loop->index +1}}</label>
                                    </div>
                                </td>
                                <td>{{ $item->reference_no }}</td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ date('d/m/Y',strtotime($item->final_expenses->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ $item->final_expenses->categories->name }}
                                    @endif
                                </td>
                                <td>৳ 
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Cash Out</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Expense</td>
                                <td>৳
                                    {{ number_format((float)($expensTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>

        </div>
        <!---card body ---->
    </div>
    <!-- Student Details Area End Here -->  

 <!-- page content  End Here -->
 <!--===================================================================================================================================================-->
<!--#*********************************************************End Page content here*****************************************************************#-->
<!--===================================================================================================================================================-->









<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--- push some things from here--->
<!----custom js link here----->
@push('js')
{{--    
<!-- jquery-->
<script src="{{asset('links')}}/js/jquery-3.3.1.min.js"></script>
<!-- Custom Js -->
<script src="{{asset('links')}}/js/main.js"></script>
<!-- Bootstrap js -->
<script src="{{asset('links')}}/js/bootstrap.min.js"></script>
<!-- Scroll Up Js -->
<script src="{{asset('links')}}/js/jquery.scrollUp.min.js"></script>
<!-- Plugins js -->
<script src="{{asset('links')}}/js/plugins.js"></script>
<!-- Smoothscroll Js -->
<script src="{{asset('links')}}/js/jquery.smoothscroll.min.html"></script>

<!-- Popper js -->
<script src="{{asset('links')}}/js/popper.min.js"></script>

<!-- Counterup Js -->
<script src="{{asset('links')}}/js/jquery.counterup.min.js"></script>
<!-- Moment Js -->
<script src="{{asset('links')}}/js/moment.min.js"></script>
<!-- Waypoints Js -->
<script src="{{asset('links')}}/js/jquery.waypoints.min.js"></script>

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

<!-- SummerNote Js -->
<script src="{{asset('links')}}/js/summernote-bs4.min.html"></script>
<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>
<!-- Map Init js -->
<script src="{{asset('links')}}/js/google-marker-map.js"></script>

<!-- Google Donut Chart JS-->
 <script src="{{asset('links')}}/js/google-donut-chart.js"></script>
--}}



<script>
    function printDiv(divID)
    {
        var divElements = document.getElementById(divID).innerHTML;
        var oldPage = document.body.innerHTML;
        
        document.body.innerHTML = 
        "<html><head><title></title></head><body>" +
        divElements + "</body></html>";

        window.print();
        document.body.innerHTML = oldPage;
    }
</script>


<!--------for Print option ---->
<script src="{{asset('links')}}/js/print/jquery.printPage.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btnPrint').printPage();
        });
</script>
<!--------for Print option ---->
@endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
