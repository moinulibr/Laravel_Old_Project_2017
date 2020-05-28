@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
      Product Create
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
            <h3>Product Create</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Product</li>
                    @if(check_menu_button('products','view'))
                    <li>
                    <a href="{{route('admin.product.index')}}">Back</a>
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
                                <h5>Add Product</h5>
                            </div>
                        </div>
                        <form action="{{ route('admin.product.store') }}" method="POST" class="new-added-form form-inline" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label class="col-xl-4 col-lg-4 col-12">Product Type:</label>
                                    <label for="exinc-type-2" class="radio-inline">
									    <input type="radio" class="exinc-type" id="exinc-type-1" name="product_type" value="Goods" required="" checked="checked">Goods
									    <input type="radio" class="exinc-type" id="exinc-type-2" name="product_type" value="Service" required="">Service
                                    </label>
                                    @if($errors->has('product_type'))
                                    <span class="margin-left-33">
                                    <strong style="color:red;">{{ $errors->first('product_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label for="name" class="col-xl-4 col-lg-4 col-12">Product Name :</label>
                                    <input name="name" id="name" type="text" placeholder="Product Name" class="col-xl-8 col-lg-8 col-12 form-control">
                                    @if($errors->has('name'))
                                    <span class="margin-left-33">
                                    <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label class="col-xl-4 col-lg-4 col-12">Product Category:</label>
                                    <select name="product_category_id" class="col-xl-8 col-lg-8 col-12 form-control">
                                        <option value="">Select One</option>
                                        @foreach ($productCategories as $item)
                                            <option {{old('product_category_id') == $item->id ?'selected':''}} value="{{$item->id}}">{{$item->name}}</option> 
                                        @endforeach
                                    </select>
                                    @if($errors->has('product_category_id'))
                                    <span class="margin-left-33">
                                    <strong style="color:red;">{{ $errors->first('product_category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label class="text-dark-medium" style=" margin-right: 5px; ">Upload Photo (150px X 150px): </label>
                                    <input name="image" type="file" class="form-control-file">
                                </div>
                                @if(check_menu_button('products','create'))
                                <div class="form-group col-12 mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add Product</button>
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
@endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
