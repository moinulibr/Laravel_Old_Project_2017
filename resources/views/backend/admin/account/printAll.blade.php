<!doctype html>
<html class="no-js" lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  
    <!----for title---->
    <title>
        EBUSi &#187; View Account
    </title>
    <!----for title---->

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('links')}}/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('links')}}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('links')}}/style.css">
    

</head>
<body>

<!--===================================================================================================================================================-->
<!--#*********************************************************Start Page content here*****************************************************************#-->  
<!--===================================================================================================================================================-->
<!-- page content  Start Here -->

    <!-- Student Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h5>Account Details</h5>
                </div>
            </div>
            <div class="single-info-details">
                <!--div class="item-img">
                    <img src="../img/figure/student1.jpg" alt="student">
                </div-->
                <div class="item-content">
                    <div class="info-table table-responsive"  id="toprint">
                        <table class="table text-nowrap">
                            <tbody>
                                {{-- 
                                <tr>
                                    <td>Account For :</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ $account->account_for_users->name }}
                                    </td>
                                </tr>
                                --}}
                                <tr>
                                    <td>Payment method/Account Type :</td>
                                    <td class="font-medium text-dark-medium">
                                        @if ($account->payment_method_id == 'mobile banking')
                                        <span style="color:green;">
                                            {{ ucfirst($account->mobile_payment_types->name) }}
                                        </span>
                                            @else
                                            {{ ucfirst($account->payment_methods->name) }}
                                        @endif
                                    </td>
                                </tr>

                                @if ($account->payment_method_id != 1)
                                <tr>
                                    <td>Account Name:</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ ucfirst($account->account_name) }}
                                    </td>
                                </tr>
                                <tr>
                                    <tr>
                                        <td>Account No :</td>
                                        <td class="font-medium text-dark-medium">
                                            {{ ucfirst($account->account_no) }}
                                        </td>
                                    </tr>
                                    <td>Bank Name :</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ ucfirst($account->bank_name) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bank Address :</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ ucfirst($account->bank_address) }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Opening Balance :</td>
                                    <td class="font-medium text-dark-medium">
                                        ৳ {{ $account->amount }}
                                    </td>
                                </tr>
                                <tr style="border-top: none; background-color:lawngreen;">
                                    <th>Available Balance :</th>
                                    <th class="font-medium text-dark-medium">
                                        ৳ 
                                        {{ number_format((float)($account->amount + $saleTotal + $incomeTotal) - ( $purchaseTotal+$expensTotal), 2, '.', '') }}
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table text-nowrap table-bordered" style="border-top: none; background-color:gainsboro;">
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <th style="text-align: center" colspan=6">Summary</th>
                            </tr>
                            <tr style="background-color:cyan;">
                                <th style="with:10%;">Total Sale</th>
                                <th> ৳
                                    {{ number_format((float)($saleTotal), 2, '.', '') }}
                                </th>
                                <th style="with:15%;">Others Income</th>
                                <th> ৳ 
                                    {{ number_format((float)($incomeTotal), 2, '.', '') }}
                                </th>
                                <th style="with:15%;">Total</th>
                                <th> ৳
                                    {{ number_format((float)($saleTotal + $incomeTotal), 2, '.', '') }}
                                </th>
                            </tr>
                            <tr style="background-color:gold;">
                                <th style="with:15%;">Total Purchase</th>
                                <th> ৳ 
                                    {{ number_format((float)($purchaseTotal), 2, '.', '') }}
                                </th>
                                <th style="with:15%;">Total Expense</th>
                                <th> ৳
                                    {{ number_format((float)($expensTotal), 2, '.', '') }}
                                </th>
                                <th style="with:10%;">Total</th>
                                <th> ৳
                                    {{ number_format((float)($expensTotal + $purchaseTotal), 2, '.', '') }}
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


            <div class="card height-auto mg-t-30"  id="toprintSale">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Details (Sale)</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <label class="form-check-label">ID</label>
                                </th>
                                <th>Invoice No.</th>
                                <th>Date</th>
                                <th>Receive from</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saleDetails as $item)
                            <tr>
                                <td>
                                    <label class="form-check-label">#{{$loop->index +1}}</label>
                                </td>
                                <td>{{ $item->order_no }}</td>
                                <td>
                                    @if ($item->client_id)
                                    {{ date('d/m/Y',strtotime($item->final_sales->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->client_id)
                                        {{ $item->final_sales->users->name }} <span style="color:green"></span>
                                        @else
                                        {{ $item->final_sales->users->name }} <span style="color:red"></span>
                                    @endif
                                </td>
                                <td>৳ 
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Income</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Sale</td>
                                <td>৳
                                    {{ number_format((float)($saleTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>


            <div class="card height-auto mg-t-30">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Income (Others)</h5>
                    </div>
                </div>
                <div class="table-responsive"  id="toprintDetails">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <label class="form-check-label">ID</label>
                                </th>
                                <th>Reference No.</th>
                                <th>Date</th>
                                <th>Income Category</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomeDetails as $item)
                            <tr>
                                <td>
                                    <label class="form-check-label">#{{$loop->index +1}}</label>
                                </td>
                                <td>{{ $item->reference_no }}</td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ date('d/m/Y',strtotime($item->final_expenses->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ $item->final_expenses->categories->name }}
                                    @endif
                                </td>
                                <td>৳ 
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Cash In</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Expense</td>
                                <td>৳
                                    {{ number_format((float)($expensTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>


            <div class="card height-auto mg-t-30" >
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Details (Purchase)</h5>
                    </div>
                </div>
                <div class="table-responsive" id="toprint">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <label class="form-check-label">ID</label>
                                </th>
                                <th>Reference No.</th>
                                <th>Date</th>
                                <th>Pay to</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseDettail as $item)
                            <tr>
                                <td>
                                    <label class="form-check-label">#{{$loop->index +1}}</label>
                                </td>
                                <td>{{ $item->substr_invoice() }}</td>
                                <td>
                                    @if ($item->supplier_id)
                                    {{ date('d/m/Y',strtotime($item->final_purchases->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->supplier_id)
                                        {{ $item->final_purchases->users->name }} <span style="color:green"></span>
                                        @else
                                        {{ $item->final_purchases->users->name }} <span style="color:red"></span>
                                    @endif
                                </td>
                                <td>৳
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Cash Out</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Purchase</td>
                                <td>৳
                                    {{ number_format((float)($purchaseTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>



            <div class="card height-auto mg-t-30">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Details (Expense)</h5>
                    </div>
                </div>
                <div class="table-responsive"  id="toprintDetails">
                    <table class="table display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <label class="form-check-label">ID</label>
                                </th>
                                <th>Reference No.</th>
                                <th>Date</th>
                                <th>Expense Category</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expensDetails as $item)
                            <tr>
                                <td>
                                    <label class="form-check-label">#{{$loop->index +1}}</label>
                                </td>
                                <td>{{ $item->reference_no }}</td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ date('d/m/Y',strtotime($item->final_expenses->payment_date)) }}
                                    @else
                                    @endif
                                   </td>
                                <td>
                                    @if ($item->reference_no)
                                    {{ $item->final_expenses->categories->name }}
                                    @endif
                                </td>
                                <td>৳ 
                                    {{ number_format((float)($item->paid_total), 2, '.', '') }}
                                </td>
                                <td>Cash Out</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Expense</td>
                                <td>৳
                                    {{ number_format((float)($expensTotal), 2, '.', '') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---Table responsive end here ---->
            </div>


        </div>
        <!---card body ---->
    </div>
    <!-- Student Details Area End Here -->  

 <!-- page content  End Here -->
 <!--===================================================================================================================================================-->
<!--#*********************************************************End Page content here*****************************************************************#-->
<!--===================================================================================================================================================-->









<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->

</body>
</html>
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->

