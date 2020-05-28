@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
      Role Menu Create
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
            <h3>Create Menu Action</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Admin</li>
                    <li>
                        <a href="{{route('admin.user-role-menu-action.index')}}">Menu Action View</a>
                    </li>
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

{{-- -
@if ($errors->any())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif    
--}}

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
<!--===================================================================================================================================================-->
<!-- page content  Start Here -->

    <!-- Add Expense Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h5>Add Menue Action</h5>
                </div>
            </div>
        <form action="{{ route('admin.user-role-menu-action.store') }}" method="POST" class="new-added-form form-inline">
            @csrf
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                        <label class="col-xl-4 col-lg-4 col-12">Menu Title:</label>
                        <select name="user_role_menu_title_id" id="user_role_menu_title_id" class="col-xl-8 col-lg-8 col-12 form-control">
                            <option value="">Select One</option>
                            @foreach ($menu_titles as $item)
                                <option {{ old('user_role_menu_title_id') == $item->id ?'selected':''}} value="{{$item->id}}">{{$item->menu_title}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user_role_menu_title_id'))
                        <span class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('user_role_menu_title_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-xl-12 col-lg-12 col-12 form-group not_cash">
                        <label class="col-xl-4 col-lg-4 col-12" for="action_name">Menu Action Name:</label>
                        <input type="text" value="{{old('action_name')}}" id="action_name" placeholder="Role Menu Action Name" name="action_name" class="col-xl-8 col-lg-8 col-12 form-control">
                        @if($errors->has('action_name'))
                        <span class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('action_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-12 col-lg-12 col-12 form-group not_cash">
                        <label for="action_checker_route_or_url" class="col-xl-4 col-lg-4 col-12">Action Checker: <small style="color:red;">(only route / url)</small></label>
                        <input name="action_checker_route_or_url" id="action_checker_route_or_url" value="{{old('action_checker_route_or_url')}}" type="text" placeholder="Action Checker (must use url,route)" class="col-xl-8 col-lg-8 col-12 form-control">
                        @if ($errors->has('action_checker_route_or_url'))
                        <span  role="alert" class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('action_checker_route_or_url') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-12 mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add Menu Action</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Expense Area End Here -->

 <!-- page content  End Here -->
 <!--===================================================================================================================================================-->
<!--#*********************************************************End Page content here*****************************************************************#-->









<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--- push some things from here--->
<!----custom js link here----->
@push('js')
{{-- -   
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
    $(document).ready(function(){
        $('.mobile_banking_type').hide(200);
        $('#payment_method_id').on('change',function(){
            let value = $(this).val();
            if(value == 1)
            {
                $('.not_cash').hide(200);
                $('.mobile_banking_type').hide(200);
            }
            else if(value == 2)
            {
                $('.mobile_banking_type').show(200);
                $('.not_cash').show(200);
            }
            else{
                $('.mobile_banking_type').hide(200);
                $('.not_cash').show(200);
            }
        });
    });
</script>
@endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
