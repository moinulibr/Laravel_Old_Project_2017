@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
    Income / Expense Create
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
            <h3>Income / Expense Create</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Income / Expense</li>
                    @if(check_menu_button('expenses','view'))
                    <li>
                        <a href="{{route('admin.transaction-expense.index')}}">Back</a>
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
                    <h5>Create Income / Expense</h5>
                </div>
            </div>
            <form action="{{ route('admin.transaction-expense.store') }}" method="POST" class="new-added-form ">
                @csrf
                <div class="row">
                     <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Category Type</label>
                        <select  name="category_type" id="category_type" class="form-control select2" >
                            <option value="">Select One</option>
                           @foreach ($categories as $item)
                            <option value="{{ $item->category_type }}">{{ ucfirst($item->category_type) }}</option>
                           @endforeach
                        </select>

                        @if($errors->has('category_type'))
                        <span >
                        <strong style="color:red;">{{ $errors->first('category_type') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="category_details_div" style="display:none;">
                        <label>Income / Expense Category </label>
                        <select name="expense_category_id" id="category_details" class="select2 form-control payment_method_option">
                            <option >Select One</option> 
                        </select>
                        @if($errors->has('expense_category_id'))
                        <span >
                        <strong style="color:red;">{{ $errors->first('expense_category_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Reference</label>
                        <input type="text" value="{{ $order_id }}"  class="form-control" readonly>
                        <input name="reference_no" type="hidden"  value="{{ $order_id }}" class="form-control"> 
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Date</label>
                        <input name="expense_date" required value="{{ old('expense_date') ?? date('d/m/Y') }}" type="text" placeholder="dd/mm/yy" class="form-control air-datepicker" data-position="bottom right"><i class="far fa-calendar-alt"></i>
                        @if($errors->has('expense_date'))
                        <span >
                        <strong style="color:red;">{{ $errors->first('expense_date') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table display  text-nowrap" id="item_table">
                            <thead>
                                <tr>
                                    <th><label class="form-check-label">ID</label></th>
                                    <th style="width:25%;">Expense Title</th>
                                    <th style="width:35%;">Short Description</th>
                                    <th style="width:13%;">Total</th>
                                    <th style="width:12%;">Date</th>
                                    <th style="width:12%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><label class="form-check-label">#1</label></td>
                                    <td>
                                        <input  name="expense_title[]" autocomplete="off"  style="width:100%;" type="text" placeholder="" class="col-xl-8 col-lg-8 col-12 form-control" style="width:100%;">
                                    </td>
                                    <td>
                                        <input name="description[]" autocomplete="off"  style="width:100%;" type="text" placeholder="" class="col-xl-8 col-lg-8 col-12 form-control">
                                    </td>
                                    <td>
                                        <input name="final_total[]" autocomplete="off"  type="text" value="0" placeholder="" class="col-xl-8 col-lg-8 col-12 form-control finalTotal">
                                    </td>
                                    <td style="width:12%;">
                                        <input name="expense_created_date[]"  autocomplete="off" type="text" placeholder="dd/mm/yy" style="width:80%;" class=" air-datepicker" data-position="bottom right">
                                    </td>
                                    <td>
                                        <button type="button" name="add" class="btn btn-success btn-sm add"><i class='fas fa-plus text-orange-green'></i></button>
                                        <button type="button" name="add" class="btn btn-danger btn-sm remove"><i style="color:yellow;" class="fas fa-times text-orange-red"></i></button>
                                    </td>
                                </tr>
                               
                               {{-- 
                                <tr class="add-new-line">
                                    <td colspan="9" style="text-align: left;">
                                        <a href='#' class="wperp-btn btn--primary add-line-trigger addMore add-row"><i class="flaticon-add-plus-button"></i>Add Line</a href='#'>
                                    </td>
                                </tr>
                                --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" style="text-align: right">Total Amount </td>
                                    <td colspan="3"  style="text-align: left">
                                        <strong id="showTotal"></strong>
                                        <input type="hidden" name="final_total_for_final_expense" id="showTotalVal">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @if(check_menu_button('expenses','store'))
                    <div class="form-group col-12 mg-t-8">
                        <button type="submit" id="submit" style="display:none;" class=" btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Create</button>
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

<script>
    $(document).ready(function(){
     
     $(document).on('click', '.add', function(){
        let count = 1;
        count = count + $('#item_table >tbody >tr').length;
        if(count <= 100)
        {
            let html = '';
            html += '<tr>';
            html += '<td>'+"#"+count  +'</td>';
            html += '<td><input autocomplete="off"  type="text" name="expense_title[]" class="form-control" /></td>';
            html += '<td><input autocomplete="off"  type="text" name="description[]" class="form-control" /></td>';
            html += '<td><input autocomplete="off"  type="text" name="final_total[]" value="0" style="width:69%;" class="form-control finalTotal" /></td>';
            html += '<td><input autocomplete="off"  type="text" name="expense_created_date[]" placeholder="dd/mm/yy" style="width:80%;" class=" air-datepicker" data-position="bottom right"></td>';
            //html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option>@foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option> @endforeach</select></td>';
            html += '<td><button type="button" name="add" class="btn btn-success btn-sm add" style="margin-right:1%;"><i class="fas fa-plus text-orange-green"></i></button><button type="button"  name="remove" class="btn btn-danger btn-sm remove"><i style="color:yellow;" class="fas fa-times text-orange-red"></i></button></td></tr>';
            $('#item_table').append(html);
        }
     });
     
     $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
     });
     

    $(document).on('keyup','.finalTotal',function(){
        let total = 0;
        $('.finalTotal').each(function() 
        {
            total += parseFloat($(this).val());
        })
        $('#showTotal').text(total);
        $('#showTotalVal').val(total);

        if(total > 0)
        {
            $('#submit').show();
        }
        else{
            $('#submit').hide();
        }
    });
    let total = 0;
    $('.finalTotal').each(function() 
    {
        total += parseFloat($(this).val());
    })
    $('#showTotal').text(total);
    $('#showTotalVal').val(total);

    if(total > 0)
    {
        $('#submit').show();
    }
    else{
        $('#submit').hide();
    }

     /*
     $('#insert_form').on('submit', function(event){
      event.preventDefault();
      var error = '';
      $('.item_name').each(function(){
       var count = 1;
       if($(this).val() == '')
       {
        error += "<p>Enter Item Name at "+count+" Row</p>";
        return false;
       }
       count = count + 1;
      });
      
      $('.item_quantity').each(function(){
       var count = 1;
       if($(this).val() == '')
       {
        error += "<p>Enter Item Quantity at "+count+" Row</p>";
        return false;
       }
       count = count + 1;
      });
      
      $('.item_unit').each(function(){
       var count = 1;
       if($(this).val() == '')
       {
        error += "<p>Select Unit at "+count+" Row</p>";
        return false;
       }
       count = count + 1;
      });
      var form_data = $(this).serialize();
      if(error == '')
      {
       $.ajax({
        url:"insert.php",
        method:"POST",
        data:form_data,
        success:function(data)
        {
         if(data == 'ok')
         {
          $('#item_table').find("tr:gt(0)").remove();
          $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
         }
        }
       });
      }
      else
      {
       $('#error').html('<div class="alert alert-danger">'+error+'</div>');
      }
     });
     */

    });
    </script>


    <div id="category_type_url" data-url="{{ route('admin.transaction_category_type') }}"></div>

<script>
    $(document).ready(function(){
        $('#category_type').on('change',function(e){
            e.preventDefault();
           let url = $('#category_type_url').data('url'); 
           let category_type = $(this).val();
            $.ajax({
                url:url,
                datatype:'html',
                data:{category_type:category_type},
                success:function(response)
                {   
                   $('#category_details').html(response);
                   if(response !="")
                   {
                    $('#category_details_div').show(100);
                   }
                   else{
                    $('#category_details_div').hide(100);
                   }
                },
            });
        });
    });
</script>




    <script>
         /*
        $(document).ready(function(){
            $('.addMore').click(function(){
                let lineNo = "djfk";
                markup = "<tr><td>This is row "  
                    + lineNo + "</td></tr>"; 
                tableBody = $("table tbody"); 
                tableBody.prepend(markup); 
                lineNo++; 
            });
         
            $(".add-row").click(function() {
                let count = 1;                                                                                                                                                                                                                                                                                                                                                                    
                var markup = "<tr><td>"+count+"</td><td><input name='expense_title[]' type='text' /></td><td><input name='discription[]' type='text' /></td><input name='expense_title[]' type='text' /></td><td><input name='final_total[]' type='text' /></td><td><input type='text' placeholder='dd/mm/yy'  class='air-datepicker' data-position='bottom right'></td><td><div class='row'><div class='col-xl-6 col-lg-6 col-12'><a class='dropdown-item addMore add-row' href='#' ><i class='fas fa-plus text-orange-green'></i></a></div><div class='col-xl-6 col-lg-6 col-12'><a href='#' class='dropdown-item delete-row'><i class='fas fa-times text-orange-red'></i></a></div></div></td></tr>";
                $("table tbody").append(markup); 
                //$('#myTable > tbody:last-child').append(markup);
                count =  count +1;                                                                                                                                                                                                                                                                                                                       
            });
            /* Find and remove selected table rows */
            /*
            $(document).on("click",".delete-row",function() {
                $("table tbody").find('input[name="record"]').each(function() {
                    if ($(this).is(":checked")) {
                        $(this).parents("tr").remove();
                    }
                });
            });

        });*/
    </script>

 @endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
