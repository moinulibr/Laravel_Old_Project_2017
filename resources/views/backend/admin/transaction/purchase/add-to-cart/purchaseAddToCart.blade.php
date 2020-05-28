    @php
    $cart = session()->has('purchaseCart') ? session()->get('purchaseCart')  : [];
        //$total = array_sum(array_column($cart,'total_price'));
        $i = 1;
    @endphp
    @foreach ($cart as $key => $item)
    <tr>
        <td><label class="form-check-label">#{{ $i++ }}</label></td>
        <td>
            {{ $item['product_name'] }}
            <input type="hidden" name="product_id[]" value="{{ $item['product_id'] }}">
        </td>
        <td>
        <input type="text" name="description[]" value="{{ $item['description']}}"  id="des-{{ $item['product_id'] }}" class="col-xl-8 col-lg-8 col-12 form-control">
            @if($errors->has('discription.*'))
            <ul>
               @foreach($errors->get('discription.*') as $errors)
                   @foreach($errors as $error)
                       <li>{{ $error }}</li>
                   @endforeach
               @endforeach
            </ul>
            @endif
        </td>
        <td>
            <input name="quantity[]" id="qty-{{ $item['product_id'] }}"   value="{{ $item['quantity'] }}"  step="any"  type="number" class="clickToGet col-xl-8 col-lg-8 col-12 form-control">
        </td>
        <td>
            <input  name="purchase_unit_price[]" value="{{ $item['purchase_unit_price']}}"  type="number" id="unp-{{ $item['product_id'] }}"   step="any"  class="clickToGet  purchase_unit_price  col-xl-8 col-lg-8 col-12 form-control">
            
            <input  value="" type="hidden"  class="col-xl-8 col-lg-8 col-12 form-control">
        </td>
        <td>
            <input name="sale_unit_price[]" id="sup-{{ $item['product_id'] }}"  value="{{ $item['sale_unit_price'] }}" type="number"   step="any"  class="col-xl-8 col-lg-8 col-12 form-control">
        </td>
        <td>
            <span id="set-{{ $item['product_id'] }}"  class="sum">{{ $item['total_price'] }}</span>
            <input type="hidden" value="{{ $item['total_price'] }}" name="" id="set_val-{{ $item['product_id'] }}">
        </td>
        <td>
            <div class="row">
                <div class="col-6">
                    @if(check_menu_button('purchases','update-single-add-to-cart-purchase'))
                    <a data-id="{{ $item['product_id'] }}" data-url="{{route('admin.transaction.purchase-add-to-single-update')}}" class="dropdown-item update_single_sale_cart" href="#"><i class="fas fa-check text-green"></i></a>
                    @endif
                </div>
                <div class="col-6">
                    @if(check_menu_button('purchases','cancel-single-add-to-cart-purchase'))
                    <a data-id="{{ $item['product_id'] }}" data-url="{{route('admin.transaction.purchase-add-to-single-remove')}}" class="dropdown-item remove_single_sale_cart" href="#"><i class="fas fa-times text-orange-red"></i></a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
    @endforeach
   
    <script>
          $(document).ready(function(){
            let total = 0;
            $('.sum').each(function() 
            {
                total += parseFloat($(this).text());
            })
            total = (total.toFixed(2));
            $('#sumResult').text(total);
            $('#sumTotalAmount').val(total);
          });
    </script>

{{-- -
    @php
        $cart = session()->has('cart') ? session()->get('cart')  : [];
            //$total = array_sum(array_column($cart,'total_price'));
    @endphp
        @if (empty($cart))
            <tr>
                <td colspan="4" style="text-align:center; color:red;">
                    <span >
                        No Product Added!
                    </span>
                </td>
            </tr>
            @else
            @foreach ($cart as $key => $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td>
                    <input value="{{ $item['quantity'] }}" name="qty" id="qty-{{ $item['product_id'] }}" class="clickToGet" type="text" style="width:100%;">
                </td>
                <td><span class="clickToGet" id="price-{{ $item['product_id'] }}">{{ $item['unit_price'] }}</span></td>
                <td><span id="set-{{ $item['product_id'] }}">{{ $item['total_price'] }}</span></td>
                <td>
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                        <button type="submit" style="margin-top:-3%;"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align:center; color:red;">
                <a href="" class="btn btn-danger btn-sm pull-right" style="margin-bottom:-4%;">
                        Cart Clear
                </a>
                </td>
            </tr>
    @endif

    <tr>
        <td><label class="form-check-label">#2</label></td>
        <td>

        </td>
        <td><input type="text" placeholder="" class="col-xl-8 col-lg-8 col-12 form-control"></td>
        <td><input type="text" placeholder="৳ 0.00" class="col-xl-8 col-lg-8 col-12 form-control"></td>
        <td>৳ 1000.00</td>
        <td><a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i></a></td>
    </tr>
--}}



    <script>
        /*
        $(document).ready(function(){
            let total = 0;
            $('.sum').each(function() 
            {
                total += parseFloat($(this).val());
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
        */
    </script>






 <script type="text/javascript">
 /*
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    $(document).ready(function(){
        /*== sale add to cart==*/
        /*
        $('#product_id').on('change',function(e){
            e.preventDefault();
           let product_id = $(this).val();
           let url = $('#getUrl').data('url'); 
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
            /*== sale add to cart end==*/


        /*==sale remove single from add to cart==*/
        /*
            $('.remove_single_sale_cart').on('click',function(eee){
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
                    console.log(response);
                },
            });
        });
        /*==sale remove single from add to cart==*/
        /*
    }); /*


    $(document).ready(function(){
        $('.clickToGet,#fee,#discount').on('keyup , change',function(ee){
            ee.preventDefault();
            let unit_price = $(this).data('unit_price');
            let qty = $(this).val();
            let id = parseInt($(this).attr("id").substr(4));
            let sub_total = unit_price * qty;
            $("#set-" + id).text(sub_total);
            /*
            var sub_total = parseFloat($("#bon_" + id).val());
            var penalty = parseFloat($("#pen_" + id).val());
            var total_salary = salary + bonus - penalty;
            */
            //$("#total_" + id).text(total_salary);
            /*
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
            if(parseInt($('#fee').val())  > 0)
            {
                fee  =  parseInt($('#fee').val());
            }
            let discount = 0;
            if(parseInt($('#discount').val())> 0)
            {
                discount = parseInt($('#discount').val());
            }
            
            let toalAmount = parseInt(total)  + parseInt(fee) - parseInt(discount);
            
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
    */
</script>
