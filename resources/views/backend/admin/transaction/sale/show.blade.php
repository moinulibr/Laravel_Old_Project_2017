@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       View Invoice
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
            <h3> Sales Invoice</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li> Sales Show</li>
                    @if(check_menu_button('products','view'))
                    <li>
                        <a href="{{route('admin.transaction-sale.index')}}">Back</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('home') }}">Home</a>
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
                    <h5>Invoice Details</h5>
                </div>
            </div>
            <div class="single-info-details">
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium"></h3>
                        <div class="header-elements">
                            <ul>
                                {{-- <li><ahref="#"><iclass="farfa-edit"></i></a></li> --}}
                                <li><a href="#"  onclick="javascript:printDiv('toprint')"><i class="fas fa-print"></i></a></li>
                                {{-- <li><ahref="#"><iclass="fasfa-download"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>


                    <div class="info-table table-responsive"  id="toprint">
                        
                        <div class="order-branding">
                            <div class="right-invoice">INVOICE</div>
                            
                            <h2 class="company-address">{{ Information::$company_name }}</h2>
                            <p>
                               {{ Information::$company_address_raod }}</br>
                               {{ Information::$company_address_house }}</br>
                                Mobile: {{ Information::$company_mobile_1 }}</br>
                                Mobile: {{ Information::$company_mobile_2 }}</br>
                                {{ Information::$company_email }}
                            </p>
                        </div>
                        <div class="order-addresses">
                            <div class="billing-address">
                                <h3>Customer:</h3>
                                <p>
                                    
                                {{ $final_sale->users->name }},</br>
                                {{ $final_sale->users->company_name }},</br>
                                {{ $final_sale->users->address }}</br>
                                Mobile: {{ $final_sale->users->phone ?? "Nill" }}</br>
                                {{ $final_sale->users->email }}
                            </p>
                            </div>
                            <div class="shipping-address">
                            </div>
                            
                            
                            <table class="order-info">
                                <tr>
                                    <th>Order Number:</th>
                                    <td> {{ $final_sale->order_no }}</td>
                                </tr>
                                <tr>
                                    <th>Order Date:</th>
                                    <td> {{ date('d-m-Y',strtotime($final_sale->sale_date)) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Status:</th>
                                    <td>
                                        @if ($final_sale->payment_status == NULL || $final_sale->payment_status == 'Unpaid')
                                        <span  style="color:red;">Unpaid</span>
                                        @else
                                        <span  style="color:green;">Paid</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table class="order-items">
                            <thead>
                                <tr>
                                    <th class="product">Product/Service Name</th>
                                    <th class="product">Description</th>
                                    <th class="qty">Qty</th>
                                    <th class="price">Unit Price</th>
                                    <th class="total">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale_details as $item)
                                <tr>
                                    <td class="product">
                                        {{ $item->products->name }}
                                        <dl class="meta">
                                            <dt></dt>
                                            <dd></dd>
                                        </dl>
                                    </td>
                                    <td class="product">
                                        {{ str_limit($item->description, 100) }}
                                        <dl class="meta">
                                            <dt></dt>
                                            <dd></dd>
                                        </dl>
                                    </td>
                                    <td class="qty">
                                        {{ $item->quantity}}
                                    </td>
                        
                                    <td class="price">৳ 
                                        {{ $item->unit_price }}
                                    </td>
                                    <td class="total">৳
                                        {{ number_format((float)$item->unit_price * $item->quantity, 2, '.', '') }}
                                        <del></del>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="text-align: right;">
                                <!-- order_discount removed in WC 2.3, included for backwards compatibility -->
                                <tr class="order-discount">
                                    <th colspan="4">Sub Total:</th>
                                    <td colspan="1">{{$final_sale->sub_total}}</td>
                                </tr>
                                <tr class="order-discount">
                                    <th colspan="4">Fee:</th>
                                    <td colspan="1">{{$final_sale->fee}}</td>
                                </tr>
                                <tr class="order-discount">
                                    <th colspan="4">Discount:</th>
                                    <td colspan="1">{{$final_sale->discount}}</td>
                                </tr>
                                <!-- end order_discount -->
                                <tr class="order-total">
                                    <th colspan="4">Payable Amount:</th>
                                    <td colspan="1">{{$final_sale->final_total}}</td>
                                </tr>
                                <tr class="pos_cash-tendered">
                                    <th colspan="4">Paid Amount:</th>
                                    <td colspan="1">{{$final_sale->paid_total}}</td>
                                </tr>
                                <tr class="pos_cash-change">
                                    <th colspan="4">Due Amount:</th>
                                    <td colspan="1">{{$final_sale->final_total - $final_sale->paid_total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <!--h4>Terms & Conditions:</h4>
                        <p>
                            1. Please write a cheque under the name of SM Trading.
                        </p-->
                        <table class="signature">
                            <tr>
                                <td class="signature-left">
                                    Receiver's signature
                                </td>
                                <td class="signature-right">
                                    On behalf of  {{ Information::$company_name }}
                                </td>
                            </tr>
                        </table>
                        <div class="order-notes"></div>
                        <div class="footer">
                            <hr>
                            <p>If you have any inquiry about this, please feel free to contact
                                <br>  {{ Information::$company_invoice_print_person }} ( {{ Information::$company_invoice_print_person_mobile }})
                                <br> Thank You For Your Business !!</p>
                        </div>
                        
                    </div><!-- Table Content -->
                </div>
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
{{-- -- 
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
@endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
