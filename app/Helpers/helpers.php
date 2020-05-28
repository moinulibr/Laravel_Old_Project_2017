<?php
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_action_permition;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_title_permition;
use App\Model\Backend\Admin\UserRoleManagement\User_role_module_action_permition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



/*
|-----------------------------------------------------------------------------------|
| Index Page Action Permition Check Start                                           |
| Always call this ACTION_BUTTON_CHECK_PERMITION  method in the blade file          |
| like === ACTION_BUTTON_CHECK_PERMITION("view")==                                  |
|-----------------------------------------------------------------------------------|
*/
    $loginEmail = "moinulibr@gmail.com";
    define("developerLogin", $loginEmail);
    $actionLinkable = "menu";#"button";"menu";
    define("menuEnableType", $actionLinkable);

    
    function moduleActionPermition()
    {
       return User_role_module_action_permition::with('moduleAction')
                    ->where('role_id',Auth::user()->role_id)
                    ->where('is_active',1)
                    ->whereNull('is_deleted')
                    ->get();
    }

    function BUTTON_PERMISSION($checker)
    {
        $value= 0 ;
        if(count(moduleActionPermition())>0)
        {
            foreach(moduleActionPermition() as $per)
            {
                if($checker == $per->moduleAction->action_checker_route_or_url)
                {
                    $value = 1;
                    break;
                }
            }
        }
        if(AUth::user()->email ==  developerLogin)
        {
            $value = 1;
        }else{
            $value = $value;
        }
       
        return $value;
    }

/*
|-----------------------------------------------------------------------------------|
| Index Page Action Permition Check End                                             |
|-----------------------------------------------------------------------------------|
*/



/*
|--------------------------------------------------------------------------------------------------------|
| Nav Bar menu checker and route checker with middleware,, its uses like,,                               |
| ==MENU_CHECK_PERMITION(Route::currentRouteName());==                                                   |
|--------------------------------------------------------------------------------------------------------|
*/                                                                                                      
    function menuActionPermistion()
    {
       return User_role_menu_action_permition::with('menuAction')
        ->where('role_id',Auth::user()->role_id)
        ->where('is_active',1)
        ->whereNull('is_deleted')
        ->get();
    }

    function MENU_PERMISSION($checker) #with route with middleware
    {
        $value= 0 ;
        if(count(menuActionPermistion())>0)
        {
            foreach(menuActionPermistion() as $per)
            {
                if($checker == $per->menuAction->action_checker_route_or_url)
                {
                    $value = 1;
                    break;
                }
            }
        }
        if(AUth::user()->email ==  developerLogin)
        {
            $value = 1;
        }else{
            $value = $value;
        }
        return $value;
    }
    /*
    use Illuminate\Support\Facades\Route;
    if(MENU_CHECK_PERMITION(Route::currentRouteName()) || MENU_CHECK_PERMITION($request->path()))
    {
        return true;
    }else{
        return redirect()->back()->with('error','You are not permitted to access this');
    }
    */
/*
|----------------------------------------------------------------------------------------------------------------------|
|------------------------Nav Bar menu checker and route checker with middleware End -----------------------------------|
|----------------------------------------------------------------------------------------------------------------------|
*/


/*
|-----------------------------------------------------------------------------------|
|-------------------      Menu Title Check Start          --------------------------|
|-----------------------------------------------------------------------------------|
*/
    function menuTitlePermistion()
    {
       return User_role_menu_title_permition::with('menuTitle')
        ->where('role_id',Auth::user()->role_id)
        ->where('is_active',1)
        ->whereNull('is_deleted')
        ->get();
    }


    function MENU_TITLE_CHECK_PERMISSION($checker)
    { 
        $value= 0 ;
        if(count(menuTitlePermistion())>0)
        {
            foreach(menuTitlePermistion() as $permission)
            {
                if($checker == $permission->menuTitle->menu_title_checker_route_or_url)
                {
                    $value = 1;
                    break;
                }
            }
        }
        if(AUth::user()->email ==  developerLogin)
        {
            $value = 1;
        }else{
            $value = $value;
        }
        return $value;
    }

/*
|----------------   The End : User Role Module , Role Menu Title , Menue Action Check and others ----------------------
|---------------------------------------------------------------------------------------------------------------------------
|--------------------------------------------------------------------------------------------------------------------------------|
*/






