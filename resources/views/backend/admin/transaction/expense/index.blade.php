@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
      Income / Expense Index
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
            <h3>Income / Expense</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Income / Expense</li>
                    @if(check_menu_button('expenses','create'))
                    <li>
                        <a href="{{route('admin.transaction-expense.create')}}">Create</a>
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

      <!-- Table Area Start Here -->
      <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h5>Income/ Expense Details</h5>
                </div>
                @if(check_menu_button('expenses','create'))
                 <a href="{{route('admin.transaction-expense.create')}}" class="btn-fill-lg bg-blue-dark btn-hover-yellow"> Create Income / Expense</a>
                @endif
            </div>
            {{-- -
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-md-1 col-5">
                            <div class="form-group">
                                <select class="form-control">
                                    <option value="">Bulk Action</option>
                                    <option value="1">Delete</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 col-3">
                            <div class="form-group">
                                <a href="/login/category/add.php" class="btn-fill-lg bg-blue-dark btn-hover-yellow"> Apply</a>
                            </div>
                        </div>
                        <div class="col-md-7 col-4"></div>
                        <div class="col-md-2 col-8">
                            <div class="form-group">
                                <input type="text" placeholder="Search by Title ..." class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1 col-4">
                            <div class="form-group float-right">
                                <a href="/login/category/add.php" class="btn-fill-lg bg-blue-dark btn-hover-yellow"> Search</a>
                            </div>
                        </div>
                    </div>
                </form>
            --}}
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
                            <th>Category Type</th>
                            <th>Category</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finalExpenses as $item)
                        <tr>
                            <td><div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">#{{ $loop->index +1 }}</label>
                                </div>
                            </td>
                            <td>
                                @if ($item->categories->category_type =='income')
                                    <span style="color:green;">Income</span>
                                    @else
                                    <span style="color:red;">Expense</span>
                                @endif
                                {{-- ucfirst($item->categories->category_type) --}}
                            </td>
                            <td>{{ $item->categories->name }}</td>
                            <td>{{ $item->reference_no }}</td>
                            <td>{{ $item->expense_date }}</td>
                            <td>৳
                                {{ $item->final_total }}
                            </td>
                            <td>
                                @if ($item->payment_status == NULL || $item->payment_status == 'Unpaid')
                                <span  style="color:red;">Unpaid</span>
                                @else
                                <span  style="color:green;">Paid</span>
                                @endif
                            </td>
                             <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @if(check_menu_button('expenses','expense-payment'))
                                        <a class="dropdown-item" href="{{ route('admin.transaction.expense.receive-payment',$item->id) }}"><i class="fas fa-check text-dark-pastel-green"></i></i>Pay Bill</a>
                                        @endif
                                        @if(check_menu_button('expenses','show'))
                                        <a class="dropdown-item" href="{{ route('admin.transaction-expense.show',$item->id) }}"><i class="fas fa-eye text-dark-pastel-green"></i>View</a>
                                        @endif
                                        @if(check_menu_button('expenses','edit'))
                                            @if($item->account_id == NULL)
                                            <a class="dropdown-item" href="{{ route('admin.transaction-expense.edit',$item->id) }}"><i class="fas fa-edit text-dark-pastel-green"></i>Edit</a>
                                                @else
                                                <a class="dropdown-item" readonly><i class="fas fa-edit text-orange-red"></i>Edit</a>
                                            @endif
                                        @endif
                                        @if(check_menu_button('expenses','delete'))
                                        <a class="dropdown-item delete" href="#" data-url="{{route('admin.transaction.expense.delete',$item->id)}}"  data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt text-orange-red"></i></i>Delete</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $finalExpenses->links() }}
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->

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
          <h4 class="modal-title" style="text-align:center">Delete This Expense</h4>
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
