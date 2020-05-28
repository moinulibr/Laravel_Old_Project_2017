<?php
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('db-backup', function(){
    Artisan::call('backup:run'); 
    return "done";
});

Route::get('/all-clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


/*
    Route::get('/', function () {
    return view('welcome');
    });
 */
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('database-backup','HomeController@dbBackup')->name('dbBackup');
Route::get('database-backup-run','HomeController@databaseBackRun')->name('databaseBackRun');
Route::get('database-backup-download/{getFileName}','HomeController@dbBackupDownload')->name('dbBackupDownload');
Route::get('database-backup-delete/{getFileName}','HomeController@dbBackupDelete')->name('dbBackupDelete');

            #,'routeCheck'
Route::group(['middleware' => ['auth','routeCheck']], function () 
{
    #,'middleware' => ['auth','admin']
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\AllUser'],function(){
        Route::resource('user', 'AllUserController');

        Route::get('user/create/{type?}', 'AllUserController@createFrom')->name('userCreateFrom');
        Route::get('user/edit/{type?}/{id}', 'AllUserController@editFrom')->name('userEditFrom');
        Route::get('user/delete/{type?}/{id}', 'AllUserController@delete')->name('userDeleteFrom');
    });

    /*
    |---------------------------
    | Employee
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\AllUser\Employee'],function(){
        Route::resource('employee', 'EmployeeController');
        Route::get('employee-print/{id}', 'EmployeeController@printAll')->name('employee.print');
    });


    /*
    |---------------------------
    | Supplier
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\AllUser\Supplier'],function(){
        Route::resource('supplier', 'SupplierController');
        Route::get('supplier-print/{id}', 'SupplierController@printAll')->name('supplier.print');
    });

    /*
    |---------------------------
    | Client
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\AllUser\Client'],function(){
        Route::resource('client', 'ClientController');
        Route::get('client-print/{id}', 'ClientController@printAll')->name('client.print');
    });



    /*
    |---------------------------
    | Account
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Account'],function(){
        Route::resource('account', 'AccountController');
        Route::get('account-delete/{id}','AccountController@delete')->name('account.delete');
        Route::get('account-print-all/{id}','AccountController@printAll')->name('account.print-all');
        Route::get('account-download-all/{id}','AccountController@downloadAll')->name('account.download-all');
    });


    /*
    |---------------------------
    | product
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Product\Product'],function(){
        Route::resource('product', 'ProductController');
        Route::get('product-delete/{id}','ProductController@delete')->name('product.delete');
    });


    /*
    |---------------------------
    | product Category
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Product\ProductCategory'],function(){
        Route::resource('product-category', 'ProductCategoryController');
        Route::get('product-category-delete/{id}','ProductCategoryController@delete')->name('product-category.delete');
    });


    /*
    |---------------------------
    | Transaction Expense
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Transaction\Expense'],function(){
        Route::resource('transaction-expense', 'ExpenseController');

        #ajax
        Route::get('transaction-category-type','ExpenseController@transaction_category_type')->name('transaction_category_type');
       
        Route::get('transaction-expense-payment/{id}','ExpenseController@expensePayment')->name('transaction.expense.receive-payment');
        Route::get('transaction-expense-payment-method','ExpenseController@expensePaymentMethod')->name('transaction.expense-bill.payment-method');
        Route::post('transaction-expense-payment-process','ExpenseController@expensePaymentProcess')->name('transaction.expense.payment-process');
        Route::get('transaction-expense-delete/{id}','ExpenseController@delete')->name('transaction.expense.delete');
    });

    /*
    |---------------------------
    |Transaction Purchase
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Transaction\Purchase'],function(){
        Route::resource('transaction-purchase', 'PurchaseController');

        Route::post('transaction-purchase-add-to-cart','PurchaseController@purchaseAddToCart')->name('transaction.purchase-add-to-cart-ajax');
        Route::get('transaction-purchase-add-to-cart-single-update','PurchaseController@purchaseAddToCartSingleUpdate')->name('transaction.purchase-add-to-single-update');
        Route::get('transaction-purchase-add-to-cart-show-cart','PurchaseController@purchaseAddToCartShowCart')->name('transaction.purchase-add-to-show-cart');
        Route::get('transaction-purchase-add-to-cart-cancel-process','PurchaseController@purchaseAddToCartCancelProcess')->name('transaction.purchase-add-to-cancel-process');
        Route::get('transaction-purchase-add-to-cart-single-remove','PurchaseController@purchaseAddToCartSingleRemove')->name('transaction.purchase-add-to-single-remove');
    
        Route::get('transaction-purchase-receive-payment/{id}','PurchaseController@purchaseReceivePayment')->name('transaction.purchase.receive-payment');
        Route::get('transaction-purchase-receive-payment-method','PurchaseController@purchaseReceivePaymentMethod')->name('transaction.purchase.receive-payment-method');
    
        Route::post('transaction-purchase-payment-process','PurchaseController@purchasePaymentProcess')->name('transaction.purchase.payment-process');

        Route::get('transaction-purchase-delete/{id}','PurchaseController@delete')->name('transaction.purchase.delete');
    });


    /*
    |---------------------------
    |Transaction Sale
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Transaction\Sale'],function(){
        Route::resource('transaction-sale', 'SaleController');
        Route::get('transaction-sale-delivery-note/{id}','SaleController@viewDeliveryNote')->name('transaction.sale.viewDeliveryNote');

        Route::post('transaction-sale-add-to-cart','SaleController@saleAddToCart')->name('transaction.sale-add-to-cart-ajax');
        Route::get('transaction-sale-add-to-cart-show-cart','SaleController@saleAddToCartShowCart')->name('transaction.sale-add-to-show-cart');
        Route::get('transaction-sale-add-to-cart-cancel-process','SaleController@saleAddToCartCancelProcess')->name('transaction.sale-add-to-cancel-process');
        Route::get('transaction-sale-add-to-cart-single-remove','SaleController@saleAddToCartSingleRemove')->name('transaction.sale-add-to-single-remove');
        Route::get('transaction-sale-add-to-cart-single-update','SaleController@saleAddToCartSingleUpdate')->name('transaction.sale-add-to-single-update');
    
        
        Route::get('transaction-sale-receive-payment/{id}','SaleController@saleReceivePayment')->name('transaction.sale.receive-payment');
        Route::get('transaction-sale-receive-payment-method','SaleController@saleReceivePaymentMethod')->name('transaction.sale.receive-payment-method');
    
        Route::post('transaction-sale-payment-process','SaleController@salePaymentProcess')->name('transaction.sale.payment-process');

        Route::get('transaction-sale-delete/{id}','SaleController@delete')->name('transaction.sale.delete');
    });

    /*
    |---------------------------
    |Transaction Category
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Transaction\TransactionCategory'],function(){
        Route::resource('transaction-category', 'TransactionCategoryController');
        Route::get('transaction-category-delete/{id}','TransactionCategoryController@delete')->name('transaction-category.delete');
    });



    
    /*
    |---------------------------
    |User Role Management
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('user-role', 'RoleController');
        Route::get('user-role-delete/{id}','RoleController@delete')->name('user-role.delete');
    });

    /*
    |---------------------------
    |User Role Module  Management
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('user-role-module', 'UserRoleModuleController');
        Route::get('module-delete/{id}','UserRoleModuleController@delete')->name('user-role-module.delete');
    });

    
    /*
    |---------------------------
    |User Role Module Action Management 
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('user-role-module-action', 'UserRoleModuleActionController');
        Route::get('module-action-delete/{id}','UserRoleModuleActionController@delete')->name('user-role-module-action.delete');
    });


    /*
    |---------------------------
    |User Role Module Action Permition Management 
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('role-module-action-permition', 'UserRoleModuleActionPermitionController');
        Route::get('module-action-permition-delete/{id}','UserRoleModuleActionPermitionController@delete')->name('role-module-action-permition.delete');
    });

    /*
    |---------------------------
    |User Role Menu Title Management 
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('role-menu-title', 'UserRoleMenuTitleController');
        Route::get('user-role-menu-title-delete/{id}','UserRoleMenuTitleController@delete')->name('role-menu-title.delete');
    });

    /*
    |---------------------------
    |User Role Menu Title Permition Management 
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('role-menu-title-permition', 'UserRoleMenuTitlePermitionController');
        Route::get('user-role-menu-title-permition-delete/{id}','UserRoleMenuTitlePermitionController@delete')->name('role-menu-title-permition.delete');
    });



    /*
    |---------------------------
    |User Role Menu Action  Management 
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('user-role-menu-action', 'UserRoleMenuActionController');
        Route::get('user-role-menu-action-delete/{id}','UserRoleMenuActionController@delete')->name('user-role-menu-action.delete');
    });


    /*
    |---------------------------
    |User Role Menu Action Permition Management 
    |--------------------------
    */
    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\UserRoleManagement'],function(){
        Route::resource('role-menu-action-permition', 'UserRoleMenuActionPermitionController');
        Route::get('user-role-menu-action-permition-delete/{id}','UserRoleMenuActionPermitionController@delete')->name('role-menu-action-permition.delete');
    });




    Route::group(['as'=> 'admin.', 'prefix'=>'admin' , 'namespace' => 'Backend\Admin\Test'],function(){
        Route::resource('test','TestController');
    });

    
});


    Route::get('try-all','TryController@index')->name('try-all');
    Route::get('download_excel_file','TryController@download_excel_file')->name('download_excel_file');
    Route::post('excel_file_upload','TryController@excel_file_upload')->name('excel_file_upload');

    Route::get('autocomplete','TryController@autocomplete')->name('autocomplete');
    Route::post('autocomplete/Ajax','TryController@autocompleteAjax')->name('autocompleteAjax');
    Route::get('downloadTest','TryController@downloadTest')->name('downloadTest');

      