/*
|-------------------------------------------------------------------------------------------------------------------------------
|   The Start : User Role Module Action Checker Use In the Balde FIle.... IN THE EVERY Module /TABLE
|---------------------------------------------------------------------------------------------
|-----------------------------------------------------------------------------------
*/
    #===========================================================================================================================
    # All Modules Action Button Check Start Call like === if(ACTION_BUTTON_CHECK_PERMISSION((modules()['=============================']['view'])))
    #===================================================================================================================
        function buttons()
        {
            $module = [];
            $module = [
                        'accounts' =>
                            [   
                                "view"      => "admin.account.index",
                                "create"    => "admin.account.create",
                                "store"     => "admin.account.store",
                                "edit"      => "admin.account.edit",
                                "update"    => "admin.account.update",
                                "show"      => "admin.account.show",
                                "delete"    => "admin.account.delete",
                                "print_all"    => "admin.account.print-all",
                            ],
                        'clients' =>
                            [
                                "view"      => "admin.client.index",
                                "create"    => "admin.client.create",
                                "store"     => "admin.client.store",
                                "edit"      => "admin.client.edit",
                                "update"    => "admin.client.update",
                                "show"      => "admin.client.show",
                                "delete"    => "admin.client.delete",
                                "print-all" => "admin.client.print",
                            ],
                        'suppliers' =>
                            [
                                "view"      => "admin.supplier.index",
                                "create"    => "admin.supplier.create",
                                "store"     => "admin.supplier.store",
                                "edit"      => "admin.supplier.edit",
                                "update"    => "admin.supplier.update",
                                "show"      => "admin.supplier.show",
                                "delete"    => "admin.supplier.delete",
                                "print-all" => "admin.supplier.print",
                            ],
                        'products' =>
                            [
                                "view"      => "admin.product.index",
                                "create"    => "admin.product.create",
                                "store"     => "admin.product.store",
                                "edit"      => "admin.product.edit",
                                "update"    => "admin.product.update",
                                "show"      => "admin.product.show",
                                "delete"    => "admin.product.delete"
                            ],
                        'product_categories' =>
                            [
                                "view"      => "admin.product-category.index",
                                "create"    => "admin.product-category.create",
                                "store"     => "admin.product-category.store",
                                "edit"      => "admin.product-category.edit",
                                "update"    => "admin.product-category.update",
                                "show"      => "admin.product-category.show",
                                "delete"    => "admin.product-category.delete"
                            ],
                        'sales' =>
                            [
                                "view"      => "admin.transaction-sale.index",
                                "create"    => "admin.transaction-sale.create",
                                "store"     => "admin.transaction-sale.store",
                                "edit"      => "admin.transaction-sale.edit",
                                "update"    => "admin.transaction-sale.update",
                                "show"      => "admin.transaction-sale.show",
                                "delete"    => "admin.transaction.sale.delete",
                                "view-delivery-note" => "admin.transaction.sale.viewDeliveryNote",
                                "add-to-cart" => "admin.transaction.sale-add-to-cart-ajax",
                                "update-single-add-to-cart" => "admin.transaction.sale-add-to-single-update",
                                "cancel-single-add-to-cart" => "admin.transaction.sale-add-to-single-remove",
                                "cancel-all-add-to-cart" => "admin.transaction.sale-add-to-cancel-process",
                                "show-add-to-cart" => "admin.transaction.sale-add-to-show-cart",
                                "payment-receive" => "admin.transaction.sale.receive-payment",
                                "payment-receive-method" => "admin.transaction.sale.receive-payment-method",
                                "payment-receive-process" => "admin.transaction.sale.payment-process",
                            ],
                        'purchases' =>
                            [
                                "view"      => "admin.transaction-purchase.index",
                                "create"    => "admin.transaction-purchase.create",
                                "store"     => "admin.transaction-purchase.store",
                                "edit"      => "admin.transaction-purchase.edit",
                                "update"    => "admin.transaction-purchase.update",
                                "show"      => "admin.transaction-purchase.show",
                                "delete"    => "admin.transaction.purchase.delete",
                                "add-to-cart-purchase" => "admin.transaction.purchase-add-to-cart-ajax",
                                "update-single-add-to-cart-purchase" => "admin.transaction.purchase-add-to-single-update",
                                "show-add-to-cart-purchase" => "admin.transaction.purchase-add-to-show-cart",
                                "cancel-all-add-to-cart-purchase" => "admin.transaction.purchase-add-to-cancel-process",
                                "cancel-single-add-to-cart-purchase" => "admin.transaction.purchase-add-to-single-remove",
                                "purchase-payment" => "admin.transaction.purchase.receive-payment",
                                "purchase-payment-method" => "admin.transaction.purchase.receive-payment-method",
                                "purchase-payment-process" => "admin.transaction.purchase.payment-process",
                            ],
                        'expenses' =>
                            [
                                "view"      => "admin.transaction-expense.index",
                                "create"    => "admin.transaction-expense.create",
                                "store"     => "admin.transaction-expense.store",
                                "edit"      => "admin.transaction-expense.edit",
                                "update"    => "admin.transaction-expense.update",
                                "show"      => "admin.transaction-expense.show",
                                "delete"    => "admin.transaction.expense.delete",
                                "category-type"    => "admin.transaction_category_type",
                                "expense-payment"    => "admin.transaction.expense.receive-payment",
                                "expense-payment-method"    => "admin.transaction.expense-bill.payment-method",
                                "expense-payment-process"    => "admin.transaction.expense.payment-process"
                            ],
                        'transaction_categories' =>
                            [
                                "view"      => "admin.transaction-category.index",
                                "create"    => "admin.transaction-category.create",
                                "store"     => "admin.transaction-category.store",
                                "edit"      => "admin.transaction-category.edit",
                                "update"    => "admin.transaction-category.update",
                                "show"      => "admin.transaction-category.show",
                                "delete"    => "admin.transaction-category.delete"
                            ],
                        'users' =>
                            [
                                "view"      => "admin.user.index",
                                "create"    => "admin.user.create",
                                "store"     => "admin.user.store",
                                "edit"      => "admin.user.edit",
                                "update"    => "admin.user.update",
                                "show"      => "admin.user.show",
                                "delete"    => "admin.user.delete",
                                "user-create"    => "admin.userCreateFrom",
                                "user-edit"    => "admin.userEditFrom",
                                "user-delete"    => "admin.userDeleteFrom",
                            ],
                        'employees' =>
                            [
                                "view"      => "admin.employee.index",
                                "create"    => "admin.employee.create",
                                "store"     => "admin.employee.store",
                                "edit"      => "admin.employee.edit",
                                "update"    => "admin.employee.update",
                                "show"      => "admin.employee.show",
                                "delete"    => "admin.employee.delete",
                                "print-all" => "admin.employee.print",
                            ],
                        'user_roles' =>
                            [
                                "view"      => "admin.user-role.index",
                                "create"    => "admin.user-role.create",
                                "store"     => "admin.user-role.store",
                                "edit"      => "admin.user-role.edit",
                                "update"    => "admin.user-role.update",
                                "show"      => "admin.user-role.show",
                                "delete"    => "admin.user-role.delete"
                            ],
                        'menu_title_permissions' =>
                            [
                                "view"      => "admin.role-menu-title-permition.index",
                                "create"    => "admin.role-menu-title-permition.create",
                                "store"     => "admin.role-menu-title-permition.store",
                                "edit"      => "admin.role-menu-title-permition.edit",
                                "update"    => "admin.role-menu-title-permition.update",
                                "show"      => "admin.role-menu-title-permition.show",
                                "delete"    => "admin.role-menu-title-permition.delete"
                            ],
                        'menu_action_permissions' =>
                            [
                                "view"      => "admin.role-menu-action-permition.index",
                                "create"    => "admin.role-menu-action-permition.create",
                                "store"     => "admin.role-menu-action-permition.store",
                                "edit"      => "admin.role-menu-action-permition.edit",
                                "update"    => "admin.role-menu-action-permition.update",
                                "show"      => "admin.role-menu-action-permition.show",
                                "delete"    => "admin.role-menu-action-permition.delete"
                            ],
                        'module_action_permissions' =>
                            [
                                "view"      => "admin.role-module-action-permition.index",
                                "create"    => "admin.role-module-action-permition.create",
                                "store"     => "admin.role-module-action-permition.store",
                                "edit"      => "admin.role-module-action-permition.edit",
                                "update"    => "admin.role-module-action-permition.update",
                                "show"      => "admin.role-module-action-permition.show",
                                "delete"    => "admin.role-module-action-permition.delete"
                            ],
                        'only_deleloper' =>
                            [
                                "view"      => "only Developer",
                            ],
                    ];
            return $module;
        }
    #==================================================================================================================
    # All Modules Action Button Check End Call Like == modules()['accounts']['view']
    #=========================================================================================================================|






    #===========================================================================================================================|
    # All Menus and Route/Url also Check By Middleware Start == Call Like == menu_with_routes()['accounts']['view']
    #================================================================================================================
        function menu_with_routes()
        {
            $menus = [];
            $menus = [
                        'accounts' =>
                            [   
                                "view"      => "admin.account.index",
                                "create"    => "admin.product.create",
                                "store"     => "admin.account.store",
                                "edit"      => "admin.account.edit",
                                "update"    => "admin.account.update",
                                "show"      => "admin.account.show",
                                "delete"    => "admin.account.delete",
                                "print_all" => "admin.account.print-all",
                            ],
                        'clients' =>
                            [
                                "view"      => "admin.client.index",
                                "create"    => "admin.client.create",
                                "store"     => "admin.client.store",
                                "edit"      => "admin.client.edit",
                                "update"    => "admin.client.update",
                                "show"      => "admin.client.show",
                                "delete"    => "admin.client.delete",
                                "print-all" => "admin.client.print",
                            ],
                        'suppliers' =>
                            [
                                "view"      => "admin.supplier.index",
                                "create"    => "admin.supplier.create",
                                "store"     => "admin.supplier.store",
                                "edit"      => "admin.supplier.edit",
                                "update"    => "admin.supplier.update",
                                "show"      => "admin.supplier.show",
                                "delete"    => "admin.supplier.delete",
                                "print-all" => "admin.supplier.print",
                            ],
                        'products' =>
                            [
                                "view"      => "admin.product.index",
                                "create"    => "admin.product.create",
                                "store"     => "admin.product.store",
                                "edit"      => "admin.product.edit",
                                "update"    => "admin.product.update",
                                "show"      => "admin.product.show",
                                "delete"    => "admin.product.delete"
                            ],
                        'product_categories' =>
                            [
                                "view"      => "admin.product-category.index",
                                "create"    => "admin.product-category.create",
                                "store"     => "admin.product-category.store",
                                "edit"      => "admin.product-category.edit",
                                "update"    => "admin.product-category.update",
                                "show"      => "admin.product-category.show",
                                "delete"    => "admin.product-category.delete"
                            ],
                        'sales' =>
                            [
                                "view"      => "admin.transaction-sale.index",
                                "create"    => "admin.transaction-sale.create",
                                "store"     => "admin.transaction-sale.store",
                                "edit"      => "admin.transaction-sale.edit",
                                "update"    => "admin.transaction-sale.update",
                                "show"      => "admin.transaction-sale.show",
                                "delete"    => "admin.transaction.sale.delete",
                                "view-delivery-note" => "admin.transaction.sale.viewDeliveryNote",
                                "add-to-cart"    => "admin.transaction.sale-add-to-cart-ajax",
                                "update-single-add-to-cart" => "admin.transaction.sale-add-to-single-update",
                                "cancel-single-add-to-cart" => "admin.transaction.sale-add-to-single-remove",
                                "cancel-all-add-to-cart" => "admin.transaction.sale-add-to-cancel-process",
                                "show-add-to-cart" => "admin.transaction.sale-add-to-show-cart",
                                "payment-receive" => "admin.transaction.sale.receive-payment",
                                "payment-receive-method" => "admin.transaction.sale.receive-payment-method",
                                "payment-receive-process" => "admin.transaction.sale.payment-process",
                            ],
                        'purchases' =>
                            [
                                "view"      => "admin.transaction-purchase.index",
                                "create"    => "admin.transaction-purchase.create",
                                "store"     => "admin.transaction-purchase.store",
                                "edit"      => "admin.transaction-purchase.edit",
                                "update"    => "admin.transaction-purchase.update",
                                "show"      => "admin.transaction-purchase.show",
                                "delete"    => "admin.transaction.purchase.delete",
                                "add-to-cart-purchase" => "admin.transaction.purchase-add-to-cart-ajax",
                                "update-single-add-to-cart-purchase" => "admin.transaction.purchase-add-to-single-update",
                                "show-add-to-cart-purchase" => "admin.transaction.purchase-add-to-show-cart",
                                "cancel-all-add-to-cart-purchase" => "admin.transaction.purchase-add-to-cancel-process",
                                "cancel-single-add-to-cart-purchase" => "admin.transaction.purchase-add-to-single-remove",
                                "purchase-payment" => "admin.transaction.purchase.receive-payment",
                                "purchase-payment-method" => "admin.transaction.purchase.receive-payment-method",
                                "purchase-payment-process" => "admin.transaction.purchase.payment-process",
                            ],
                        'expenses' =>
                            [
                                "view"      => "admin.transaction-expense.index",
                                "create"    => "admin.transaction-expense.create",
                                "store"     => "admin.transaction-expense.store",
                                "edit"      => "admin.transaction-expense.edit",
                                "update"    => "admin.transaction-expense.update",
                                "show"      => "admin.transaction-expense.show",
                                "delete"    => "admin.transaction.expense.delete",
                                "category-type"    => "admin.transaction_category_type",
                                "expense-payment"    => "admin.transaction.expense.receive-payment",
                                "expense-payment-method"    => "admin.transaction.expense-bill.payment-method",
                                "expense-payment-process"    => "admin.transaction.expense.payment-process"
                            ],
                        'transaction_categories' =>
                            [
                                "view"      => "admin.transaction-category.index",
                                "create"    => "admin.transaction-category.create",
                                "store"     => "admin.transaction-category.store",
                                "edit"      => "admin.transaction-category.edit",
                                "update"    => "admin.transaction-category.update",
                                "show"      => "admin.transaction-category.show",
                                "delete"    => "admin.transaction-category.delete"
                            ],
                        'users' =>
                            [
                                "view"      => "admin.user.index",
                                "create"    => "admin.user.create",
                                "store"     => "admin.user.store",
                                "edit"      => "admin.user.edit",
                                "update"    => "admin.user.update",
                                "show"      => "admin.user.show",
                                "delete"    => "admin.user.delete",
                                "user-create"    => "admin.userCreateFrom",
                                "user-edit"    => "admin.userEditFrom",
                                "user-delete"    => "admin.userDeleteFrom",
                            ],
                        'employees' =>
                            [
                                "view"      => "admin.employee.index",
                                "create"    => "admin.employee.create",
                                "store"     => "admin.employee.store",
                                "edit"      => "admin.employee.edit",
                                "update"    => "admin.employee.update",
                                "show"      => "admin.employee.show",
                                "delete"    => "admin.employee.delete",
                                "print-all" => "admin.employee.print",
                            ],
                        'user_roles' =>
                            [
                                "view"      => "admin.user-role.index",
                                "create"    => "admin.user-role.create",
                                "store"     => "admin.user-role.store",
                                "edit"      => "admin.user-role.edit",
                                "update"    => "admin.user-role.update",
                                "show"      => "admin.user-role.show",
                                "delete"    => "admin.user-role.delete"
                            ],
                        'menu_title_permissions' =>
                            [
                                "view"      => "admin.role-menu-title-permition.index",
                                "create"    => "admin.role-menu-title-permition.create",
                                "store"     => "admin.role-menu-title-permition.store",
                                "edit"      => "admin.role-menu-title-permition.edit",
                                "update"    => "admin.role-menu-title-permition.update",
                                "show"      => "admin.role-menu-title-permition.show",
                                "delete"    => "admin.role-menu-title-permition.delete"
                            ],
                        'menu_action_permissions' =>
                            [
                                "view"      => "admin.role-menu-action-permition.index",
                                "create"    => "admin.role-menu-action-permition.create",
                                "store"     => "admin.role-menu-action-permition.store",
                                "edit"      => "admin.role-menu-action-permition.edit",
                                "update"    => "admin.role-menu-action-permition.update",
                                "show"      => "admin.role-menu-action-permition.show",
                                "delete"    => "admin.role-menu-action-permition.delete"
                            ],
                        'module_action_permissions' =>
                            [
                                "view"      => "admin.role-module-action-permition.index",
                                "create"    => "admin.role-module-action-permition.create",
                                "store"     => "admin.role-module-action-permition.store",
                                "edit"      => "admin.role-module-action-permition.edit",
                                "update"    => "admin.role-module-action-permition.update",
                                "show"      => "admin.role-module-action-permition.show",
                                "delete"    => "admin.role-module-action-permition.delete"
                            ],
                        'only_deleloper' =>
                            [
                                "view"      => "only Developer",
                            ],
                    ];
            return $menus;
        }
    #==============================================================================================================
    # All Menus and Route/Url also Check By Middleware End == Call Like == menu_with_routes()['accounts']['view']
    #===========================================================================================================================|






    #===========================================================================================================================|
    # All Menus and Route/Url also Check By Middleware Start == Call Like == menu_titles()['account']['show']
    #================================================================================================================
        function menu_titles()
        {
            $menu_title = [];
            $menu_title = [
                        'account' =>
                            [   
                                "show"      => "account",
                            ],
                        'client' =>
                            [
                                "show"      => "client",
                            ],
                        'supplier' =>
                            [
                                "show"      => "supplier",
                            ],
                        'product' =>
                            [
                                "show"      => "product",
                            ],
                        'transaction' =>
                            [
                                "show"      => "transaction",
                            ],
                        'product_category' =>
                            [
                                "show"      => "transaction",
                            ],
                        'sale' =>
                            [
                                "show"      => "sale",
                            ],
                        'purchase' =>
                            [
                                "show"      => "purchase",
                            ],
                        'expense' =>
                            [
                                "show"      => "expense",
                            ],
                        'transaction_category' =>
                            [
                                "show"      => "transaction.category",
                            ],
                        'user' =>
                            [
                                "show"      => "user",
                            ],
                        'user_role' =>
                            [
                                "show"      => "user_role",
                            ],
                        'menu_title_permission' =>
                            [
                                "show"      => "menu_title_permission",
                            ],
                        'menu_action_permission' =>
                            [
                                "show"      => "menu_action_permission",
                            ],
                        'module_action_permission' =>
                            [
                                "show"      => "module_action_permission",
                            ],
                    ];
            return $menu_title;
        }
    #==============================================================================================================
    # All Menus and Route/Url also Check By Middleware End == Call Like == menu_titles()['account']['show'] 
    #if(MENU_TITLE_CHECK_PERMISSION(menu_titles()['account']['show']))
    #===========================================================================================================================|
   
   
   
   
   
   
    #===========================================================================================================================|
    # Apply this in anywhere in the blade fine, here include menu and button also use this like
    #================================================================================================================
    
    function check_menu_button($val , $val2)
    {
        if(menuEnableType == "button")
        {
            if(array_key_exists($val,buttons()))
            {
                if(array_key_exists($val2,buttons()[$val]))
                {
                    if((BUTTON_PERMISSION(buttons()[$val][$val2])))
                    {
                        return true;
                    }
                }
                else{
                    Session::flash('error', 'Your buttons (Value) is not match! please check in the helper file in button function'); 
                    return false;
                }
                
            }else{
                Session::flash('error', 'Your buttons (Index) is not match! please check in the helper file in button function'); 
                return false;
            }
        }
        else
        {
            if(array_key_exists($val,menu_with_routes()))
            {
                if(array_key_exists($val2,menu_with_routes()[$val]))
                {
                    if((MENU_PERMISSION(menu_with_routes()[$val][$val2])))
                    {
                        return true;
                    }
                }
                else{
                    Session::flash('error', 'Your menu_with_routes (Value) is not match! please check in the helper file in menu_with_routes function'); 
                    return false;
                }
                
            }else{
                Session::flash('error', 'Your menu_with_routes (Index) is not match! please check in the helper file in menu_with_routes function'); 
                return false;
            }
        }
    }

   
    #==============================================================================================================
    # Apply this in anywhere in the blade fine, here include menu and button also use this like
    #===========================================================================================================================|













