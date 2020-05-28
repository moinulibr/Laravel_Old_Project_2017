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
                @if ($employee->image)
                @if(Storage::disk('public')->exists('user-image/',"{$employee->id}".$employee->image))
                <img src="{{ asset('storage/user-image/'.$employee->id) }}" alt="" height="250" width="250">
                @endif
                @else
                <img src="{{ asset('links') }}/img/figure/user.jpg" alt="Employee"height="250" width="250">
            @endif
            </div>
            <div class="item-content">
                <div class="info-table table-responsive">
                    <table class="table text-nowrap">
                        <tbody>
                            <tr>
                                <td>Employee Name:</td>
                                <td class="font-medium text-dark-medium">
                                    {{ $employee->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Employee Gender:</td>
                                <td class="font-medium text-dark-medium">
                                    {{ $employee->gender }}
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td class="font-medium text-dark-medium"> {{ $employee->phone }} </td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td class="font-medium text-dark-medium"> {{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <td>Blood Group:</td>
                                <td class="font-medium text-dark-medium">{{ $employee->blood_group }}</td>
                            </tr>
                            <tr>
                                <td>Religion:</td>
                                <td class="font-medium text-dark-medium">{{ $employee->religion }}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td class="font-medium text-dark-medium">
                                    {{ $employee->address }}
                                </td>
                            </tr>
                            <tr>
                                <td>ID No:</td>
                                <td class="font-medium text-dark-medium"> {{ $employee->id_no }}</td>
                            </tr>
                            <tr>
                                <td>User Role:</td>
                                <td class="font-medium text-dark-medium">
                                    @if ($employee->role_id)
                                    {{ $employee->roles->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>BIO:</td>
                                <td class="font-medium text-dark-medium">
                                    {{ str_limit($employee->bio, 100) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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

