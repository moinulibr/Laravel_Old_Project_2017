<?php

namespace App\Model\Backend\Admin\Transaction\Sale;

use App\Model\Backend\Admin\Account\Account;
use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\Product\Product\Product;
use App\Model\Backend\Admin\TransactionHistory\Total_sale_payment_history;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Final_sale extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }

    public function order_details()
    {
        return $this->belongsTo(Detail_sale::class,'id','final_sale_id');
    }

    
    public function payment_methods()
    {
        return $this->belongsTo(Payment_method::class,'payment_method_id','id');
    }


    public function saleIdAlreadyUsedToAnotherTable()
    {
        $salePayment    =   Total_sale_payment_history::where('final_sale_id',$this->id)->first();
        return($salePayment) ? true:false;
    }


    public function accounts()
    {
        return $this->belongsTo(Account::class,'account_id','id');
    }
}
