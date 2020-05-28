@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
        Income / Expense Pay
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
            <h3>Income / Expense Pay bill </h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Pay bill </li>
                    <li>
                        <a href="{{ route('admin.transaction-expense.index') }}">Back</a>
                    </li>
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

                  <!-- Add Expense Area Start Here -->
                  <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h5>Income / Expense Bill Payment</h5>
                            </div>
                        </div>
                        <form action="{{ route('admin.transaction.expense.payment-process') }}" method="POST" class="new-added-form ">
                           @csrf
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label> Category Type:</label>
                                    <input type="text" value="{{ucfirst($expense->categories->category_type)}}" class="form-control" readonly>
                                    <input type="hidden" name="category_type" value="{{$expense->categories->category_type}}" class="form-control" >
                                </div>

                                 <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Income / Expense Category:</label>
                                    <input type="text" value="{{$expense->categories->name}}" class="form-control" readonly>
                                    <input type="hidden" name="expense_category_id" value="{{$expense->expense_category_id}}" class="form-control" >
                                    <input type="hidden" name="id" value="{{ $expense->id }}">
                                </div>
                                 
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Reference:</label>
                                    <input type="text" value="{{$expense->reference_no}}" class="form-control" readonly>
                                    <input name="reference_no" type="hidden" value="{{$expense->reference_no}}" class="form-control" >
                                </div>
                               
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Payment Date</label>
                                    <input name="payment_date" type="text" value="{{ old('payment_date') ?? date('d/m/Y') }}" placeholder="dd/mm/yyyy" class="form-control air-datepicker" data-position="bottom right"><i class="far fa-calendar-alt"></i>
                                    @if($errors->has('payment_date'))
                                    <span >
                                    <strong style="color:red;">{{ $errors->first('payment_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Payment Method</label>
                                    <select name="payment_method_id" id="payment_method_id" class="form-control">
                                        <option value="">Select One</option>
                                       @foreach ($payment_methods as $item)
                                       <option {{old('payment_method_id') == $item->id ?'selected':''}} value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>  
                                       @endforeach
                                    </select>
                                    @if($errors->has('payment_method_id'))
                                        <span >
                                        <strong style="color:red;">{{ $errors->first('payment_method_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group" id="depositTo" style="display:none;">
                                    <label>Payment By</label>
                                    <select name="account_id"  class="form-control payment_method_option" id="payment_method_option">
                                        <option >None</option> 
                                    </select>
                                    @if($errors->has('account_id'))
                                    <span >
                                    <strong style="color:red;">{{ $errors->first('account_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Payment Type</label>
                                    <select name="payment_type_id" id="payment_type_id" class="form-control">
                                        <option value="">Select One</option> 
                                        @foreach ($payment_typies as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                
                                <div class="table-responsive">
                                    <table class="table display text-nowrap">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;"><label class="form-check-label">ID</label></th>
                                                <th style="width:20%;">Expense Title</th>
                                                <th style="width:40%;">Description</th>
                                                <th>Total</th>
                                                <th colspan="2"></th>
                                                {{-- 
                                                    <th>Total</th>
                                                    <th>Paid Amount</th>
                                                    <th>Due Amount</th>
                                                --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expense_details as $item)
                                            <tr>
                                                <td>
                                                    <label class="form-check-label">#{{$loop->index +1}}</label>
                                                </td>
                                                <td>{{$item->expense_title}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>৳ 
                                                    {{$item->final_total}}
                                                </td>
                                                <td colspan="2"></td>
                                                {{-- 
                                                <td>৳ 100.00</td>
                                                <td></td>
                                                <td></td>
                                                --}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="discount-rate-row">
                                                <td colspan="3" style="text-align:right">Sub Total</td>
                                                <td>৳ 
                                                    {{ number_format((float)$expense_details_amount, 2, '.', '') }}
                                                </td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr class="discount-rate-row">
                                                <td colspan="3" style="text-align:right">Payable Amount</td>
                                                <td>৳ 
                                                    <strong>{{$expense->final_total}}</strong>
                                                    <input id="final_amount" name="final_total"  type="hidden" value="{{$expense->final_total}}" >
                                                </td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr class="discount-rate-row">
                                                <td  colspan="3" style="text-align:right"> 
                                                     <strong style="color:green;">Paid Amount </strong>
                                                </td>
                                                <td>৳ 
                                                    <span style="margin-left:3%;color:blue;"> : {{$expense->paid_total}} </span>
                                                </td>
                                                <input name="before_paid_total" id="before_paid_total" type="hidden" value="{{$expense->paid_total}}">
                                                <td colspan="2"></td>
                                            </tr>
                                           
                                            {{-- 
                                                <tr class="discount-rate-row">
                                                    <td colspan="3"></td>
                                                    <td>Fee</td>
                                                    <td>৳ {{$expense->fee}}</td>
                                                    <td colspan="2"></td>
                                                    
                                                </tr>
                                                <tr class="discount-rate-row">
                                                    <td colspan="3"></td>
                                                    <td>Discount Amount</td>
                                                    <td>৳ {{$expense->discount}}</td>
                                                    <td colspan="2">
                                                        <strong style="color:green;">Paid Amount 
                                                            <span style="margin-left:3%;color:blue;"> : ৳ {{$expense->paid_total}} </span>
                                                        </strong>
                                                        <input name="before_paid_total" id="before_paid_total" type="hidden" value="{{$expense->paid_total}}">
                                                    </td>  
                                                </tr>
                                            --}}
                                            <tr class="discount-rate-row">
                                                <td  colspan="3" style="text-align:right"> Due Amount</td>
                                                <td>৳ 
                                                    <strong id="now_due_amount_show"></strong>
                                                   
                                                
                                                    <!----total due now for jquery-->
                                                    <input  id="due_amount_now"   type="hidden" value="{{$expense->final_total - $expense->paid_total}}" >
                                                </td>
                                                <td style="width:10%;background-color:#ddd;">
                                                    <input name="paid_total_now" id="paid_amount" type="number" value="{{ old('paid_total_now') ?? 0 }}" step="any" class=" form-control" autocomplete="off" style="background-color:#fff;width:90%;">    
                                                    @if($errors->has('paid_total_now'))
                                                    <span >
                                                    <strong style="color:red;">{{ $errors->first('paid_total_now') }}</strong>
                                                    </span>
                                                    @endif
                                                </td>
                                                <td style="background-color:#ddd;">৳ 
                                                   <strong id="due_amount" style="color:red; font-size:16px;"></strong>
                                                </td>
                                            </tr>
                                            <tr class="discount-rate-row">
                                                <td>Payment Note</td>
                                                <td colspan="6">
                                                    <input type="text" value="{{ old('payment_note') }}" name="payment_note" id="" class=" form-control">
                                                    @if($errors->has('payment_note'))
                                                    <span >
                                                    <strong style="color:red;">{{ $errors->first('payment_note') }}</strong>
                                                    </span>
                                                    @endif
                                                </td>

                                                <!---for jquery check-->
                                                <input id="payment_status" type="hidden" value="{{$expense->payment_status}}">
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="form-group col-12 mg-t-8">
                                    @if(check_menu_button('expenses','expense-payment-process'))
                                    <button type="submit" id="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Pay Bill</button>
                                    @endif
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Add Expense Area End Here -->
                

 <!-- page content  End Here -->
 <!--===================================================================================================================================================-->
<!--#*********************************************************End Page content here*****************************************************************#-->
<!--===================================================================================================================================================-->







<div id="payment_method_url" data-url="{{route('admin.transaction.expense-bill.payment-method')}}"></div>

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
        $('#paid_amount').on('keyup',function(){

            //due_amount
            let finalAmount =  parseFloat($('#due_amount_now').val()).toFixed(2);
            let paidAmount =  parseFloat($('#paid_amount').val()).toFixed(2);
            let dueAmount = finalAmount - paidAmount;
          
            $('#due_amount').text(dueAmount);
            $('#now_due_amount_show').text(dueAmount);

            /*
            let paidingAmount =  $('#paid_amount').val();
            let totalOrderAmount =  $('#final_amount').val();
            let beforePaid =  $('#before_paid_total').val();
            let nowDueamount = totalOrderAmount - beforePaid;
            if(paidingAmount <= dueAmount)
            {
                $('#due_amount').text(paidingAmount);
                $('#paid_amount').val(paidingAmount); 
            }else{
                $('#paid_amount').val(nowDueamount); 
                $('#due_amount').text(nowDueamount);  
            }
            */
        });
    


       let finalAmount = parseFloat($('#due_amount_now').val()).toFixed(2);
       let paidAmount =  $('#paid_amount').val();
      
        
        let dueAmount = finalAmount - paidAmount;

         dueAmount = parseFloat(dueAmount).toFixed(2);
        $('#due_amount').text(dueAmount);
        $('#now_due_amount_show').text(dueAmount);



        let totalOrderAmount =  $('#final_amount').val();
        let beforePaid =  $('#before_paid_total').val();
        let payment_status =  $('#payment_status').val();
        if(totalOrderAmount == beforePaid ||  payment_status=='Paid')
        {
            $('#submit').attr('disabled','disabled');  
            $('#paid_amount').attr('disabled','disabled');  
        }
    });
</script>


<script>
    $(document).ready(function(){
        $('#payment_method_id').on('change',function(e){
            e.preventDefault();
           let url = $('#payment_method_url').data('url'); 
           let payment_method = $(this).val();
            $.ajax({
                url:url,
                datatype:'html',
                data:{payment_method:payment_method},
                success:function(response)
                {   
                   $('#payment_method_option').html(response);
                   if(response !="")
                   {
                    $('#depositTo').show(100);
                   }
                   else{
                    $('#depositTo').hide(100);
                   }
                },
            });
        });
    });
</script>
@endpush
<!----custom js link here----->
<!--- push some things from here--->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
