@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
      Account Update
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
            <h3>Account Update</h3>
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
                    <h5>Edit Accounts</h5>
                </div>
            </div>
        <form action="{{ route('admin.account.update',$account->id) }}" method="POST" class="new-added-form form-inline">
            @csrf
            @method("PUT")
                <div class="row">
                    {{-- -
                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                            <label class="col-xl-4 col-lg-4 col-12">Account For:</label>
                            <select name="account_for_user_id" id="" class="col-xl-8 col-lg-8 col-12 form-control">
                                @foreach ($account_for_users as $item)
                                    <option {{ $account->account_for_user_id ==$item->id ?'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('account_for_user_id'))
                            <span class="margin-left-33">
                            <strong style="color:red;">{{ $errors->first('account_for_user_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    --}}
                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                        <label class="col-xl-4 col-lg-4 col-12">Payment Method / Accounts Type:</label>
                        <select name="payment_method_id" id="payment_method_id" class="col-xl-8 col-lg-8 col-12 form-control">
                            <option value="">Select One</option>
                            @foreach ($payment_methods as $item)
                                <option  {{ $account->payment_method_id ==$item->id ?'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('payment_method_id'))
                        <span class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('payment_method_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-12 col-lg-12 col-12 form-group mobile_banking_type">
                        <label class="col-xl-4 col-lg-4 col-12" for="mobile_banking_type_id">Mobile Banking Type:</label>
                        <select name="mobile_banking_type_id" id="mobile_banking_type"  class="col-xl-8 col-lg-8 col-12 form-control">
                            <option value="">Please Select One</option>
                                @foreach ($mobile_bankings as $item)
                                <option {{ $account->mobile_banking_type_id ==$item->id ?'selected':'' }} value="{{ $item->id}}">{{ $item->name}}</option> 
                                @endforeach
                        </select>
                        @if($errors->has('mobile_banking_type_id'))
                        <span class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('mobile_banking_type_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-xl-12 col-lg-12 col-12 form-group not_cash">
                        <label class="col-xl-4 col-lg-4 col-12" for="account_name">Account Name:</label>
                        <input type="text" value="{{ $account->account_name ?? old('account_name')}}" id="account_name" placeholder="Account Name" name="account_name" class="col-xl-8 col-lg-8 col-12 form-control">
                        @if($errors->has('account_name'))
                        <span class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('account_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-12 col-lg-12 col-12 form-group not_cash">
                        <label for="account_no" class="col-xl-4 col-lg-4 col-12">Account No:</label>
                        <input name="account_no" id="account_no" value="{{ $account->account_no ?? old('account_no')}}" type="text" placeholder="Account No" class="col-xl-8 col-lg-8 col-12 form-control">
                        @if ($errors->has('account_no'))
                        <span  role="alert" class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('account_no') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-12 col-lg-12 col-12 form-group not_cash">
                        <label class="col-xl-4 col-lg-4 col-12" for="bank_name">Bank Name:</label>
                        <input name="bank_name" id="bank_name" value="{{ $account->bank_name ?? old('bank_name')}}" type="text" placeholder="Bank Name" class="col-xl-8 col-lg-8 col-12 form-control">
                        @if ($errors->has('bank_name'))
                        <span  role="alert" class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('bank_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-12 col-lg-12 col-12 form-group not_cash">
                        <label class="col-xl-4 col-lg-4 col-12" for="bank_address">Bank Address:</label>
                        <input name="bank_address" id="bank_address" value="{{ $account->bank_address ?? old('bank_address')}}" type="text" placeholder="Bank Address" class="col-xl-8 col-lg-8 col-12 form-control">
                        @if($errors->has('bank_address'))
                        <span  role="alert" class="margin-left-33">
                        <strong style="color:red;">{{ $errors->first('bank_address') }}</strong>
                        </span>
                        @endif
                    </div>
                    {{-- 
                        <div class="col-xl-12 col-lg-12 col-12 form-group not_cash">
                            <label class="col-xl-4 col-lg-4 col-12" for="amount">Opening Amount:</label>
                            <input name="amount" id="amount" value="{{ $account->amount ?? old('amount')}}" type="text" placeholder="Opening Amount" class="col-xl-8 col-lg-8 col-12 form-control">
                            @if($errors->has('amount'))
                            <span  role="alert" class="margin-left-33">
                            <strong style="color:red;">{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>
                    --}}
                    @if(check_menu_button('accounts','update'))
                    <div class="form-group col-12 mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update Accounts</button>
                    </div>
                    @endif
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

       let select =  $('#payment_method_id option:selected').val();
       if(select == 1)
       {
            $('.mobile_banking_type').hide(200);
            $('.not_cash').hide(200);
       }
       else if(select == 2)
       {
            $('.mobile_banking_type').show(200);
            $('.not_cash').show(200);
       }
       else{
        $('.mobile_banking_type').hide(200);
       }
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
