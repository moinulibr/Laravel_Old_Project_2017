<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
         <div class="header-logo">
             <a href="/dashboard"><img src="{{asset('links')}}/img/ebusi-logo.png" alt="logo"></a>
         </div>
    </div>

     <div class="sidebar-menu-content">
         <ul class="nav nav-sidebar-menu sidebar-toggle-view " id="submenu_toggle">
             <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
             </li>
 
             <li class="nav-item">
                <a href="{{route('dbBackup')}}" class="nav-link"><i class="flaticon-dashboard"></i><span>DB Backup</span></a>
             </li>
 
             @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['account']['show']))
             @if(check_menu_button('accounts','view'))
                <li class="nav-item">
                    <a href="{{route('admin.account.index')}}" class="nav-link"><i class="fas fa-landmark"></i><span>Accounts</span></a>
                </li>
                @endif  
            @endif  
             
            @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['client']['show']))
            @if(check_menu_button('clients','view'))
                <li class="nav-item">
                    <a href="{{route('admin.client.index')}}" class="nav-link"><i class="fas fa-street-view"></i><span>Clients</span></a>
                </li>
            @endif
            @endif

            @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['supplier']['show']))
            @if(check_menu_button('suppliers','view')) 
                <li class="nav-item">
                    <a href="{{route('admin.supplier.index')}}" class="nav-link"><i class="fas fa-truck-moving"></i><span>Suppliers</span></a>
                </li>
            @endif
            @endif

            @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['product']['show']))
             <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="fas fa-shopping-basket"></i><span>Products</span></a>
                 <ul class="nav sub-group-menu">
                    @if(check_menu_button('products','view')) 
                     <li class="nav-item">
                        <a  href="{{route('admin.product.index')}}" class=" nav-link"><i class="fas fa-angle-right"></i>All Products</a>
                    </li>
                    @endif
                    @if(check_menu_button('product_categories','view'))
                     <li class="nav-item">
                        <a href="{{route('admin.product-category.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Products Categories</a>
                     </li>
                    @endif
                 </ul>
             </li>
            @endif
       
            @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['transaction']['show']))
            <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="fas fa-file-invoice-dollar"></i><span>Transactions</span></a>
                 <ul class="nav sub-group-menu">
                    @if(check_menu_button('sales','view'))
                     <li class="nav-item">
                         <a href="{{route('admin.transaction-sale.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Sales</a>
                     </li>
                    @endif
                    @if(check_menu_button('expenses','view'))
                     <li class="nav-item">
                        <a href="{{route('admin.transaction-expense.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Income / Expense</a>
                     </li>
                    @endif
                    @if(check_menu_button('purchases','view'))
                    <li class="nav-item">
                         <a href="{{route('admin.transaction-purchase.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Purchases</a>
                    </li>
                    @endif
                    @if(check_menu_button('transaction_categories','view'))
                     <li class="nav-item">
                         <a href="{{route('admin.transaction-category.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Categories</a>
                     </li>
                    @endif
                 </ul>
             </li>
            @endif
            @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['user']['show']))
             <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>User</span></a>
                 <ul class="nav sub-group-menu">
                    @if(check_menu_button('employees','view'))
                     <li class="nav-item">
                         <a href="{{route('admin.employee.index')}}"  class="nav-link"><i class="fas fa-angle-right"></i>Users <small>(employees)</small></a>
                     </li>
                    @endif
                 </ul>
             </li>
            @endif

            @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['user_role']['show']))
             <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>User Role Manage</span></a>
                 <ul class="nav sub-group-menu">
                    @if(check_menu_button('user_roles','view'))
                     <li class="nav-item">
                         <a href="{{ route('admin.user-role.index') }}" class="nav-link"><i class="fas fa-angle-right"></i>User Role</a>
                     </li>
                    @endif
               
                    @if(check_menu_button('only_deleloper','view'))
                    <li class="nav-item">
                         <a href="{{ route('admin.user-role-module.index') }}" class="nav-link"><i class="fas fa-angle-right"></i>Role Module & Action</a>
                    </li>
                    @endif

                    @if(menuEnableType =="button")
                        @if(check_menu_button('module_action_permissions','view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.role-module-action-permition.index') }}" class="nav-link"><i class="fas fa-angle-right"></i>Module Permission</a>
                        </li>
                        @endif
                    @endif

                    @if(check_menu_button('only_deleloper','view'))
                     <li class="nav-item">
                         <a href="{{ route('admin.role-menu-title.index') }}" class="nav-link"><i class="fas fa-angle-right"></i>User Role Menu Title</a>
                     </li>
                    @endif

                    @if(check_menu_button('menu_title_permissions','view'))
                     <li class="nav-item">
                         <a href="{{ route('admin.role-menu-title-permition.index') }}" class="nav-link"><i class="fas fa-angle-right"></i>Menu Title Permission</a>
                     </li>
                    @endif

                    @if(check_menu_button('only_deleloper','view'))
                    <li class="nav-item">
                         <a href="{{ route('admin.user-role-menu-action.index') }}" class="nav-link"><i class="fas fa-angle-right"></i>User Role Menu Action</a>
                    </li>
                    @endif
                    @if(check_menu_button('menu_action_permissions','view'))
                    <li class="nav-item">
                         <a href="{{ route('admin.role-menu-action-permition.index') }}" class="nav-link"><i class="fas fa-angle-right"></i>Menu Action Permission</a>
                    </li>
                   @endif
                    <!----------------------------------------------->
                 </ul>
             </li>
            @endif


            @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['user_role']['show']))
             <li class="nav-item">
                 <a href="" class="nav-link"><i class="flaticon-settings"></i><span>Settings</span></a>
             </li>
             @endif
             @if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['user_role']['show']))
             <li class="nav-item">
                 <a href="" class="nav-link"><i class="fas fa-dice"></i><span>Add-ons</span></a>
             </li>
             @endif

             <li class="nav-item">
                <a href="{{ route('try-all') }}" class="nav-link"><i class="fas fa-dice"></i><span>Try All</span></a>
            </li>
            

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Pathology Test</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.test.index') }}"  class="nav-link"><i class="fas fa-angle-right"></i>Make Test For Patient</a>
                    </li>
                </ul>
            </li>

            {{-- 
             <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="fas fa-file-invoice-dollar"></i><span>Invoice & Billing</span></a>
                 <ul class="nav sub-group-menu">
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Dashboard</a>
                     </li>
                     
                     <li class="nav-item">
                         <a href="/login/accounting/add-invoice.php" class="nav-link"><i class="fas fa-angle-right"></i>Add Invoice</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/accounting/all-invoice.php" class="nav-link"><i class="fas fa-angle-right"></i>All Invoice</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Add Clients</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All Clients</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/accounting/add-income-expense.php" class="nav-link"><i class="fas fa-angle-right"></i>Add Income/Expense</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/accounting/all-income-expense.php" class="nav-link"><i class="fas fa-angle-right"></i>All Income/Expense</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/account/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Add Accounts</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/account/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All Accounts</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Settings</a>
                     </li>
                 </ul>
             </li>

             <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="fas fa-file-invoice-dollar"></i><span>HR & Payroll</span></a>
                 <ul class="nav sub-group-menu">
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Dashboard</a>
                     </li>
                     
                     <!-- HR Start-->
                     <li class="nav-item">
                         <a href="/login/accounting/add-invoice.php" class="nav-link"><i class="fas fa-angle-right"></i>Company </a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/accounting/all-income-expense.php" class="nav-link"><i class="fas fa-angle-right"></i>Department</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/account/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Designation</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Add Employee</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All Employee</a>
                     </li>
                     <!-- HR End-->
                     
                     <!-- Payroll Start-->
                     <li class="nav-item">
                         <a href="/login/clients/index.php" class="nav-link"><i class="fas fa-angle-right"></i>Employee Attendance/Leave</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/index.php" class="nav-link"><i class="fas fa-angle-right"></i>Employee Performance</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/accounting/add-income-expense.php" class="nav-link"><i class="fas fa-angle-right"></i>Salary</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/account/index.php" class="nav-link"><i class="fas fa-angle-right"></i>Reports</a>
                     </li>
                     <!-- Payroll End-->
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Settings</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="fas fa-file-invoice-dollar"></i><span>Accounting & Inventory</span></a>
                 <ul class="nav sub-group-menu">
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Dashboard</a>
                     </li>
                     
                     <!-- Inventory Start-->
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Products</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Products Categories</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Stock Central</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Purchase Orders</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Purchase Invoice</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Inbound Stock</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Suppliers</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Inventory Logs</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Customers</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Sales Orders</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Sales Invoice</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Salesman</a>
                     </li>
                     <!-- Inventory End-->
                     
                     <!-- Accounting Start-->
                     <li class="nav-item">
                         <a href="/login/account/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Add Accounts</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/account/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All Accounts</a>
                     </li>
                     <li class="nav-item">
                         <a href="/login/account/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Transaction Report</a>
                     </li>
                     <!-- Accounting End-->
                     <li class="nav-item">
                         <a href="/login/clients/add.php" class="nav-link"><i class="fas fa-angle-right"></i>Settings</a>
                     </li>
                 </ul>
             </li>
            --}}
         </ul>
     </div>
 </div>