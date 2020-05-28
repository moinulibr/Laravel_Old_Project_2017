@extends('layouts.app')
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!---#############################################-->
<!--- push some things from here--->
    <!----for title---->
    @push('title')
       Sale Create
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
            <h3>Transaction sale</h3>
        </div>
        <div class="col-sm-12 col-md-8">
            <div style="float:right">
                <ul>
                    <li>Sale create</li>
                    @if(check_menu_button('sales','view'))
                    <li>
                        <a href="{{route('admin.transaction-sale.index')}}">Back</a>
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

     <!-- Breadcubs Area End Here -->
                <!-- Add Expense Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h5>Create Order</h5>
                            </div>
                        </div>
                        <form action="{{route('admin.transaction-sale.store')}}" method="POST" class="new-added-form ">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Order No</label>
                                    <input type="text" value="{{$order_id}}" class="form-control" disabled>
                                    <input name="order_no" type="hidden" value="{{$order_id}}" class="form-control" >
                                </div>
                                 <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Clients</label>
                                    <select name="client_id" class="form-control select2" required>
                                        <option value="">Select Clients</option>
                                       @foreach ($clients as $item)
                                        <option {{ old('client_id') == $item->id ?'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                                       @endforeach
                                    </select> 
                                    @if($errors->has('client_id'))
                                    <span>
                                        <strong style="color:red;">{{ $errors->first('client_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Date Created</label>
                                    <input name="sale_date" type="text" required value="{{ old('sale_date') ?? date('d-m-Y')}}" placeholder="dd-mm-yyyy"  class="form-control air-datepicker" data-position="bottom right"><i class="far fa-calendar-alt"></i>
                                    @if($errors->has('sale_date'))
                                    <span>
                                        <strong style="color:red;">{{ $errors->first('sale_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div  class="table-responsive" style="margin-left:2%;margin-right:2%;height:50px;">
                                    @if(check_menu_button('sales','add-to-cart'))
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
                                    <table class="table display  text-nowrap">
                                        <thead>
                                            <tr>
                                                <th><label class="form-check-label">ID</label></th>
                                                <th>Product/Service</th>
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Unit Price</th>
                                                <th>Amount</th>
                                                <th style="width:12%;text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showResult">
                                            {{-- -
                                                @php
                                                $cart = session()->has('saleCart') ? session()->get('saleCart')  : [];
                                                    //$total = array_sum(array_column($cart,'total_price'));
                                                    $i = 1;
                                                @endphp
                                                @foreach ($cart as $key => $item)
                                                <tr>
                                                <td><label class="form-check-label">#{{ $i++ }}</label></td>
                                                <td>
                                                    {{ $item['product_name'] }}
                                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                                </td>
                                                <td>
                                                    <input id="qty-{{ $item['product_id'] }}" data-unit_price="{{ $item['unit_price'] }}" value="{{ $item['quantity'] }}" type="number" class="clickToGet col-xl-8 col-lg-8 col-12 form-control">
                                                </td>
                                                <td>
                                                    <input value="{{ $item['unit_price'] }}" type="number" disabled class="col-xl-8 col-lg-8 col-12 form-control">
                                                    <input value="{{ $item['unit_price'] }}" type="hidden"  class="col-xl-8 col-lg-8 col-12 form-control">
                                                </td>
                                                <td>
                                                    <span id="set-{{ $item['product_id'] }}" class="sum">
                                                        {{ $item['total_price'] }}
                                                    </span>
                                                </td>
                                                <td>
                                                <a  data-id="{{ $item['product_id'] }}" data-url="{{route('admin.transaction.sale-add-to-single-remove')}}" class="dropdown-item remove_single_sale_cart" href="#"><i class="fas fa-times text-orange-red"></i></a>
                                                </td>
                                                </tr>
                                                @endforeach
                                            --}}

                                            <tr class="discount-rate-row">
                                                <td colspan="4"></td>
                                                <td>Fee</td>
                                                <td>
                                                    <input id="fee" autocomplete="off" name="fee" value="0" type="number"   step="any"  class="col-xl-8 col-lg-8 col-12 form-control">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr class="discount-rate-row">
                                                <td colspan="4"></td>
                                                <td>Discount value</td>
                                                <td>
                                                    <input id="discount" autocomplete="off" name="discount" value="0" type="number"  step="any"  class="col-xl-8 col-lg-8 col-12 form-control">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>Total Amount</td>
                                                <td>৳
                                                     <strong id="sumResult"></strong>
                                                     <input type="hidden" name="final_total" id="sumTotalAmount" value="">
                                                     <input type="hidden" name="total_quantity" id="sumTotalQty" value="">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                           
                               
                                <div class="form-group col-12 mg-t-8">
                                    @if(check_menu_button('sales','store'))
                                    <button style="display:none;"  type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark orderNow ">Order Now</button>
                                    @endif
                                    @if(check_menu_button('sales','cancel-all-add-to-cart'))
                                    <a  href="{{route('admin.transaction.sale-add-to-cancel-process')}}" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Cancel Process</a>
                                    @endif
                                    @php
                                    $cart = session()->has('saleCart') ? session()->get('saleCart')  : [];
                                    @endphp
                                    @if (count( $cart)>0)     
                                    @if(check_menu_button('sales','show-add-to-cart'))
                                    <a data-url="{{route('admin.transaction.sale-add-to-show-cart')}}" id="showCart" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Show Cart</a>
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


            <div id="getUrl" data-url="{{route('admin.transaction.sale-add-to-cart-ajax')}}"></div>






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


        /*==sale update single from add to cart==*/
            $(document).on('click', '.update_single_sale_cart' ,function(ed){
            ed.preventDefault();
            let url = $(this).data('url');
            let product_id = $(this).data('id');
            let id = product_id;
            let quantity = $('#qty-' + id).val();
            let unit_sale_price = $('#utp-' + id).val();
            let description = $('#des-' + id).val();
           $.ajax({
               url:url,
                type:'GET',
                datatype:'html',
                data:{product_id:product_id ,quantity:quantity,unit_sale_price:unit_sale_price,description:description},
                success:function(response)
                {   
                    console.log(response);
                    $('#showResult').html(response);

                },
            });
           
        });
        /*==sale update single from add to cart==*/
    });
</script>

<script>
    $(document).ready(function(){

        $(document).on('keyup , change','.clickToGet, .sale_unit_price, #fee,#discount' ,function(ee){
            ee.preventDefault();
           
            let unit_price = $('.clickToGet').data('unit_price');
            let id = parseInt($(this).attr("id").substr(4));
            let qty = $('#qty-' + id).val();
            let unit_price_custom = $('#utp-' + id).val();
            let sub_total = (unit_price_custom * qty).toFixed(2);
            $("#set-" + id).text(sub_total);
  
            /*
            var sub_total = parseFloat($("#bon_" + id).val());
            var penalty = parseFloat($("#pen_" + id).val());
            var total_salary = salary + bonus - penalty;
            */
            //$("#total_" + id).text(total_salary);

            
            let total_qty = 0;
            $('.clickToGet').each(function() 
            {
                total_qty += parseFloat($(this).val());
            })
            $('#sumTotalQty').val(total_qty);


            let total = 0;
            $('.sum').each(function() 
            {
                total += parseFloat($(this).text());
            })


            let fee = 0;
            if(parseFloat($('#fee').val())  > 0)
            {
                fee  =  parseFloat($('#fee').val()).toFixed(2);
            }

            let discount = 0;
            if(parseFloat($('#discount').val())> 0)
            {
                discount = parseFloat($('#discount').val()).toFixed(2);
            }
            
            let toalAmount = (parseFloat(total)  + parseFloat(fee) - parseFloat(discount));
            toalAmount = (toalAmount.toFixed(2));
            $('#sumResult').text(toalAmount);
            $('#sumTotalAmount').val(toalAmount);
        });



            let total = 0;
            $('.sum').each(function() 
            {
                total += parseFloat($(this).text());
            })
            $('#sumResult').text(total);
            $('#sumTotalAmount').val(total);
         

            let total_qty = 0;
            $('.clickToGet').each(function() 
            {
                total_qty += parseFloat($(this).val());
            })
            $('#sumTotalQty').val(total_qty);  
           
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
