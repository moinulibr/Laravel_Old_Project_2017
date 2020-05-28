@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       Purchase Create
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
            <h3>Purchase Create</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Purchase</li>
                    @if(check_menu_button('purchases','view'))
                    <li>
                        <a href="{{ route('admin.transaction-purchase.index') }}">Back</a>
                    </li>
                    @endif
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
                        <h5>Create Purchases</h5>
                    </div>
                </div>
                <form action="{{ route('admin.transaction-purchase.store') }}" method="POST" class="new-added-form ">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Reference / Invoice No</label>
                            <input  type="text" value="{{ old('reference_no') }}" name="reference_no" required class="form-control">
                            <input type="hidden" name="reference_no_add_for_unique" value="{{$order_id}}" class="form-control">
                            @if($errors->has('reference_no'))
                            <span >
                            <strong style="color:red;">{{ $errors->first('reference_no') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Supplier</label>
                            <select required name="supplier_id" class="form-control select2">
                                <option value="">Select One</option>
                                @foreach ($suppliers as $item)
                                <option {{ old('supplier_id') == $item->id ?'selected':""}} value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier_id'))
                            <span >
                            <strong style="color:red;">{{ $errors->first('supplier_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Purchases Date:</label>
                            <input required name="purchase_date" value="{{ old('purchase_date') ?? date('d-m-Y') }}" type="text" placeholder="mm/dd/yyyy" class="form-control air-datepicker" data-position="bottom right"><i class="far fa-calendar-alt"></i>
                            @if($errors->has('purchase_date'))
                            <span >
                                <strong style="color:red;">{{ $errors->first('purchase_date') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="table-responsive" style="margin-left:2%;margin-right:2%;height:50px;">
                            @if(check_menu_button('purchases','add-to-cart-purchase'))
                            <div class="form-group" id="selectDiv">
                             <select   id="product_id"  class="product_id col-xl-10 col-lg-10 col-12 form-control select2" style="margin-left:10%;margin-bottom:2%;" >
                                 <option value="">Select A Product</option>
                                 @foreach ($products as $item)
                                     <option value="{{$item->id}}">{{$item->name}}</option>
                                 @endforeach
                             </select>
                            </div>
                            @endif
                         </div>



                        <div class="table-responsive">
                            <table class="table display text-nowrap">
                                <thead>
                                    <tr>
                                        <th><label class="form-check-label">ID</label></th>
                                        <th>Product/Service</th>
                                        <th style="width:25%;">Short Description</th>
                                        <th style="width:12%;">Qty</th>
                                        <th style="width:15%;">Purchase Price</th>
                                        <th style="width:15%;">Sale Price</th>
                                        <th style="width:12%;">Sub Total</th>
                                        <th style="width:10%;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="showResult">
                                    
                                </tbody>
                                <tfoot>
                                    <tr class="discount-rate-row">
                                        <td colspan="5"></td>
                                        <td>Fee</td>
                                        <td><input id="fee"  name="fee" value="0" type="number" autocomplete="off"  step="any"  class="col-xl-8 col-lg-8 col-12 form-control"></td>
                                        <td></td>
                                    </tr>
                                    <tr class="discount-rate-row">
                                        <td colspan="5"></td>
                                        <td>Discount value</td>
                                        <td><input id="discount"   name="discount" value="0" type="number" autocomplete="off" step="any" class="col-xl-8 col-lg-8 col-12 form-control"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>Total Amount</td>
                                        <td>৳
                                             <strong id="sumResult"></strong>
                                             <input type="hidden" name="final_total" id="sumTotalAmount" value="">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group col-12 mg-t-8">
                            @if(check_menu_button('purchases','store'))
                            <button style="display:none;"  type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark orderNow ">Add Purchase</button>
                            @endif
                            @if(check_menu_button('purchases','cancel-all-add-to-cart-purchase'))
                            <a  href="{{route('admin.transaction.purchase-add-to-cancel-process')}}" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Cancel Process</a>
                            @endif
                            @php
                            $cart = session()->has('purchaseCart') ? session()->get('purchaseCart')  : [];
                            @endphp
                            @if (count( $cart)>0) 
                                @if(check_menu_button('purchases','show-add-to-cart-purchase'))    
                                    <a data-url="{{route('admin.transaction.purchase-add-to-show-cart')}}" id="showCart" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Show Cart</a>
                                @endif
                            @endif
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





<div id="getUrl" data-url="{{route('admin.transaction.purchase-add-to-cart-ajax')}}"></div>




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

<script type="text/javascript">
    $(document).ready(function(){
        $('.orderNow').hide();
        /*== sale add to cart==*/

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $('#product_id').on('change',function(e){
            e.preventDefault();
           let product_id = $(this).val();
           let url = $('#getUrl').data('url'); 
                $.ajax({
                    url:url,
                    type:'POST',
                    datatype:'html',
                    cache : false,
                    async: false,
                    data:{product_id},
                    success:function(response)
                    {   
                        $('#showResult').html(response);
                        $('.orderNow').show(); 
 
                    },
                });
        });
            /*== sale add to cart end==*/
            

        /*==sale remove single from add to cart==*/
            $(document).on('click', '.remove_single_sale_cart' ,function(eee){
            eee.preventDefault();
            let url = $(this).data('url');
            let product_id = $(this).data('id');
            $.ajax({
                url:url,
                type:'GET',
                datatype:'html',
                data:{product_id:product_id},
                success:function(response)
                {   
                    $('#showResult').html(response);

                },
            });
        });
        /*==sale remove single from add to cart==*/


        /*==Purchase  single update from add to cart==*/
            $(document).on('click', '.update_single_sale_cart' ,function(eeed){
            eeed.preventDefault();
            let url = $(this).data('url');
            let product_id = $(this).data('id');
            let id = product_id;
            let description = $('#des-'+ id).val();
            let quantity = $('#qty-'+ id).val();
            let unit_price = $('#unp-'+ id).val();
            let sale_unit_price = $('#sup-'+ id).val();
            $.ajax({
                url:url,
                type:'GET',
                datatype:'html',
                data:{product_id:product_id,description:description,quantity:quantity,unit_price:unit_price,sale_unit_price:sale_unit_price},
                success:function(response)
                {   
                    $('#showResult').html(response);
                },
            });
        });
        /*==Purchase  single update from add to cart==*/
    });
</script>


<script>
    $(document).ready(function(){

        $(document).on('keyup , change','.clickToGet , #fee, #discount' ,function(ee){
            ee.preventDefault();
            let id = parseInt($(this).attr("id").substr(4));
            let unitP = parseFloat($('#unp-'+ id).val());
            let qty = parseFloat($('#qty-'+ id).val());
            if(unitP == "")
            {
                $('#unp-'+ id).val(0)
                unitP = 0;
            }
            if(qty == "")
            {
                $('#qty-'+ id).val(0)
                qty = 0;
            }
            let sub_total = unitP * qty;
            sub_total = (sub_total.toFixed(2));
           
            $("#set-" + id).text(sub_total);
            $("#set_val-" + id).val(sub_total);

            //$('#sumTotalAmount').val(sub_total);
            
           
            
            /*
            var sub_total = parseFloat($("#bon_" + id).val());
            var penalty = parseFloat($("#pen_" + id).val());
            var total_salary = salary + bonus - penalty;
            */
            //$("#total_" + id).text(total_salary);

          

            let totalA = 0;
            $('.sum').each(function() 
            {
               totalA  += parseFloat($(this).text(),10);
            })



            let fee = 0;
            if(parseInt($('#fee').val())  > 0)
            {
                fee  =  parseFloat($('#fee').val()).toFixed(2);
            }


            let discount = 0;
            if(parseFloat($('#discount').val())> 0)
            {
                discount = parseFloat($('#discount').val()).toFixed(2);
            }
            
            let toalAmount = parseFloat(totalA) + parseFloat(fee) - parseFloat(discount);
                if(toalAmount == 'NaN')
                {
                    //alert(toalAmount);
                }
                toalAmount = (toalAmount.toFixed(2))
            $('#sumResult').text(toalAmount);
            $('#sumTotalAmount').val(toalAmount);
        });


            let total2 = 0;
            $('.sum').each(function() 
            {
                total2 += parseFloat($(this).text());
            })
            total2 = (total2.toFixed(2));
            $('#sumResult').text(total2);
            $('#sumTotalAmount').val(total2);
          
    });
</script>



<script>
    $(document).ready(function(){
        $('#showCart').on('click',function(e){
            e.preventDefault();
           let url = $(this).data('url'); 
            $.ajax({
                url:url,
                datatype:'html',
                success:function(response)
                {   
                    $('#showResult').html(response);
                    $('.orderNow').show();
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
