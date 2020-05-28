<!doctype html>
<html class="no-js" lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  
    <!----for title---->
    <title>
        EBUSi &#187;
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

<div class="card height-auto">
    <div class="card-body">
        <!--div class="heading-layout1">
            <div class="item-title">
                <h3>Company Details</h3>
            </div>
        </div-->
        <div class="single-info-details">
            <div class="item-img">
                @if ($supplier->image)
                @if(Storage::disk('public')->exists('user-image/',"{$supplier->id}".$supplier->image))
                <img src="{{ asset('storage/user-image/'.$supplier->id) }}" alt="" height="250" width="250">
                @endif
                @else
                <img src="{{ asset('links') }}/img/figure/user.jpg" alt="Supplier"height="250" width="250">
            @endif
            </div>
            <div class="item-content">
                <div class="info-table table-responsive">
                    <table class="table text-nowrap">
                        <tbody>
                            <tr>
                                <td>Supplier Name:</td>
                                <td class="font-medium text-dark-medium">{{ucfirst($supplier->name)}}</td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td class="font-medium text-dark-medium">{{$supplier->phone}} </td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td class="font-medium text-dark-medium">{{$supplier->email}} </td>
                            </tr>
                            <tr>
                                <td>Clients Address:</td>
                                <td class="font-medium text-dark-medium">{{$supplier->address}}</td>
                            </tr>
                            <tr>
                                <td>Company Name:</td>
                                <td class="font-medium text-dark-medium">{{$supplier->company_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card height-auto mg-t-30">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3> <span>Transaction Details </span>
                    </h3>
                </div>
            </div>
            <div class="table-responsive"   >
                <table class="table display  text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <label class="form-check-label">ID</label>
                            </th>
                            <th>Invoice No.</th>
                            <th>Date</th>
                            <th>Payment From</th>
                            <th>Account No</th>
                            <th>Payable Amount</th>
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase_details as $item)
                        <tr>
                            <td>
                                <label class="form-check-label">#{{ $loop->index +1 }}</label>
                            </td>
                            <td>{{ $item->substr_invoice() }}</td>
                            <td>{{ date('d/m/Y',strtotime($item->purchase_date)) }}</td>
                            <td>
                                @if($item->account_id)
                                    @if($item->account_id == 1) 
                                    <span style="color:green">Cash</span>
                                    @else
                                        @if ($item->accounts->bank_name)
                                        {{ $item->accounts->bank_name }}
                                        @endif
                                    @endif
                                @endif
                                {{-- -
                                @if($item->payment_method_id)
                                    {{ $item->payment_methods->name }}   
                                @endif
                                --}}
                            </td>
                            <td>   
                                @if($item->account_id)
                                    @if ($item->accounts->bank_name)
                                    {{ $item->accounts->account_name ? $item->accounts->account_name:"" }} <br/>
                                    {{ $item->accounts->account_no ? $item->accounts->account_no : ''}} 
                                    @endif
                                @endif
                            </td>
                            <td>৳{{ $item->final_total }}</td>
                            <td>৳ {{ $item->paid_total }}</td>
                            <td>৳ {{ $item->final_total - $item->paid_total }}</td>
                            <td>
                                @if ($item->payment_status == NULL || $item->payment_status == 'Unpaid')
                                <span  style="color:red;">Unpaid</span>
                                @else
                                <span  style="color:green;">Paid</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" style="text-align:right;">Total sum</th>
                            <th>৳ {{ $payableAmount }}</th>
                            <th>৳ {{ $paidAmount }}</th>
                            <th>৳  {{ $payableAmount - $paidAmount }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!---Table responsive end here ---->
        </div>
    </div>
    <!---card body ---->
</div> 

 <!-- page content  End Here -->
 <!--===================================================================================================================================================-->
<!--#*********************************************************End Page content here*****************************************************************#-->
<!--===================================================================================================================================================-->


<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
</body>
</html>
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->

