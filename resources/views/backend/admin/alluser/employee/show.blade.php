@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       Employee View
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
            <h3>Employee Details</h3>
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

     <!-- client Details Area Start Here -->
     <div class="card height-auto">
        <div class="card-body">
            <!--div class="heading-layout1">
                <div class="item-title">
                    <h3>Company Details</h3>
                </div>
            </div-->
            <div class="single-info-details">
                <div class="item-img">
                    @if ($employee->image)
                    @if(Storage::disk('public')->exists('user-image/',"{$employee->id}".$employee->image))
                    <img src="{{ asset('storage/user-image/'.$employee->id) }}" alt="" height="250" width="250">
                    @endif
                    @else
                    <img src="{{ asset('links') }}/img/figure/user.jpg" alt="employee"height="250" width="250">
                    @endif
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">-</h3>
                        <div class="header-elements">
                            <ul>
                                @if(check_menu_button('users','user-edit'))
                                <li><a href="{{ route('admin.userEditFrom',["employee",$employee->id])}}""><i class="far fa-edit"></i></a></li>
                                @endif
                                @if(check_menu_button('employees','print-all'))
                                <li><a href="{{ route('admin.employee.print',$employee->id) }}" class="btnPrint"><i class="fas fa-print"></i></a></li>
                                @endif
                               {{-- <li><ahref="#"><iclass="fasfa-download"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Employee Name:</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ $employee->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Employee Gender:</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ $employee->gender }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td class="font-medium text-dark-medium"> {{ $employee->phone }} </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="font-medium text-dark-medium"> {{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <td>Blood Group:</td>
                                    <td class="font-medium text-dark-medium">{{ $employee->blood_group }}</td>
                                </tr>
                                <tr>
                                    <td>Religion:</td>
                                    <td class="font-medium text-dark-medium">{{ $employee->religion }}</td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ $employee->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ID No:</td>
                                    <td class="font-medium text-dark-medium"> {{ $employee->id_no }}</td>
                                </tr>
                                <tr>
                                    <td>User Role:</td>
                                    <td class="font-medium text-dark-medium">
                                        @if ($employee->role_id)
                                        {{ $employee->roles->name }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>BIO:</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ str_limit($employee->bio, 100) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- 
            <div class="card height-auto mg-t-30">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Transaction Details</h3>
                    </div>
                </div>
                <div class="table-responsive">
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
                                <th>Payable Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale_Finals as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">#{{ $loop->index +1 }}</label>
                                    </div>
                                </td>
                                <td>{{ $item->order_no }}</td>
                                <td>{{ date('d/m/Y',strtotime($item->sale_date)) }}</td>
                                <td>
                                    @if ( $item->payment_method_id)
                                    {{ $item->payment_methods->name }}
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
                                <td colspan="4" style="text-align:right;">Total sum</td>
                                <td>৳ {{ $payableAmount }}</td>
                                <td>৳ {{ $paidAmount }}</td>
                                <td>৳  {{ $payableAmount - $paidAmount }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>
            --}}
        </div>
        <!---card body ---->
    </div>
    <!-- client Details Area End Here -->    

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
