@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       title
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
            <h3>Admin Dashboard</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Admin</li>
                    <li>
                        <a href="#">Home</a>
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

         <!-- Add Expense Area Start Here -->
         <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>One Patient Test</h5>
                    </div>
                </div>

                <div class="row">
                    <table style="border:1px solid gray;">
                        <tr style="border:1px solid gray;">
                            <th>Patient Name</th>
                            <th>Test Name</th>
                        </tr>
                        @foreach ($testPatient as $item)
                            <tr style="border:1px solid gray;">
                                <td>{{ $item->patients->name }} </td>
                                <td>{{ $item->tests->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <br/><br/><br>

                <div class="row">
                    <table style="border:1px solid gray;">
                        <tr style="border:1px solid gray;">
                            <th>Name</th>
                            <th>Normal Value</th>
                            <th>Result</th>
                        </tr>
                        @foreach ($testes as $item)
                            <tr style="border:1px solid gray;">
                                <td>{{ $item->test_details->label }} </td>
                                <td>Normal  </td>
                                <td>{{ $item->test_value }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                
            </div>
        </div>
        <!-- Add Expense Area End Here -->

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
@endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
