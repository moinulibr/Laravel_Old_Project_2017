@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       User Module
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
            <h3>User Module Management</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>User Module </li>
                    <li>
                        <a href="{{ route('admin.user-role-module-action.index') }}">Create Module Action</a>
                    </li>
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

    <!-- Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="row">
                
                <div class="col-6">
                    <div class="card height-auto mg-t-30">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h5>Add Module</h5>
                            </div>
                        </div>
                            <form method="POST" action="{{route('admin.user-role-module.store')}}" class="new-added-form form-inline">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                        <label class="col-xl-4 col-lg-4 col-12">Module Nmae:</label>
                                        <input name="module_name" type="text" value="{{old('module_name')}}" placeholder="Module Name" class="col-xl-8 col-lg-8 col-12 form-control">
                                        @if($errors->has('module_name'))
                                        <span class="margin-left-33">
                                        <strong style="color:red;">{{ $errors->first('module_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-12 mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add Role Module</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card height-auto mg-t-30">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h5>View Role Module</h5>
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
                                        <th>Role Module</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item) 
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#{{$loop->index +1}}</label>
                                            </div>
                                        </td>
                                        <td>{{$item->module_name}}</td>
                                        <td>
                                           <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                   <span class="flaticon-more-button-of-three-dots"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                             
                                                    <a class="dropdown-item edit" href="#"  data-name="{{ $item->module_name }}" data-url="{{route('admin.user-role-module.update',$item->id)}}"    data-toggle="modal" data-target="#myEditModal"><i class="fas fa-edit text-orange-peel"></i>Edit</a>
                                                  
                                                    <a class="dropdown-item delete" href="#" data-url="{{route('admin.user-role-module.delete',$item->id)}}"   data-toggle="modal" data-target="#myModal"><i class="fas fa-times text-orange-red"></i>Delete</a>
                                                 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $roles->links() }}
                        </div>
                        <!---Table responsive end here ---->
                    </div>
                </div><!--col-->
                
            </div><!-- row-->
        </div>
        <!---card body ---->
    </div>
    <!-- Details Area End Here -->  

 <!-- page content  End Here -->
 <!--===================================================================================================================================================-->
<!--#*********************************************************End Page content here*****************************************************************#-->
<!--===================================================================================================================================================-->

  <!-- The Delete  Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content modal-sm">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style="text-align:center">Delete This Role Module</h4>
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



 <!-- The Edit  Modal -->
 <div class="modal" id="myEditModal">
    <div class="modal-dialog">
      <div class="modal-content modal-sm">
        <form action="" method="POST" id="editFormAction">
            @csrf
            @method("PUT")
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title" style="text-align:center">Edit This Role Module</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            
                <div class="col-xl-12 col-lg-12 col-12 form-group">
                    <label class="col-xl-12 col-lg-12 col-12">Role Module:</label>
                    <input name="module_name" id="name" type="text" value="" placeholder="Role Module" class="col-xl-12 col-lg-12 col-12 form-control">
                    @if($errors->has('module_name'))
                    <span class="margin-left-33">
                    <strong style="color:red;">{{ $errors->first('module_name') }}</strong>
                    </span>
                    @endif
                </div>

            
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <input type="submit" class="btn btn-info" value="Update">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>




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
    $('.edit').click(function(){
        let url  = $(this).data('url');
        let name  = $(this).data('name');
        $('#name').val(name);
        $('#editFormAction').attr("action",url);
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
