
@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
    Delivery Note
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
   
   <style>
    .margin-left-33{
     margin-left:33%;
    }

    .not_cash{
        display:none;
    }
    .mobile_banking_type{
        display:none;
    }
</style>
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
            <h3>Sale Delivery Note</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Admin</li>
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





<!--===================================================================================================================================================-->
<!--#*********************************************************Start Page content here*****************************************************************#-->  
<!--===================================================================================================================================================-->
<!-- page content  Start Here -->
 <!-- Student Details Area Start Here -->
 <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h5>DELIVERY NOTE</h5>
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
                        <div class="right-invoice">DELIVERY NOTE</div>
                        
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
                        
                        
                        <table class="order-info" style="border:none;">
                            <tr style="border:none;">
                                <th style="border:none;">Order Number:</th>
                                <td> {{ $final_sale->order_no }}</td>
                            </tr>
                            <tr style="border:none;">
                                <th style="border:none;">Order Date:</th>
                                <td> {{ date('F d, Y',strtotime($final_sale->sale_date)) }}</td>
                            </tr>
                        </table>
                    </div>
                    <table class="order-items" style="border:1px solid gray;">
                        <thead>
                            <tr style="background-color:black;color:white;">
                                <th class="product">Product/Service Name</th>
                                <th style="text-align:left;" class="product">Description</th>
                                <th style="text-align:left;" class="qty">Quantity</th>
                                <th style="text-align:center;" class="total">Remarks</th>
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
                                <td class="product"  style="text-align:left;" >
                                    {{ str_limit($item->description, 100) }}
                                    <dl class="meta">
                                        <dt></dt>
                                        <dd></dd>
                                    </dl>
                                </td>
                                <td class="qty"  style="text-align:left;" >
                                    {{ $item->quantity}}
                                </td>
                    
                                <td class="price">
                                  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
<!-- jquery-->

 
 <script>
    $('.delete').click(function(){
        let url  = $(this).data('url');
        $('#delete').attr("href",url);
    });
</script>

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
