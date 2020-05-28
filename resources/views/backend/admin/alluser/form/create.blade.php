@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       User {{ $user_type }}
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

    .employee{
        display: none;
    }
    .supplier{
        display: none;
    }
    .client{
        display: none;
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

     <!-- Add New Area Start Here -->
     <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title"> 
                    <h5>Add {{ ucfirst($user_type) }}</h5>
                </div>
            </div>
            <form action="{{ route('admin.user.store') }}" method="POST" class="new-added-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label> Name *</label>
                        <input name="name" value="{{ old('name') }}"  type="text" placeholder="" class="form-control">
                        @if ($errors->has('name'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail</label>
                        <input name="email" value="{{ old('email') }}" type="email" placeholder="" class="form-control">
                        @if ($errors->has('email'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone</label>
                        <input name="phone" value="{{ old('phone') }}" type="text" placeholder="" class="form-control">
                        @if ($errors->has('phone'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone (2)</label>
                        <input name="phone_2" value="{{ old('phone_2') }}" type="text" placeholder="" class="form-control">
                        @if ($errors->has('phone_2'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('phone_2') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>User Role</label>
                        <select id="role_id" name="role_id" class="select2">
                            <option value="">Select User Role</option>
                            @foreach ($roles as $item)
                            <option  {{ old('role_id') == $item->id ?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role_id'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('role_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address</label>
                        <input name="address" value="{{ old('address') }}" type="text" placeholder="" class="form-control">
                        @if ($errors->has('address'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                    </div>
                   
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Password</label>
                        <input name="password" type="text" placeholder="" class="form-control">
                            @if ($errors->has('password'))
                            <span  role="alert" >
                            <strong style="color:red;">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Confirm Password</label>
                        <input name="password_confirmation" type="text" placeholder="" class="form-control">
                        @if ($errors->has('password_confirmation'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>


                <!--Only Employee start--->
                @if ($user_type == 'employee')
                    <div class="col-xl-3 col-lg-6 col-12 form-group ">
                        <label>ID No</label>
                        <input name="id_no" value="{{ old('id_no') }}" type="text" placeholder="" class="form-control">
                        @if ($errors->has('id_no'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('id_no') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select name="gender" class="select2">
                            <option  value="">Please Select Gender *</option>
                            <option {{ old('gender') == 'Male' ?'selected':'' }} value="Male">Male</option>
                            <option {{ old('gender') == 'Female' ?'selected':'' }} value="Female">Female</option>
                            <option {{ old('gender') == 'Others' ?'selected':'' }} value="Others">Others</option>
                        </select>
                        @if ($errors->has('gender'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Blood Group *</label>
                        <select name="blood_group" class="select2">
                            <option value="">Please Select Group *</option>
                            <option {{ old('blood_group') == 'A+' ?'selected':'' }}  value="A+">A+</option>
                            <option {{ old('blood_group') == 'A-' ?'selected':'' }}  value="A-">A-</option>
                            <option {{ old('blood_group') == 'B+' ?'selected':'' }}  value="B+">B+</option>
                            <option {{ old('blood_group') == 'B-' ?'selected':'' }}  value="B-">B-</option>
                            <option {{ old('blood_group') == 'AB+' ?'selected':'' }}  value="AB+">AB+</option>
                            <option {{ old('blood_group') == 'AB-' ?'selected':'' }}  value="AB-">AB-</option>
                            <option {{ old('blood_group') == 'O+' ?'selected':'' }}  value="O+">O+</option>
                            <option {{ old('blood_group') == 'O-' ?'selected':'' }}  value="O-">O-</option>
                        </select>
                        @if ($errors->has('blood_group'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('blood_group') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Religion *</label>
                        <select name="religion" class="select2">
                            <option value="">Please Select Religion *</option>
                            <option {{ old('religion') == 'Islam' ?'selected':'' }}  value="Islam">Islam</option>
                            <option {{ old('religion') == 'Hindu' ?'selected':'' }} value="Hindu">Hindu</option>
                            <option {{ old('religion') == 'Christian' ?'selected':'' }} value="Christian">Christian</option>
                            <option {{ old('religion') == 'Buddish' ?'selected':'' }} value="Buddish">Buddish</option>
                            <option {{ old('religion') == 'Others' ?'selected':'' }} value="Others">Others</option>
                        </select>
                        @if ($errors->has('religion'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('religion') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-lg-6 col-12 form-group ">
                        <label>Short BIO</label>
                        <textarea class="textarea form-control" name="bio"  id="form-message" cols="10" rows="9"></textarea>
                    </div>
                    @endif
                    <!--Only Employee end--->


                     <!--Only supplier  client start--->
                    @if ($user_type == 'supplier' || $user_type == 'client')
                        <div class="col-xl-3 col-lg-6 col-12 form-group ">
                            <label>Company Name</label>
                            <input name="company_name" value="{{ old('company_name') }}" type="text" placeholder="Company Name" class="form-control">
                            @if ($errors->has('company_name'))
                            <span  role="alert" >
                            <strong style="color:red;">{{ $errors->first('company_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    @endif
                     <!--Only supplier  client end--->


                    <div class="col-lg-12 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Photo (150px X 150px): </label>
                        <input name="image" type="file" class="form-control-file">
                        @if ($errors->has('image'))
                        <span  role="alert" >
                        <strong style="color:red;">{{ $errors->first('image') }}</strong>
                        </span>
                        @endif
                    </div>

                    <input type="hidden" name="user_type" id="" value="{{ $user_type }}">
                    @if(check_menu_button('users','store'))
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add {{ ucfirst($user_type) }}</button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <!-- Add New Teacher Area End Here -->

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
    $(document).ready(function(){
        $('.mobile_banking_type').hide(200);
        $('#role_id').on('change',function(){
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
