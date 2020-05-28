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
                                       
                                    </td>
                                </tr>
                          
                                <tr>
                                    <td>Account Name:</td>
                                    <td class="font-medium text-dark-medium">
                                   
                                    </td>
                                </tr>
                                <tr>
                                    <tr>
                                        <td>Account No :</td>
                                        <td class="font-medium text-dark-medium">
                                          
                                        </td>
                                    </tr>
                                    <td>Bank Name :</td>
                                    <td class="font-medium text-dark-medium">
                                     
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bank Address :</td>
                                    <td class="font-medium text-dark-medium">
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>Opening Balance :</td>
                                    <td class="font-medium text-dark-medium">
                                        ৳ 
                                    </td>
                                </tr>
                             
                            </tbody>
                        </table>

                        <table class="table text-nowrap table-bordered" style="border-top: none; background-color:gainsboro;">
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <th style="text-align: center" colspan=6">Summary</th>
                            </tr>
                            <tr>
                                <th style="with:10%;">Total Sale</th>
                                <th> ৳</th>
                                <th style="with:15%;">Total Purchase</th>
                                <th> ৳ </th>
                                <th style="with:15%;">Total Expense</th>
                                <th> ৳ </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card height-auto mg-t-30"  id="toprintSale">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h5>Transaction Details (Sale) </h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered display text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <label class="form-check-label">ID</label>
                                </th>
                                <th>Invoice No.</th>
                                <th>Date</th>
                                <th>Pay to/Receive from</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                      
                            <tr>
                                <td>
                                    <label class="form-check-label">#</label>
                                </td>
                                <td></td>
                                <td>
                                   
                                </td>
                                <td>
                                  
                                </td>
                                <td>৳ </td>
                                <td>Income</td>
                            </tr>
                           
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Sale</td>
                                <td>৳
                                  
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
                    <table class="table display table-bordered text-nowrap">
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
                         
                            <tr>
                                <td>
                                    <label class="form-check-label">#</label>
                                </td>
                                <td></td>
                                <td>
                                   
                                </td>
                                <td>
                                   
                                </td>
                                <td>৳</td>
                                <td>Cash Out</td>
                            </tr>
                         
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Purchase</td>
                                <td>৳
                                 
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
                    <table class="table display table-bordered text-nowrap">
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
                           
                            <tr>
                                <td>
                                    <label class="form-check-label">#</label>
                                </td>
                                <td></td>
                                <td>
                                   
                                   </td>
                                <td>
                                   
                                </td>
                                <td>৳ </td>
                                <td>Cash Out</td>
                            </tr>
                          
                        </tbody>
                        <tfoot>
                            <tr style="background-color:lavender;color:green;font-weight:bold;">
                                <td colspan="3"></td>
                                <td>Total Expense</td>
                                <td>৳
                                   
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




<script>
     $(document).on('change', '#varient_select', function(e){
    e.preventDefault();

    let current_val = $(this).val();
    let i = 0;
    let find_val = $('.varient_row').each(function(){
        if($(this).data('id') == current_val) i++;
    });
    if(i) return;

    let url = $(this).data('url');
    let val = $(this).val();
    $.ajax({
      type: 'POST',
      url,
      data: {varient: val},
      success: function(response){
        if(response.success){
          if($(".varient_row[data-id='"+response.id+"']").length) return;
          $('#variation_selection_body').append(response.html);
          $('#varient_select').val('');
        }
      }
    })
  })

  $(document).on('click', '.remove_varients', function(e){
    e.preventDefault();
    $(this).parents('.varient_table').remove();
  })  
  $(document).on('click', '.remove_varient', function(e){
    e.preventDefault();
    $(this).parents('.varient_row').remove();
  })
</script>




<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
</body>
</html>
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->

