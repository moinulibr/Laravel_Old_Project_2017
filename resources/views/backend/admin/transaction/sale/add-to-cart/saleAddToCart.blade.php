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
            <input type="hidden" name="product_id[]" value="{{ $item['product_id'] }}">
        </td>
        <td>
            <input type="text" name="description[]"  id="des-{{ $item['product_id'] }}" value="{{ $item['description'] }}" class="col-xl-8 col-lg-8 col-12 form-control">
        </td>
        <td>
            <input name="quantity[]" id="qty-{{ $item['product_id'] }}" data-unit_price="{{ $item['unit_price'] }}" value="{{ $item['quantity'] }}" type="number" step="any" class="clickToGet col-xl-8 col-lg-8 col-12 form-control">
        </td>
        <td>
            <input name="sale_unit_price[]" value="{{ $item['unit_price'] }}" type="number"  step="any"  id="utp-{{ $item['product_id'] }}" class="sale_unit_price col-xl-8 col-lg-8 col-12 form-control">
        </td>
        <td>
            <span id="set-{{ $item['product_id'] }}" class="sum">
                {{ $item['total_price'] }}
            </span>
        </td>
        <td>
            <div class="row">
                <div class="col-6" style="text-align: center;">
                    @if(check_menu_button('sales','update-single-add-to-cart'))
                    <a  data-id="{{ $item['product_id'] }}" data-url="{{route('admin.transaction.sale-add-to-single-update')}}"  class="dropdown-item  update_single_sale_cart" href="#" style="width:100%;text-align: center;"><i class="fas fa-check text-green"></i></a>
                    @endif
                </div>
                <div class="col-6" style="text-align: center;">
                    @if(check_menu_button('sales','cancel-single-add-to-cart'))
                    <a  data-id="{{ $item['product_id'] }}" data-url="{{route('admin.transaction.sale-add-to-single-remove')}}" class="dropdown-item remove_single_sale_cart" href="#" style="width:100%;text-align: center;"><i class="fas fa-times text-orange-red"></i></a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    <tr class="discount-rate-row">
        <td colspan="4"></td>
        <td>Fee</td>
        <td><input id="fee" name="fee" value="0" type="text"  class="col-xl-8 col-lg-8 col-12 form-control"></td>
        <td></td>
    </tr>
    <tr class="discount-rate-row">
        <td colspan="4"></td>
        <td>Discount value</td>
        <td><input id="discount" name="discount" value="0" type="text" class="col-xl-8 col-lg-8 col-12 form-control"></td>
        <td></td>
    </tr>


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
        $(document).ready(function(){
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






