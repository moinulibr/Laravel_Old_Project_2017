<?php

namespace App\Model\Backend\Admin\Account;

use App\Model\Backend\Admin\Account_Payment\Account_for_user;
use App\Model\Backend\Admin\Account_Payment\Mobile_banking_company;
use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\Transaction\Expense\Detail_expense;
use App\Model\Backend\Admin\Transaction\Expense\Final_expense;
use App\Model\Backend\Admin\Transaction\Purchase\Detail_purchase;
use App\Model\Backend\Admin\Transaction\Purchase\Final_purchase;
use App\Model\Backend\Admin\Transaction\Sale\Detail_sale;
use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use App\Model\Backend\Admin\TransactionHistory\Total_expense_payment_history;
use App\Model\Backend\Admin\TransactionHistory\Total_sale_payment_history;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    public function account_for_users()
    {
        return $this->belongsTo(Account_for_user::class,'account_for_user_id','id');
    }
    public function payment_methods()
    {
        return $this->belongsTo(Payment_method::class,'payment_method_id','id');
    }

    public function mobile_payment_types()
    {
        return $this->belongsTo(Mobile_banking_company::class,'mobile_banking_type_id','id');
    }

    public function purchaseExpenses()
    {
        return $this->hasMany(Total_bill_payment_history::class,'payment_method_id','id');
    }
    public function expenses()
    {
        return $this->hasMany(Total_expense_payment_history::class,'payment_method_id','id');
    }

    public function accountAllReadyUsedToAnotherTable()
    {
       $finalSale       =   Final_sale::where('account_id',$this->id)->first();
       $finalExp        =   Final_expense::where('account_id',$this->id)->first();
       $finalPurches    =   Final_purchase::where('account_id',$this->id)->first();
       $totalbill       =   Total_bill_payment_history::where('account_id',$this->id)->first();
       $totalSalebill   =   Total_sale_payment_history::where('account_id',$this->id)->first();
       $totalExpbill    =   Total_expense_payment_history::where('account_id',$this->id)->first();
        return($finalExp || $finalSale || $finalPurches || $totalbill  || $totalSalebill || $totalExpbill) ? true:false;
    }


    
}
