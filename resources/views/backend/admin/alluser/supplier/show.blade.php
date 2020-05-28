@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       Supplier View
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
            <h3>Supplier Details</h3>
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

     <!-- Supplier Details Area Start Here -->
     <div class="card height-auto">
        <div class="card-body">
            <!--div class="heading-layout1">
                <div class="item-title">
                    <h3>Company Details</h3>
                </div>
            </div-->
            <div class="single-info-details">
                <div class="item-img">
                    @if ($supplier->image)
                    @if(Storage::disk('public')->exists('user-image/',"{$supplier->id}".$supplier->image))
                    <img src="{{ asset('storage/user-image/'.$supplier->id) }}" alt="" height="250" width="250">
                    @endif
                    @else
                    <img src="{{ asset('links') }}/img/figure/user.jpg" alt="Supplier"height="250" width="250">
                @endif
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">-</h3>
                        <div class="header-elements">
                            <ul>
                                @if(check_menu_button('users','user-edit'))
                                <li><a href="{{ route('admin.userEditFrom',['supplier',$supplier->id]) }}"><i class="far fa-edit"></i></a></li>
                                @endif
                                @if(check_menu_button('suppliers','print-all'))
                                <li><a href="{{ route('admin.supplier.print',$supplier->id) }}" class="btnPrint"><i class="fas fa-print"></i></a></li>
                               @endif
                                {{-- <li><ahref="#"><iclass="fasfa-download"></i></a></li>- --}}
                            </ul>
                        </div>
                    </div>

                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Supplier Name:</td>
                                    <td class="font-medium text-dark-medium">{{ucfirst($supplier->name)}}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td class="font-medium text-dark-medium">{{$supplier->phone}} </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="font-medium text-dark-medium">{{$supplier->email}} </td>
                                </tr>
                                <tr>
                                    <td>Clients Address:</td>
                                    <td class="font-medium text-dark-medium">{{$supplier->address}}</td>
                                </tr>
                                <tr>
                                    <td>Company Name:</td>
                                    <td class="font-medium text-dark-medium">{{$supplier->company_name}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card height-auto mg-t-30" id="toprintDetails">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3> <span>Transaction Details </span>
                        </h3>
                    </div>
                </div>
                <div class="table-responsive"   >
                    <table class="table display  text-nowrap">
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
                                <th>Payment From</th>
                                <th>Account No</th>
                                <th>Payable Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase_details as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">#{{ $loop->index +1 }}</label>
                                    </div>
                                </td>
                                <td>{{ $item->substr_invoice() }}</td>
                                <td>{{ date('d/m/Y',strtotime($item->purchase_date)) }}</td>
                                <td>
                                    @if($item->account_id)
                                        @if($item->account_id == 1) 
                                        <span style="color:green">Cash</span>
                                        @else
                                            @if ($item->accounts->bank_name)
                                            {{ $item->accounts->bank_name }}
                                            @endif
                                        @endif
                                    @endif
                                   
                                    {{-- -
                                    @if($item->payment_method_id)
                                        {{ $item->payment_methods->name }}   
                                    @endif
                                    --}}
                                </td>
                                <td>
                                    @if($item->account_id)
                                        @if ($item->accounts->bank_name)
                                        {{ $item->accounts->account_name ? $item->accounts->account_name:"" }} <br/>
                                        {{ $item->accounts->account_no ? $item->accounts->account_no : ''}} 
                                        @endif
                                    @endif
                                </td>
                                <td>৳{{ $item->final_total }}</td>
                                <td>৳ {{ $item->paid_total }}</td>
                                <td>৳ {{ $item->final_total - $item->paid_total }}</td>
                                <td>
                                    @if ($item->payment_status == NULL || $item->payment_status == 'Unpaid')
                                    <span  style="color:red;">Unpaid</span>
                                    @else
                                    <span  style="color:green;">Paid</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:right;">Total sum</th>
                                <th>৳ {{ $payableAmount }}</th>
                                <th>৳ {{ $paidAmount }}</th>
                                <th>৳  {{ $payableAmount - $paidAmount }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>
        </div>
        <!---card body ---->
    </div>
    <!-- Supplier Details Area End Here -->    

 <!-- page content  End Here -->
 <!--===================================================================================================================================================-->
<!--#*********************************************************End Page content here*****************************************************************#-->
<!--===================================================================================================================================================-->






 <!-- The Modal -->
 <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content modal-sm">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style="text-align:center">Delete This Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            Are You Sure To Delete This?
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <a class="btn btn-info" id="delete" href="">Yes</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--- push some things from here--->
<!----custom js link here----->
@push('js')
<!-- jquery-->
{{-- -
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
    $('.delete').click(function(){
        let url  = $(this).data('url');
        $('#delete').attr("href",url);
    });
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
