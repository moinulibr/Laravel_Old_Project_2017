<?php

namespace App;

use App\Model\Backend\Admin\Transaction\Expense\Final_expense;
use App\Model\Backend\Admin\Transaction\Purchase\Detail_purchase;
use App\Model\Backend\Admin\Transaction\Purchase\Final_purchase;
use App\Model\Backend\Admin\Transaction\Sale\Detail_sale;
use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use App\Model\Backend\Admin\TransactionHistory\Total_expense_payment_history;
use App\Model\Backend\Admin\TransactionHistory\Total_sale_payment_history;
use App\Model\Backend\Admin\UserRoleManagement\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','gender','phone','phone_2','phone_3','office_phone','office_phone_2','blood_group','religion','id_no','company_name','address','verified','image','is_deleted','created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userSupplierTransaction()
    {
        return $this->belongsTo(Final_purchase::class,'supplier_id','id');
    }
    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }


    public function userAlreadyToAnotherTable()
    {
       $finalSale       =   Final_sale::where('client_id',$this->id)->orWhere('created_by',$this->id)->first();
       $detailsSale     =   Detail_sale::where('client_id',$this->id)->orWhere('created_by',$this->id)->first();
       $finalExp        =   Final_purchase::where('supplier_id',$this->id)->orWhere('created_by',$this->id)->first();
       $finalPurches    =   Detail_purchase::where('supplier_id',$this->id)->orWhere('created_by',$this->id)->first();

        $totalbill       =   Total_bill_payment_history::where('supplier_id',$this->id)->orWhere('created_by',$this->id)->first();
        $totalSalebill   =   Total_sale_payment_history::where('client_id',$this->id)->orWhere('created_by',$this->id)->first();
        $totalExpbill    =   Total_expense_payment_history::where('created_by',$this->id)->first();
        
        return($finalExp || $finalSale || $finalPurches ||  $detailsSale ||  $totalbill ||  $totalSalebill || $totalExpbill) ? true:false;
    }

}
