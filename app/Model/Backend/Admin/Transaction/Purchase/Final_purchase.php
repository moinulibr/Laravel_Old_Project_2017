<?php

namespace App\Model\Backend\Admin\Transaction\Purchase;

use App\Model\Backend\Admin\Account\Account;
use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Final_purchase extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class,"supplier_id",'id');
    }


    public function payment_methods()
    {
        return $this->belongsTo(Payment_method::class,'payment_method_id','id');
    }

    
    public function accounts()
    {
        return $this->belongsTo(Account::class,'account_id','id');
    }


    # make invoice number as he provided
    public function substr_invoice()
    {
       $count =  strpos($this->reference_no,"-");
       $result = $this->reference_no;
       if(strlen($count) > 0)
       {
            $result =  substr($this->reference_no,($count+1));
       }
       return  $result;
    }

    
    public function purchaseIdAlreadyUsedToAnotherTable()
    {
        $billPaid    =   Total_bill_payment_history::where('final_purchase_id',$this->id)->first();
        return($billPaid) ? true:false;
    }


}
